<?php

namespace EShopBundle\Controller;

use EShopBundle\Entity\Address;
use EShopBundle\Form\AddressType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends Controller
{
    /**
     * @Route("/order", name="order_details")
     */
    public function orderDetails() {
        $form = $this->createForm(AddressType::class);

        return $this->render('order/order_details.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/create_address", name="create_address")
     */
    public function addAddress(Request $request){
        $address = new Address();
        $form = $this->createForm(AddressType::class, $address);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $address->setUser($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();
        }

        return $this->render('order/order_details.html.twig', ['form' => $form->createView()]);
    }
}
