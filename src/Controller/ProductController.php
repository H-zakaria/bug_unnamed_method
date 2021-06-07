<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Service\ProductService;
use Doctrine\ORM\EntityManager;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
  private $productService;

  public function __construct(ProductService $pService)
  {
    $this->productService = $pService;
  }


  /**
   * @Route("/", name="home_route")
   */
  public function home()
  {

    return $this->render('product/home.html.twig');
  }

  /**
   * @Route("/all_products", name="all_products_route")
   */
  public function allProducts(): Response
  {
    // if (isset($_POST['supr'])) {
    //   $productID = $_POST['productID'];
    //   $product = $this->productService->details('id', $productID);
    //   $this->productService->deleteProduct($product);
    // } else {
    $products = $this->productService->test();
    return $this->render(
      'product/all_products.html.twig',
      array('products' => $products)
    );
    // }
  }
  /**
   * @Route("/add_product", name="add_product_route")
   */
  public function addProduct(): Response
  {
    return $this->render(
      'product/add_product.html.twig'
    );
  }
  /**
   * @Route("/add_product_exe", name="add_product_exe_route")
   */
  public function addProductExe(): Response
  {
    if (isset($_POST['name'])) {
      $em = $this->getDoctrine()->getManager();
      $cat = $em->getRepository(Category::class)->find($_POST['category']);
      $prod = new Product($_POST['name'], $_POST['weight'], $cat);
      $this->productService->addProduct($prod);
      return $this->redirectToRoute('home_route');
    }
  }
  /**
   * @Route("/details/{productName}", name="product_details_route")
   */
  public function details($productName)
  {
    $product = $this->productService->test();
    return $this->render('product/details.html.twig', [
      'product' => $product
    ]);
  }
  // /* correction suppression */
  // /**
  //  * @Route("/all_products/{id}/supr, name"supr_route")
  //  */
  // public function delete($id): ?Response
  // {
  //   // dd($id);
  //   $this->productService->delete($id);
  // }
}
