<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Artists;
use App\Repository\ArtistsRepository;

#[Route('/artist')]

class ArtistController extends AbstractController
{
    
    //Affiche toutes la liste des Artites
    #[Route('/', name:'artist_index', methods: ['GET'])]
    public function index(ArtistsRepository $repository): Response
    {
        $artists = $repository->findAll();
        //var_dump($artists);

        return $this->render('artist/index.html.twig', [
            'artists' => $artists,
            'resource' => 'artistes',
        ]);

    }  

    #[Route('/{id}', name:'artist_show', methods: ['GET'])]
    public function show(int $id, ArtistsRepository $repository): Response
    {
        $artist = $repository->find($id);

        return $this->render('artist/show.html.twig', [
            'artist' => $artist,
        ]);
    }


    
}