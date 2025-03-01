<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    #[Assert\NotBlank(message: 'Title cannot be blank.')]
    #[Assert\Length(max: 255, maxMessage: 'Title cannot be longer than {{ limit }} characters.')]
    private string $title;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'Author cannot be blank.')]
    #[Assert\Length(max: 255, maxMessage: 'Author cannot be longer than {{ limit }} characters.')]
    private string $author;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank(message: 'Year of publication cannot be blank.')]
    #[Assert\Range(max: 3000, notInRangeMessage: 'Year of publication must be before {{ max }}.')]
    private int $yearOfPublication;

    #[ORM\Column(type: 'string', length: 20, unique: true)]
    #[Assert\NotBlank(message: 'ISBN cannot be blank.')]
    private string $isbn;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;
        return $this;
    }

    public function getYearOfPublication(): int
    {
        return $this->yearOfPublication;
    }

    public function setYearOfPublication(int $yearOfPublication): self
    {
        $this->yearOfPublication = $yearOfPublication;
        return $this;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): self
    {
        $this->isbn = $isbn;
        return $this;
    }
} 