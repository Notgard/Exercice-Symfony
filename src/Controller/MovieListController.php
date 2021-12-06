<?php

namespace App\Controller;

use App\Entity\Film;
use App\Entity\Image;
use App\MyPDO\template\MyPDO;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieListController extends AbstractController
{
    /**
     * @Route("/movie/listadd", name="movie_list")
     */
    public function createMovieAndImage(ManagerRegistry $doctrine): Response
    {
        $alpha = 'abcdefghijklmnopqrstuvwxyz';
        $chars = str_split($alpha);
        $entityManager = $doctrine->getManager();
        foreach ($chars as $char){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://www.omdbapi.com/?t=' . $char . '&apikey=20c4e3fd');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_exec($ch);
            $response = curl_exec($ch);
            $movies = json_decode($response, JSON_OBJECT_AS_ARRAY);


            $image = new Image();
            $image->setContenu($movies['Poster']);

            $movie = new Film();

            $movie->setTitre($movies['Title']);
            $movie->setDescription($movies['Plot']);
            $movie->setLikes(0);
            $movie->setDislikes(0);
            $movie->setIdimage($image);

            $entityManager->persist($image);
            $entityManager->flush();

            $entityManager->persist($movie);
            $entityManager->flush();

        }
        return new Response('Saved new movie and image');
    }
}
