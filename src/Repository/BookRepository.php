<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function findByTitle(string $title): array
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.title LIKE :title')
            ->setParameter('title', '%' . $title . '%')
            ->orderBy('b.title', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
