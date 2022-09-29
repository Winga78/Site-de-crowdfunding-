<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface; 
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Projet;
use App\Entity\Financer
;
class HistoriqueController extends AbstractController
{
    #[Route('/historique', name: 'historique')]
    public function index(ManagerRegistry $doctrine): Response
    {
	
	
		//$financed=  $doctrine->getRepository(Financer::class)->find($this->getUser()->getId());
		
		$financed=  $doctrine->getRepository(Financer::class)->findAll();
		$projets=  $doctrine->getRepository(Projet::class)->findAll();
        return $this->render('historique/index.html.twig', [
			'financed'=> $financed,
			'projets' => $projets
        ]);
    }
}
