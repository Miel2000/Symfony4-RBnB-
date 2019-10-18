<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;



class HomeController extends AbstractController
{


   /**
     * @Route("/hello/{prenom}", name="hello_prenom")
     * @Route("/hello/{prenom}/age/{age}", name="hello_prenom_age")
     * @Route("/hello/", name="hello_base")
     * 
     */

    public function hello(){

        return $this->render('home/hello.html.twig', [
            'controller_name' => 'HomeController',
     
        ]);
    }
    

    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {

        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController'
           
        ]);
    }


}
