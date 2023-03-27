<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Artists;
use App\Repository\ArtistsRepository;
use App\Form\ArtistType;

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
        //var_dump($id);
        $artist = $repository->find(intval($id));

        return $this->render('artist/show.html.twig', [
            'artist' => $artist,
        ]);
    }

    #[Route('/{id}/edit', name: 'artist_edit', methods: ['GET', 'PUT', 'POST'])]
    public function edit(Request $request, Artists $artist, ArtistsRepository $artistRepository): Response
    {
        $form = $this->createForm(ArtistType::class, $artist);
            
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $artistRepository->save($artist, true);

            return $this->redirectToRoute('artist_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('artist/edit.html.twig', [
            'artist' => $artist,
            'form' => $form,
        ]);
    }

    //A voir avec le prof
    #[Route('/artist/new', name: 'artist_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ArtistsRepository $artistRepository): Response
    {
        $artist = new Artists();
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $artistRepository->save($artist, true);

            return $this->redirectToRoute('artist_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('artist/new.html.twig', [
            'artist' => $artist,
            'form' => $form,
        ]);
    }




    

    
}