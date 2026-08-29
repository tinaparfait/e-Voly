<?php

namespace App\Controller;

use App\Entity\Vegetable;
use App\Form\VegetableType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use function PHPUnit\Framework\throwException;

#[Route('/légume')]
final class VegetableController extends AbstractController
{
    private EntityManagerInterface $em;
    private ManagerRegistry $doctrine;

    public function __construct(
        EntityManagerInterface $em,
        ManagerRegistry $doctrine,
    ) {
        $this->em = $em;
        $this->doctrine = $doctrine;
    }

    // Affiche tout listes de légumes
    #[Route('/', name: 'app_vegetable_list')]
    public function list(): Response
    {
        $repository = $this->doctrine->getRepository(Vegetable::class);
        $vegetable = $repository->findAll();

        return $this->render('vegetable/list.html.twig', [
            'vegetables' => $vegetable,
        ]);
    }

    // Une méthode qui permet d'ajouté un légume
    #[Route('/ajouter', name: 'app_add_vegetable')]
    public function new(Request $request): Response
    {
        $vegetable = new Vegetable();
        $form = $this->createForm(VegetableType::class, $vegetable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('image')->getData();
            if ($file) {
                $newFilename = uniqid() . '.' . $file->guessExtension();
                $file->move($this->getParameter('uploads_directory'), $newFilename);
                $vegetable->setImage($newFilename);
            }
            $this->em->persist($vegetable);
            $this->em->flush();

            return $this->redirectToRoute('app_vegetable_list');
        }

        return $this->render('vegetable/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // Une méthode qui permet de modifier un légume
    #[Route('/modifier/{id}', name: 'app_vegetable_edit')]
    public function edit(Vegetable $vegetable, Request $request): Response
    {
        $form = $this->createForm(VegetableType::class, $vegetable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            return $this->redirectToRoute('app_vegetable_list');
        }

        return $this->render('vegetable/edit.html.twig', [
            'form' => $form->createView(),
            'vegetable' => $vegetable,
        ]);
    }

    // Une méthode qui permet de supprimer un légume
    #[Route('/supprimer/{id}', name: 'app_vegetable_delete')]
    public function delete(int $id): Response
    {
        // récupere le légume à supprimer
        $repository = $this->doctrine->getRepository(Vegetable::class);
        $vegetable = $repository->find($id);

        if ($vegetable) {
            $this->em->remove($vegetable);
            $this->em->flush();

            return $this->redirectToRoute('app_vegetable_list');
        } else {
            return new Response(
                "<p>Légume n'existe pas</p>"
            );
        }
    }

    // Afficher un légume particulier
    #[Route('/{id}', name: 'app_vegetable_details')]
    public function details(Vegetable $vegetable): Response
    {
        return $this->render('vegetable/details.html.twig', [
            'vegetable' => $vegetable,
        ]);
    }
}
