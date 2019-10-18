<?php

namespace App\Controller;

use App\Entity\Ad;

use App\Form\AdType;
use App\Repository\AdRepository;

use App\Repository\ImageRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdController extends AbstractController
{
    /**
     * @Route("/ads", name="ads_index")
     */
    public function index(AdRepository $repo)
    {
        $ads = $repo->findAll();

        return $this->render('ad/index.html.twig', [
            'ads' => $ads
        ]);
    }


    
    /**
    * Permet de créer une annonce
    *
    *@Route("/ads/new", name="ads_create")
    *
    * @return Response
    */


    public function create(Request $request, ObjectManager $manager){

        $ad = new Ad();

    

        $form = $this->createForm(AdType::class, $ad);

        $form->handleRequest($request);

      

        if($form->isSubmitted() && $form->isValid()) {
   


            $manager->persist($ad);
            $manager->flush();

           
        $this->addFlash(
            "success", 
            "L'annonce <strong> {$ad->getTitle($ad)}</strong> a bien été enregistrée"
        );
   
            return $this->RedirectToRoute('ads_show', [
                'slug' => $ad->getSlug($ad),
        
                ]);
        }


        return $this->render('ad/new.html.twig', [
            'form' => $form->createView()
            ]);
    }

   /**
    * Permet d'afficher une seule annonce
    *
    *@Route("/ads/{slug}", name="ads_show")
    *
    * @return Response
    */
    public function show($slug, Ad $ad){
        
        // je récupére l'annonce qui corresond au slug, thx findOneByX
       // $ad = $repo->findOneBySlug($slug);

    // enfaite je récupére le slug qui corresond a l'annonce, grace a l'injection Ad dans les parametres de ma fonction show, en second parametre il y a mon slug, qui, grace à la @Route, déterminera le slug en rapport à l'annonce recherchée


       return $this->render('ad/show.html.twig', [
            'ad' => $ad,
            'slug' => $slug
            
        ]);
    }



}
