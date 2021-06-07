<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
  /**
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @ORM\Column(type="string", length=255 ,unique=true)
   */
  private $name;

  /**
   * @ORM\Column(type="integer", nullable=true)
   */
  private $weight;


  /**
   * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="Products")
   * @ORM\JoinColumn(nullable=false)
   */
  private $category;

  /**
   * @ORM\ManyToMany(targetEntity=Order::class, inversedBy="products")
   */
  private $orders;

  public function __construct(string $name, float $weight, Category $category)
  {
    $this->orders = new ArrayCollection();
    $this->name = $name;
    $this->weight = $weight;
    $this->category = $category;
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getName(): ?string
  {
    return $this->name;
  }

  public function setName(string $name): self
  {
    $this->name = $name;

    return $this;
  }

  public function getWeight(): ?int
  {
    return $this->weight;
  }

  public function setWeight(?int $weight): self
  {
    $this->weight = $weight;

    return $this;
  }



  public function getCategory(): ?Category
  {
    return $this->category;
  }

  public function setCategory(?Category $category): self
  {
    $this->category = $category;

    return $this;
  }

  /**
   * @return Collection|Order[]
   */
  public function getOrders(): Collection
  {
    return $this->orders;
  }

  public function addOrder(Order $order): self
  {
    if (!$this->orders->contains($order)) {
      $this->orders[] = $order;
    }

    return $this;
  }

  public function removeOrder(Order $order): self
  {
    $this->orders->removeElement($order);

    return $this;
  }
}
