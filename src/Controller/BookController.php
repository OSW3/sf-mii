<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
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
    #[Route('s', name: 'index', methods: ["HEAD", "GET"])]
    public function index(BookRepository $bookRepository): Response
    {
        // Récupération des données
        $books = $bookRepository->findAll();

        // $criteria = [
        //     'title' => "super titre"
        // ];
        // $books = $bookRepository->findBy($criteria);

        // Transmission des données à la vue
        return $this->render('book/index.html.twig', [
            'books' => $books
        ]);
    }


    // CREATE
    // --
    // path: /book
    // name: book:create
    #[Route('', name: 'create', methods: ["HEAD", "GET", "POST"])]
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
                // TODO: file upload

                // Enregistrement en BDD
                $em = $doctrine->getManager();
                $em->persist( $book );
                $em->flush();

                // Message Flash 
                $this->addFlash('success', "Le livre ". $book->getTitle() ." à été ajouté.");

                // Redirection de l'utilisateur
                return $this->redirectToRoute("book:show", [
                    'id' => $book->getId()
                ]);
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
    #[Route('/{id}', name: 'show', methods: ["HEAD", "GET"])]
    public function show(Book $book): Response
    {
        return $this->render('book/show.html.twig', [
            'book' => $book
        ]);
    }
    // public function show($id, BookRepository $bookRepository): Response
    // {
    //     $book = $bookRepository->find($id);

    //     return $this->render('book/show.html.twig', [
    //         'book' => $book
    //     ]);
    // }


    // UPDATE
    // --
    // path: /book/42/edit
    // name: book:edit
    #[Route('/{id}/edit', name: 'edit', methods: ["HEAD", "GET", "POST"])]
    public function update(Book $book, ManagerRegistry $doctrine, Request $request, ValidatorInterface $validator)
    {
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
                // TODO: file upload

                // Enregistrement en BDD
                $em = $doctrine->getManager();
                $em->persist( $book );
                $em->flush();

                // Message Flash 
                $this->addFlash('success', "Le livre ". $book->getTitle() ." à été modifié.");

                // Redirection de l'utilisateur
                return $this->redirectToRoute("book:show", [
                    'id' => $book->getId()
                ]);
            }
        }


        // Preparation de l'objet $form pour la vue twig
        $form = $form->createView();

        return $this->render('book/update.html.twig', [
            'book' => $book,
            'form' => $form,
        ]);
    }


    // DELETE
    // --
    // path: /book/42/delete
    // name: book:delete
    #[Route('/{id}/delete', name: 'delete', methods: ["HEAD", "GET", "DELETE"])]
    public function delete(Book $book, ManagerRegistry $doctrine, Request $request)
    {
        if ($request->getMethod() === 'DELETE')
        {
            // Requete de suppression
            $em = $doctrine->getManager();
            $em->remove($book);
            $em->flush();

            // Redirection de l'utilisateur
            return $this->redirectToRoute("book:index");
        }

        return $this->render('book/delete.html.twig', [
            'book' => $book
        ]);
    }
}
