<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    /**
     * @Route("/movie", name="movie")
     */
    public function index(): Response
    {
        return $this->render('movie/index.html.twig', [
            'controller_name' => 'MovieController',
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home(ManagerRegistry $doctrine): Response
    {
        $manager = $doctrine->getManager();
        $movies = $manager->getRepository("App\Entity\Film")->findAll();
        return $this->render('movie/home.html.twig',
        ['movies' => $movies,
            ]);
    }

    /**
     * @Route("/register", name="register")
     */
    public function register(): Response
    {
        return $this->render('movie/register.html.twig');
    }

}
