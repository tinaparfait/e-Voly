<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class GuideController extends AbstractController
{
    #[Route('/guide', name: 'app_guide_client')]
    public function guide(): Response
    {
        return $this->render('guide/guide.html.twig');
    }
}
