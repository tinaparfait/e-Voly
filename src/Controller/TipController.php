<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TipController extends AbstractController
{
    #[Route('/conseil', name: 'app_conseil_client')]
    public function conseil(): Response
    {
        return $this->render('tip/conseil.html.twig');
    }
}
