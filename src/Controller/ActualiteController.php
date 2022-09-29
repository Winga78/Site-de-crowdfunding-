<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface; 
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Projet;
use App\Entity\User;
use App\Repository\ProjetRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface; 

class ActualiteController extends AbstractController
{
    #[Route('/actualite', name: 'actualite')]
    public function index(Request $request,ManagerRegistry $doctrine,SessionInterface $session ): Response
    {
	
		
		$projets= $doctrine->getRepository(Projet::class)-> findAll(); 
	
		
		
        return $this->render('actualite/index.html.twig', [
			'projets'=>$projets,
			
        ]);
    }


	
	 
}
