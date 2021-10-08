<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Post
{
    /**
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

     * @ORM\Column(type="text")
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

    /**
     * @ORM\Column(type="string", length="100")
     */
    private $image;

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

//    /**
//     * @ORM\ManyToOne (targetEntity="App\Entity\Category", inversedBy="post")
//     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
//     */
//    private $category;
//
//    public function __construct()
//    {
//        $this->category = new ArrayCollection();
//    }
//
//    /**
//     * @return Collection|Category[]
//     */
//    public function getCategory(): Collection
//    {
//        return $this->category;
//    }
//
//    public function addCategory(Category $category): self
//    {
//        if (!$this->category->contains($category)) {
//            $this->category[] = $category;
//        }
//
//        return $this;
//    }
//
//    public function removeCategory(Category $category): self
//    {
//        $this->category->removeElement($category);
//
//        return $this;
//    }
//
//    public function setCategory(?Category $category): self
//    {
//        $this->category = $category;
//
//        return $this;
//    }
//    protected $messageDescription;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="post")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }



}
