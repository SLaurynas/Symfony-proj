<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $books = [
            ['title' => 'The Great Gatsby', 'author' => 'F. Scott Fitzgerald', 'yearOfPublication' => 1925, 'isbn' => '9780743273565'],
            ['title' => '1984', 'author' => 'George Orwell', 'yearOfPublication' => 1949, 'isbn' => '9780451524935'],
            ['title' => 'To Kill a Mockingbird', 'author' => 'Harper Lee', 'yearOfPublication' => 1960, 'isbn' => '9780061120084'],
            ['title' => 'Pride and Prejudice', 'author' => 'Jane Austen', 'yearOfPublication' => 1813, 'isbn' => '9780141439518'],
            ['title' => 'The Catcher in the Rye', 'author' => 'J.D. Salinger', 'yearOfPublication' => 1951, 'isbn' => '9780316769488'],
            ['title' => 'The Hobbit', 'author' => 'J.R.R. Tolkien', 'yearOfPublication' => 1937, 'isbn' => '9780547928227'],
            ['title' => 'Fahrenheit 451', 'author' => 'Ray Bradbury', 'yearOfPublication' => 1953, 'isbn' => '9781451673319'],
            ['title' => 'Moby-Dick', 'author' => 'Herman Melville', 'yearOfPublication' => 1851, 'isbn' => '9781503280786'],
            ['title' => 'War and Peace', 'author' => 'Leo Tolstoy', 'yearOfPublication' => 1869, 'isbn' => '9781400079988'],
        ];

        foreach ($books as $bookData) {
            $book = new Book();
            $book->setTitle($bookData['title']);
            $book->setAuthor($bookData['author']);
            $book->setYearOfPublication($bookData['yearOfPublication']);
            $book->setIsbn($bookData['isbn']);

            $manager->persist($book);
        }

        $manager->flush();
    }
}
