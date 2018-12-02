<?php

namespace EShopBundle\Controller;

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
    public function addAction() {
        return $this->render('products/add_edit.thml.twig');
    }
}
