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
    public function indexAction()
    {

        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->getListOfCatCol();

        return $this->render('default/index.html.twig', [
            'products' => $products,
        ]);

    }

    /**
     * @Route("/alt", name="index_alt")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction2 () {
        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->getListOfCatCol();
        return $this->render('default/index_alt.html.twig', [
            'products' => $products,
        ]);
    }
}
