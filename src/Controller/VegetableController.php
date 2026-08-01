<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class VegetableController extends AbstractController
{
    #[Route('/légume', name: 'app_vegetable_client')]
    public function vegetable(): Response
    {
        return $this->render('vegetable/vegetable.html.twig');
    }
}
