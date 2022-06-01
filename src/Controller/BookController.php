<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
    public function create(ManagerRegistry $doctrine, Request $request, ValidatorInterface $validator): Response
    {
        // Récupération de l'entité Book
        $book = new Book;

        // Construction du formulaire
        $form = $this->createForm(BookType::class, $book);

        // Association de la requete courante au formulaire
        $form->handleRequest($request);

        // Test la soumission du formumaire
        if ( $form->isSubmitted() )
        {
            // Execute le controle du formulaire
            // et génération des messages d'erreurs
            $validator->validate($book);

            // Test la validité du formulaire
            if ( $form->isValid() )
            {
                // Enregistrement en BDD
                $em = $doctrine->getManager();
                $em->persist( $book );
                $em->flush();

                // Message Flash 

                // Redirection de l'utilisateur


            }
        }


        // Preparation de l'objet $form pour la vue twig
        $form = $form->createView();

        return $this->render('book/create.html.twig', [

            // Transmission du formulaire à la vue
            'form' => $form
        ]);
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
