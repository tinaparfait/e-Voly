<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home_client')]
    public function home(): Response
    {
        return $this->render('client/home.html.twig');
    }

    #[Route('/apropos', name: 'app_about_client')]
    public function about(): Response
    {
        return $this->render('client/about.html.twig');
    }
}
