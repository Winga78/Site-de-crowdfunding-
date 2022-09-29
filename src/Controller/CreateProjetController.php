<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface; 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Entity\Projet;
use App\Form\CreateProjetType;

class CreateProjetController extends AbstractController

{
    #[Route('/createprojet', name: 'create_projet')]
   public function index(ManagerRegistry $doctrine,Request $request,SluggerInterface $slugger): Response
    {
		 
			
		$entityManager = $doctrine->getManager();
		$projet = new Projet(); 
		$message = null;
		
		$form = $this-> createForm(CreateProjetType::class,$projet);
		$form -> handleRequest($request); 
		
		if($form->isSubmitted() && $form-> isValid()) {
			$brochureFile = $form->get('image')->getData();
			if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
				$safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();
				try {
                    $brochureFile->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
				$projet->setImage($newFilename);
				
			}
			$projet -> setCreatedBy($this->getUser()); 
			 $entityManager->persist($projet); 
			$entityManager->flush(); 
			$message = "projet crée";
		}
		
		
        return $this->render('create_projet/index.html.twig', [
             'form'=> $form->createView(),
			 'message'=> $message
        ]);
    }
}
