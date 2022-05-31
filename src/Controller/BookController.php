<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/book', name: 'book:')]
class BookController extends AbstractController
{
    // INDEX
    // --
    // path: /books
    // name: book:index
    #[Route('s', name: 'index')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }


    // CREATE
    // --
    // path: /book
    // name: book:create
    #[Route('', name: 'create')]
    public function create(): Response
    {
        return $this->render('book/create.html.twig');
    }


    // READ
    // --
    // path: /book/42
    // name: book:show
    #[Route('/{id}', name: 'show')]
    public function show(): Response
    {
        return $this->render('book/show.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }


    // UPDATE
    // --
    // path: /book/42/edit
    // name: book:edit


    // DELETE
    // --
    // path: /book/42/delete
    // name: book:delete
}
