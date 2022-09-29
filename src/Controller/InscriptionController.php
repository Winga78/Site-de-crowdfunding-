<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;;
use App\Entity\User;
use App\Form\InscriptionType; 
use Doctrine\ORM\EntityManagerInterface; 

class InscriptionController extends AbstractController
{
     #[Route('/inscription', name: 'inscription')]
    public function index(Request $request, UserPasswordHasherInterface $encoder , ManagerRegistry $doctrine): Response
    {
		$notification = null;
	
		$entityManager = $doctrine->getManager();
		$user = new User(); 
		$form = $this-> createForm(InscriptionType::class,$user); 
		$form -> handleRequest($request); 
		
		if($form->isSubmitted() && $form-> isValid()) {
			
			$user = $form->getData(); 
			$user_find= $doctrine->getRepository(User::class)-> findOneByEmail($user->getEmail()); 
			
			if(!$user_find){
				
				$password= $encoder->hashPassword($user, $user->getPassword());
				$user-> setPassword($password);
			
			
			$entityManager->persist($user); 
			$entityManager->flush(); 
			
			$notification="Votre inscription c'est bien déroulée ";
			}
		
			else {
			$notification="L'email utilisé existe déjà ";
			
			}
		}
		
        return $this->render('inscription/index.html.twig', [
			'form'=> $form->createView(),
			'notification'=> $notification,
			
        ]);
    }
}
