<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Product;
use Doctrine\ORM\EntityManager;
use App\Repository\ProductRepository;


class ProductService
{
  private $productRepository;
  private $em;
  public function __construct(ProductRepository $repository, EntityManagerInterface $em)
  {
    $this->productRepository = $repository;
    $this->em = $em;
  }
  public function details($columnName, $productVal)
  {
    return $this->productRepository->findOneBy([$columnName => $productVal]);;
  }
}
