<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecetteController extends AbstractController
{
    /**
     * @Route("/recette", name="recette")
     */

    /**
     * @Route("/recette", name="recette")
    */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Recette::Class);

        $recette = $repo->findAll();
        
        return $this->render('recette/index.html.twig', [
            'controller_name' => 'RecetteController',
        ]);
    }

        
   /**
    * @Route("/", name="home")
    */
    public function home(): Response
    {
        return $this->render('recette/home.html.twig');
    }
}
