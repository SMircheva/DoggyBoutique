<?php

namespace EShopBundle\Controller;

use EShopBundle\Entity\Product;
use http\Env\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductsController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    /**
     * @Route("/add", name="add_product")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request) {
        $product = new Product();

        return $this->render('products/add_edit.thml.twig');
    }

    /**
     * @Route("/edit/{id}", name="edit_product")
     */
    public function editAction($id) {
        $currentProduct = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);

        // finish edit action here
    }

    /**
     * @Route("/delete/{id}", name="detele_product)
     */
    public function deleteAction($id) {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($product);

        //render view with success message
    }
}
