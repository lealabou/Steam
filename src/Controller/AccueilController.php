<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Catalogues;
class AccueilController extends AbstractController
{

    /**
     * @Route("/accueil", name= "accueil")
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->GetRepository(Catalogues::class);

        $catalogues = $repo->FindAll();
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'catalogues' => $catalogues
        ]);
    }

    /**
     * @Route("/", name= "home")
     */

    public function home()
    {
        return $this->render('accueil/home.html.twig',[
            'title' => 'Bienvenue sur Steam'
        ]);
    }

    /**
     * @Route("/accueil/createGame", name="accueil_createGame")
     */
    public function create()
    {
        $catalogues = new Catalogues();

        $form= $this->createFormBuilder($catalogues)
                    ->add('titre')
                    ->add('Description')
                    ->add('image')
                    ->getForm();
        
        return $this->render('accueil/createGame.html.twig',[
            'formJeu'=> $form->createView()
        ]);
    }

    /**
     * @Route("/accueil/{id}", name= "accueil_show")
     */

    public function show($id)
    {
        $repo = $this->getDoctrine()->GetRepository(Catalogues::class);
        $catalogues = $repo->find($id);
        return $this->render('accueil/show.html.twig',[
            'catalogues' => $catalogues
        ]);
    }
}
