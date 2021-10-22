<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Catalogues;
class AccueilController extends AbstractController
{

    //#[Route('/accueil', name: 'accueil')]
    public function index(): Response
    {
        $repo = $this->getDoctrine()->GetRepository(Catalogue::class);

        $catalogues = $repo->FindAll();
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'articles' => $catalogues
        ]);
    }

    /**
     * @Route("/", name= "home")
     */

    public function home()
    {
        return $this->render('accueil/home.html.twig');
    }
}
