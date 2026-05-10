<?php

namespace App\Controller;

use App\Entity\DjEntity;
use App\Form\DjEntityType;
use App\Repository\DjEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/dj/entity')]
final class DjEntityController extends AbstractController
{
    #[Route(name: 'app_dj_entity_index', methods: ['GET'])]
    public function index(DjEntityRepository $djEntityRepository): Response
    {
        return $this->render('dj_entity/index.html.twig', [
            'dj_entities' => $djEntityRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_dj_entity_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
{
    $djEntity = new DjEntity();
    $form = $this->createForm(DjEntityType::class, $djEntity);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        
        // 1. On récupère l'image transmise dans le formulaire
        $photoFile = $form->get('photo')->getData();

        // 2. Si une image a bien été envoyée
        if ($photoFile) {
            $originalFilename = pathinfo($photoFile->getClientOriginalName(), PATHINFO_FILENAME);
            // On nettoie le nom du fichier (enlève les espaces, accents, etc.)
            $safeFilename = $slugger->slug($originalFilename);
            // On ajoute un identifiant unique pour éviter que deux photos aient le même nom
            $newFilename = $safeFilename.'-'.uniqid().'.'.$photoFile->guessExtension();

            // 3. On déplace l'image physiquement dans le dossier qu'on a défini dans services.yaml
            try {
                $photoFile->move(
                    $this->getParameter('photos_directory'),
                    $newFilename
                );
            } catch (FileException $e) {
                // Gérer l'erreur si le déplacement échoue (optionnel pour l'instant)
            }

            // 4. On met à jour l'entité avec le NOUVEAU nom du fichier
            $djEntity->setPhoto($newFilename);
        }

        $entityManager->persist($djEntity);
        $entityManager->flush();

        return $this->redirectToRoute('app_dj_entity_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->render('dj_entity/new.html.twig', [
        'dj_entity' => $djEntity,
        'form' => $form,
    ]);
}

    #[Route('/{id}', name: 'app_dj_entity_show', methods: ['GET'])]
    public function show(DjEntity $djEntity): Response
    {
        return $this->render('dj_entity/show.html.twig', [
            'dj_entity' => $djEntity,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_dj_entity_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DjEntity $djEntity, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DjEntityType::class, $djEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_dj_entity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('dj_entity/edit.html.twig', [
            'dj_entity' => $djEntity,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dj_entity_delete', methods: ['POST'])]
    public function delete(Request $request, DjEntity $djEntity, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$djEntity->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($djEntity);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_dj_entity_index', [], Response::HTTP_SEE_OTHER);
    }
}
