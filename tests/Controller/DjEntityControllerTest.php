<?php

namespace App\Tests\Controller;

use App\Entity\DjEntity;
use App\Repository\DjEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class DjEntityControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/dj/entity/');

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'Profils des DJs');
    }

    public function testNewPageIsAccessible(): void
    {
        $client = static::createClient();
        $client->request('GET', '/dj/entity/new');

        self::assertResponseIsSuccessful();
    }
}
