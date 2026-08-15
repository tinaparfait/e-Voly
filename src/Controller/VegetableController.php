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

    // Afficher un légume particulier
    #[Route('/{id}', name: 'app_vegetable_details')]
    public function details(Vegetable $vegetable): Response
    {
        return $this->render('vegetable/details.html.twig', [
            'vegetable' => $vegetable,
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

            return $this->redirectToRoute('app_vegetable_client');
        }

        return $this->render('vegetable/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
