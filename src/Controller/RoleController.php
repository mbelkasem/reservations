<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Roles;
use App\Repository\RolesRepository;

#[Route('/role')]
class RoleController extends AbstractController
{
    #[Route('/', name:'role_index', methods: ['GET'])]
    public function index(RolesRepository $repository): Response
    {
        $role = $repository->findAll();
       // var_dump($role);

        return $this->render('role/index.html.twig', [
            'role' => $role,
            'resource' => 'artistes',
        ]);

    }  

    #[Route('/{id}', name:'role_show', methods: ['GET'])]
    public function show(int $id, RolesRepository $repository): Response
    {
       // var_dump($id);
        $role = $repository->find($id);

        return $this->render('role/show.html.twig', [
            'role' => $role,
        ]);
    }
}
