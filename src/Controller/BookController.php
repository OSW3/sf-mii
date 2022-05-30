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
    // site.com/books
    #[Route('s', name: 'index')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }


    // CREATE
    // --


    // READ
    // --

    // site.com/book/42
    #[Route('/{id}', name: 'show')]
    public function show(): Response
    {
        return $this->render('book/show.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }


    // UPDATE
    // --


    // DELETE
    // --
}
