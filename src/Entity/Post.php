<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Post
{
    /**
     * @Assert\NotBlank()
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
    /**

     * @ORM\Column(type="string", length=100)
     */
    private $title;
    //getter and setter
    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(String $title)
    {
        $this->title=$title;
    }
    /**

     * @ORM\Column(type="string")
     */
    private $description;
    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(String $description)
    {
        $this->description= $description;
    }


}
