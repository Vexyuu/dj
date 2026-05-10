<?php

namespace App\Tests\Controller;

use App\Entity\DjEntity;
use App\Repository\DjEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final class DjEntityControllerTest extends WebTestCase
{
    private EntityManagerInterface $entityManager;
    private DjEntityRepository $repository;
    private $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->entityManager = $this->client->getContainer()->get('doctrine')->getManager();
        $this->repository = $this->entityManager->getRepository(DjEntity::class);

        foreach ($this->repository->findAll() as $entity) {
            $this->entityManager->remove($entity);
        }
        $this->entityManager->flush();
    }

    public function testIndex(): void
    {
        $this->client->request('GET', '/dj/entity');

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'Profils des DJs');
    }

    public function testNew(): void
    {
        $crawler = $this->client->request('GET', '/dj/entity/new');

        self::assertResponseIsSuccessful();

        // Création d'un fichier image temporaire pour le test
        $photoPath = tempnam(sys_get_temp_dir(), 'test_photo');
        imagepng(imagecreatetruecolor(10, 10), $photoPath);
        $uploadedFile = new UploadedFile(
            $photoPath,
            'test.png',
            'image/png',
            null,
            true
        );

        $form = $crawler->selectButton('Ajouter')->form([
            'dj_entity[nom]' => 'Guetta',
            'dj_entity[prenom]' => 'David',
            'dj_entity[email]' => 'david@example.com',
            'dj_entity[tel]' => '0102030405',
            'dj_entity[urlPortfolio]' => 'https://davidguetta.com',
            'dj_entity[dateSoiree]' => '2026-12-31',
            'dj_entity[materiel]' => 1,
            'dj_entity[couleur]' => '#0000ff',
            'dj_entity[photo]' => $uploadedFile,
            'dj_entity[nbEnceintes]' => 4,
            'dj_entity[puissance]' => 2000,
        ]);

        $this->client->submit($form);

        self::assertResponseRedirects('/dj/entity');
        $this->client->followRedirect();

        $entity = $this->repository->findOneBy(['email' => 'david@example.com']);
        self::assertNotNull($entity);
        self::assertEquals('Guetta', $entity->getNom());
    }

    public function testShow(): void
    {
        $entity = $this->createDjEntity();
        $this->client->request('GET', sprintf('/dj/entity/%d', $entity->getId()));

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('td', 'Guetta');
    }

    public function testEdit(): void
    {
        $entity = $this->createDjEntity();
        $crawler = $this->client->request('GET', sprintf('/dj/entity/%d/edit', $entity->getId()));

        self::assertResponseIsSuccessful();

        $form = $crawler->selectButton('Mettre à jour')->form([
            'dj_entity[nom]' => 'Gretta Modified',
        ]);

        $this->client->submit($form);

        self::assertResponseRedirects('/dj/entity');
        $this->client->followRedirect();

        $this->entityManager->refresh($entity);
        self::assertEquals('Gretta Modified', $entity->getNom());
    }

    public function testDelete(): void
    {
        $entity = $this->createDjEntity();
        $this->client->request('POST', sprintf('/dj/entity/%d', $entity->getId()), [
            '_token' => $this->client->getContainer()->get('security.csrf.token_manager')->getToken('delete'.$entity->getId())->getValue(),
        ]);

        self::assertResponseRedirects('/dj/entity');
        $this->client->followRedirect();

        self::assertNull($this->repository->find($entity->getId()));
    }

    private function createDjEntity(): DjEntity
    {
        $entity = new DjEntity();
        $entity->setNom('Guetta')
            ->setPrenom('David')
            ->setEmail('test@example.com')
            ->setTel('0102030405')
            ->setUrlPortfolio('http://test.com')
            ->setDateSoiree(new \DateTime())
            ->setMateriel(true)
            ->setCouleur('#00ff00')
            ->setPhoto('test.jpg')
            ->setNbEnceintes(2)
            ->setPuissance(1000);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }
}
