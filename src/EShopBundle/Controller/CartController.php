<?php
namespace EShopBundle\Controller;
use EShopBundle\Entity\OrderProduct;
use EShopBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class CartController extends Controller
{
    /**
     * @Route("/cart", name="shopping_cart")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        $cartContents = [];
        if($session->get('cart_contents') !== null) {
            foreach ($session->get('cart_contents') as $itemGroup) {
                foreach ($itemGroup as $item) {
                    $cartContents[] = $item;
                }
            }
        }
        return $this->render('shopping_cart/view_cart.html.twig',
            ['cart_contents' => $cartContents]);
    }
    /**
     * @Route("/add_to_cart/{id}", name="add_to_cart")
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function addProductToCart(Request $request, $id) {
        $orderProduct = new OrderProduct();
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);
        $orderProduct->setProduct($product->getName());
        $orderProduct->setColor('червен');
        $orderProduct->setSize('S');
        $orderProduct->setImage($product->getImage());
        $orderProduct->setPrice($product->getPrice());
        $orderProduct->setQuantity(1);
        $session = $request->getSession();
        $cartContents = $session->get('cart_contents');
        if($cartContents !== null && key_exists($id, $cartContents)){
            // there is already a product of this type in the cart
            /** @var OrderProduct $item */
            foreach ($cartContents[$id] as $item) {
                if ($item->getSize() === $orderProduct->getSize()
                    && $item->getColor() === $orderProduct->getColor()) {
                    $item->setQuantity($item->getQuantity() + 1);
                    break;
                }
                $cartContents[$id][] = $orderProduct;
                $session->set('cart_contents', $cartContents);
            }
        }
        else {
            // there is no product of this type in the cart - add it
            $cartContents[$id][] = $orderProduct;
            $session->set('cart_contents', $cartContents);
        }
        $cartDisplay = [];
        if($session->get('cart_contents') !== null) {
            foreach ($session->get('cart_contents') as $itemGroup) {
                foreach ($itemGroup as $item) {
                    $cartDisplay[] = $item;
                }
            }
        }
        return $this->render('shopping_cart/view_cart.html.twig',
            ['cart_contents' => $cartDisplay]);
    }
}