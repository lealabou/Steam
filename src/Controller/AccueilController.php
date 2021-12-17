<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Catalogues;
use App\Entity\User;
use App\Form\EditProfileType;
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
            'title' => 'Bienvenue sur Steam',
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
     * @Route("/profile", name= "accueil_profile")
     */
    public function profile() 
    {
        return $this->render('user/user.html.twig');
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
                    ->add('Prix')
                    ->add('Telechargement')
                    ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($catalogues);
            $entityManager->flush();

            return $this->redirectToRoute('accueil_show', [
                'id' => $catalogues->getId(),
                'editMode' => $catalogues->getId() !== null
            ]);
        }

        return $this->render('accueil/createGame.html.twig', [
            'formJeu' => $form->createView(),
            'editMode' => $catalogues->getId() !== null
        ]);
    }


 #   /**
  #   * @Route("/accueil/{id}/deleteGame", name="accueil_deleteGame")
   #  */
    #public function delete(Catalogues $catalogues) {
     #   $repo = $this->getDoctrine()->getManager();
      #  $repo->remove($catalogues);
      #  $repo->flush();

       # return $this->redirectToRoute('home');
    #}



    /**
     * @Route("/accueil/{id}", name= "accueil_show")
     */

    public function show($id)
    {
        $repo = $this->getDoctrine()->GetRepository(Catalogues::class);
        $catalogues = $repo->find($id);
        return $this->render('accueil/show.html.twig',[
            'catalogues' => $catalogues,
            'editMode' => $catalogues->getId() !== null
        ]);
    }

/**
 * @Route("/user", name="user_editProfile")
 */
public function editProfile(Request $request) {
    $user = $this->getUser();
    $form = $this->createForm(EditProfileType::class, $user);

    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        $this->addFlash('message', 'Profil mis à jour');
        return $this->redirectToRoute('users');
    }

    return $this->render('user/editProfile.html.twig');
}

}
