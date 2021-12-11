<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Catalogues;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\EntityManagerInterface;


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
     * @Route("/apropos", name= "accueil_apropos")
     */

    public function aPropos()
    {
        return $this->render('accueil/apropos.html.twig');
    }

    /**
     * @Route("/accueil/createGame", name="accueil_createGame")
     * @Route("/accueil/{id}/edit", name="accueil_editGame")
     */
    public function form(Catalogues $catalogues = null, Request $request, EntityManagerInterface $entityManager)
    {
        //$catalogues = new Catalogues();
        if(!$catalogues)
        {
            $catalogues = new Catalogues();
        }

        
        $form = $this->createFormBuilder($catalogues)
                    ->add('Titre')
                    ->add('Description')
                    ->add('Image')
                    ->add('Categorie')
                    ->add('Date')
                    
                    ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($catalogues);
            $entityManager->flush();

            return $this->redirectToRoute('accueil_show', ['id' => $catalogues->getId()]);
        }

        return $this->render('accueil/createGame.html.twig', [
            'formJeu' => $form->createView(),
            'editMode' => $catalogues->getId() !== null
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
