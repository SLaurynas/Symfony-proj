<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/book')]
final class BookController extends AbstractController{
    #[Route('/', name: 'app_book_index', methods: ['GET'])]
    public function index(Request $request, BookRepository $bookRepository): Response
    {
        $searchQuery = $request->query->get('q');
        $books = $searchQuery ? $bookRepository->findByTitle($searchQuery) : $bookRepository->findAll();

        return $this->render('book/index.html.twig', [
            'books' => $books,
            'searchQuery' => $searchQuery,
        ]);
    }

    #[Route('/new', name: 'app_book_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Check for duplicate title
            $existingBookByTitle = $entityManager->getRepository(Book::class)->findOneBy(['title' => $book->getTitle()]);
            if ($existingBookByTitle) {
                $this->addFlash('error', 'A book with this title already exists.');
                return $this->render('book/new.html.twig', [
                    'book' => $book,
                    'form' => $form,
                ]);
            }

            // Check for duplicate ISBN
            $existingBookByIsbn = $entityManager->getRepository(Book::class)->findOneBy(['isbn' => $book->getIsbn()]);
            if ($existingBookByIsbn) {
                $this->addFlash('error', 'A book with this ISBN already exists.');
                return $this->render('book/new.html.twig', [
                    'book' => $book,
                    'form' => $form,
                ]);
            }

            $entityManager->persist($book);
            $entityManager->flush();

            $this->addFlash('success', 'Book added successfully!');
            return $this->redirectToRoute('app_book_index', [], Response::HTTP_SEE_OTHER);
        }

        if ($form->isSubmitted() && !$form->isValid()) {
            $errors = $form->getErrors(true);
            foreach ($errors as $error) {
                $this->addFlash('error', $error->getMessage());
            }
        }

        return $this->render('book/new.html.twig', [
            'book' => $book,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_book_show', methods: ['GET'])]
    public function show(Book $book): Response
    {
        return $this->render('book/show.html.twig', [
            'book' => $book,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_book_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Book $book, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Book updated successfully!');
            return $this->redirectToRoute('app_book_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('book/edit.html.twig', [
            'book' => $book,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_book_delete', methods: ['POST'])]
    public function delete(Request $request, Book $book, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$book->getId(), $request->request->get('_token'))) {
            $entityManager->remove($book);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_book_index', [], Response::HTTP_SEE_OTHER);
    }
}
