<?php

namespace EShopBundle\Controller;

use EShopBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAll();

        return $this->render('default/index.html.twig', [
            'products' => $products,
        ]);

    }
}
