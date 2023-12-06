<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use App\Entity\Artikl;


class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function admin(): Response
    {
        return $this->render('admin.html.twig');
    }

    /**
     * @Route("/dodajartikl", name="dodajartikl", methods={"POST"})
     */
    public function dodajartikl(Request $request, PersistenceManagerRegistry $doctrine): Response
    {
        $cena = $request->request->get('cena');
        $kolicina = $request->request->get('kolicina');
        $ime = $request->request->get('ime');
        $opisProizvoda = $request->request->get('opis_proizvoda');

        // Pravimo novi artikl
        $product = new Artikl();
        $product->setCena($cena);
        $product->setKolicina($kolicina);
        $product->setIme($ime);
        $product->setOpisProizvoda($opisProizvoda);

        // Cuvamo ga u bazu
        $entityManager = $doctrine->getManager();
        $entityManager->persist($product);
        $entityManager->flush();

        // Redirectujemo se nazad na admin panel
        return $this->redirectToRoute('admin');
    }


    
}
