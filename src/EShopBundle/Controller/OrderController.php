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
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAddress(Request $request) {
        $address = new Address();
        $form = $this->createForm(AddressType::class, $address);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $address->setUser($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();

            return $this->redirectToRoute('order_accepted');
        }

        return $this->render('order/order_details.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/order_accepted", name="order_accepted")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function orderAccepted(Request $request){
        $request->getSession()->set('cart_contents', null);
        return $this->render('order/order_accepted.html.twig');
    }

}
