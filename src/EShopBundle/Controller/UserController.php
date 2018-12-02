<?php

namespace EShopBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    /**
     * @Route("/register", name="user_register")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(){
        return $this->render('user/register.html.twig');
    }
}
