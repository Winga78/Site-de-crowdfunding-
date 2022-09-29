<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface; 
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Projet;
use App\Entity\User;
use App\Entity\Financer;
use App\Form\FinancerType;
use App\Repository\ProjetRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface; 
use Symfony\Component\Validator\Constraints\DateTime;
class FinancerController extends AbstractController
{
    #[Route('/financer/{id}', name: 'financer')]
    public function index($id,Request $request,ManagerRegistry $doctrine,SessionInterface $session,ProjetRepository $objetrepository): Response
    {
		
		
		$entityManager = $doctrine->getManager();
		$investir = new Financer() ;
		$notification= null;
		
		$user= new User();
		$messagefin = null;
		$lesfinances=null;
		$form = $this-> createForm(FinancerType::class,$investir); 
		$form -> handleRequest($request);
		
		$projet= $doctrine->getRepository(Projet::class)-> find($id); 
		
		$somme=0;
		
		$tablefinancer= $doctrine->getRepository(Financer::class)-> findAll(); 
		
		
			if($tablefinancer!=null){
				foreach($tablefinancer as $ligne){
					if($ligne->getFundedFor()->getId() == $projet->getId()){
					$somme = $somme+ $ligne->getMontant();
				
					}
				
				if($somme >= $projet->getBudget()){
					$messagefin= " financement complet  " ;
					
				}
				
				
				else{
		
					
					
						if($form->isSubmitted() && $form-> isValid()) {
			
			
							$user= $this->getUser();
							$money_user= $user->getMonnaie();
							$money_saisi= $form['montant']->getData(); 		
							if($money_user>= $money_saisi){
								$notification="Merci d'avoir financé ce projet";
								$investir -> setFundedBy($this->getUser());
								$investir -> setFundedFor($projet);
								$investir -> setMontant($money_saisi);
								$resultat= $money_user - $money_saisi;
								$user->setMonnaie($resultat);	
					
					
					
								$moneyuser= $projet->getCreatedBy()->getMonnaie();
								$resultat= $moneyuser + $money_saisi;
								$projet->getCreatedBy()->setMonnaie($resultat);
								
								
								$entityManager->persist($investir); 
								$entityManager->flush(); 
								
								
							}
							else {$notification="Pas assez de moyen pour financer ce projet";}
				
						
		
		
						}
			
					}
					
					
				}
			}
			
			elseif($form->isSubmitted() && $form-> isValid()) {
			
			
							$user= $this->getUser();
							$money_user= $user->getMonnaie();
							$money_saisi= $form['montant']->getData(); 		
							if($money_user>= $money_saisi){
								$notification="Merci d'avoir financé ce projet";
								$investir -> setFundedBy($this->getUser());
								$investir -> setFundedFor($projet);
								$investir -> setMontant($money_saisi);
								$resultat= $money_user - $money_saisi;
								$user->setMonnaie($resultat);	
					
					
					
								$moneyuser= $projet->getCreatedBy()->getMonnaie();
								$resultat= $moneyuser + $money_saisi;
								$projet->getCreatedBy()->setMonnaie($resultat);
					
							}
							else {$notification="Pas assez de moyen pour financer ce projet";}
				
						$entityManager->persist($investir); 
						$entityManager->flush(); 
		
		
			}
				
				
			
			
		
        
        return $this->render('financer/index.html.twig', [
             'form'=> $form->createView(),
			 'notification'=>$notification,
			 'projet'=>$projet,
			 'messagefin'=> $messagefin,
			 'lesfinances'=>$tablefinancer,
			 
			 
			 
        ]);
    
	
		
	
 
	 
}

}
