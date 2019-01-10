<?php

namespace EShopBundle\Controller;

use EShopBundle\Entity\Product;
use EShopBundle\Form\ProductType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    /**
     * @Route("/add", name="add_product")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request) {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $file */
            $file = $form->getData()->getImage();

            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            try {
                $file->move($this->getParameter('products_directory'),
                    $fileName);
            } catch (FileException $ex) {

            }

            $product->setImage($fileName);
            $em = $this->getDoctrine()
                ->getManager();
            $em->persist($product);
            $em->flush();
            $this->addFlash('info', 'Продукт ' . $product->getName() . ' е добаден успешно. Можете да продължите да добавяте.');
            return $this->redirectToRoute('add_product');
        }

        return $this->render('products/add_product.html.twig', ['form'=>$form->createView()]);
    }

    /**
     * @Route("/edit/{id}", name="edit_product")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, $id) {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);

        if ($product === null) {
            return $this->redirectToRoute('homepage');
        }

        $product->setImage(null);
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            if($form->getData()->getImage() !== null) {
            /** @var UploadedFile $file */
            $file = $form->getData()->getImage();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();

            try {
                $file->move($this->getParameter('products_directory'),
                    $fileName);
            } catch (FileException $ex){

            }

            $product->setImage($fileName);
            }
            $em = $this->getDoctrine()
                ->getManager();
            $em->merge($product);
            $em->flush();
            return $this->redirectToRoute('homepage');
        }

        return $this->render('products/add_product.html.twig', ['form'=>$form->createView(),
            'product' =>$product]);
    }

    /**
     * @Route("/view/{id}", name="view_product")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($id){
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);
        return $this->render('products/view_product.html.twig', ['product' => $product]);
    }

    /**
     * @Route("/products", name="products_list")
     * not accessible through menu at the moment
     */
    public function listProducts()
    {

        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->getListOfCatCol();

        return $this->render('products/products_list.html.twig', [
            'products' => $products,
        ]);

    }

    /**
     * @Route("/delete/{id}", name="detele_product")
     */
    public function deleteAction($id) {
//        $product = $this->getDoctrine()
//            ->getRepository(Product::class)
//            ->find($id);
//
//        //add check if the product exists
//        $em = $this->getDoctrine()->getManager();
//        $em->remove($product);

        return $this->renderView('products_list.html.twig');

    }
}
