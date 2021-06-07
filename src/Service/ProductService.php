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
  public function test()
  {
    return $this->productRepository->findAll();
  }
  public function addProduct(Product $prod)
  {
    $this->em->persist($prod);
    $this->em->flush();
  }
  public function deleteProduct($product)
  {
    $this->em->remove($product);
    $this->em->flush();
  }
}
