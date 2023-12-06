<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Entity\Artikl;
use App\Entity\Korisnikk;


class MenadzerController extends AbstractController 
{
    /**
     * @Route("/menadzer", name="menadzer")
     */
    public function menadzer(PersistenceManagerRegistry $doctrine): Response
    {
        
        $entityManager = $doctrine->getManager();
        $records = $entityManager->getRepository(Korisnikk::class)->findAll();

        return $this->render('menadzer.html.twig', [
            'records' => $records,
        ]);
    }


    /**
     * @Route("/menadzer/{id}/remove", name="record_remove", methods={"GET"})
     */
    public function remove(Korisnikk $korisnikk, PersistenceManagerRegistry $doctrine): Response
    {
        // Ne mozemo da izbrisemo menadzera i admina
        if($korisnikk->getUsername() == "admin" && $korisnikk->getId() == "1") {
            throw new NotFoundHttpException('Admin cannot be removed.');
        }
        if($korisnikk->getUsername() == "menadzer") {
            throw new NotFoundHttpException('Menadzer cannot be removed.');
        }

        // brisemo korisnika iz baze
        $entityManager = $doctrine->getManager();
        $entityManager->remove($korisnikk);
        $entityManager->flush();


        return $this->redirectToRoute('menadzer');
    }

    
}