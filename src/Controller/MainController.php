<?php

namespace App\Controller;

use App\Entity\Korisnikk;
use App\Entity\Artikl;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface as SymfonyFormBuilderInterface;




class MainController extends AbstractController
{

    

    #[Route('/home', name: 'home')]
    public function index(): Response
    {
        return $this->render('home.html.twig');
    }

    #[Route('/korisnik', name: 'korisnik')]
    public function korisnik(): Response
    {
        return $this->render('korisnik.html.twig');
    }

    #[Route('/register', name:'register')]
    public function register(): Response 
    {
        return $this->render('register.html.twig');
    }

    

    /**
     * @Route("/create", name="user_create", methods={"GET", "POST"})
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function createUser(Request $request, PersistenceManagerRegistry $doctrine, ): Response
    {
        
        $user = new Korisnikk();

        $form = $this->createFormBuilder($user)
        ->add('ime', null, ['label' => 'Ime'])
        ->add('prezime', null, ['label' => 'Prezime'])
        ->add('username', null, ['label' => 'Username'])
        ->add('password', null, ['label' => 'Password'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $doctrine->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            

            return $this->redirectToRoute('home');
        }

        return $this->render('create.html.twig', [
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/login", name="login", methods={"GET", "POST"})
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils, PersistenceManagerRegistry $doctrine ): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
    
        $form = $this->createFormBuilder()
            ->add('username', TextType::class, [
                'label' => 'Username',
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Password',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Login',
            ])
            ->getForm();
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $username = $formData['username'];
            $password = $formData['password'];
    
            if ($username == "admin" && $password == "admin") {
                return $this->redirectToRoute('admin');
            }

            if($username == "menadzer" && $password == "menadzer") {
                return $this->redirectToRoute('menadzer');
            }
    
            $user = $doctrine
                ->getRepository(Korisnikk::class)
                ->findOneBy(['username' => $username]);

            $password = $doctrine 
            ->getRepository(Korisnikk::class)
            ->findOneBy(['password' => $password]);
    
            if (!$user || !$password) {
                
                return $this->redirectToRoute('create');
            }
    
            return $this->redirectToRoute('korisnik');
        }

        // Redirect logged-in users to "korisnik.html.twig"
        if ($this->getUser()) {
        return $this->redirectToRoute('korisnik');
    }
    
        return $this->render('login.html.twig', [
            'form' => $form->createView(),
            'error' => $error,
        ]);
    }



    /**
     * @Route("/cart", name="cart")
     */
    public function viewCart(PersistenceManagerRegistry $doctrine): Response
    {
        // Uzima podatke iz baze
        $products = $doctrine->getRepository(Artikl::class)->findAll();

        // Vraca korpu s podacima
        return $this->render('cart.html.twig', [
            'products' => $products,
        ]);
    }
    


    

    
}
