<?php

namespace EShopBundle\Controller;

use EShopBundle\Entity\Product;
use EShopBundle\Form\ProductType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

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
            return $this->redirectToRoute('homepage');
        }

        return $this->render('products/add_edit.thml.twig', ['form'=>$form->createView()]);
    }

    /**
     * @Route("/edit/{id}", name="edit_product")
     */
    public function editAction(Request $request, $id) {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()
                ->getManager();
            $em->persist($product);
            $em->flush();
            return $this->redirectToRoute('homepage');
        }

        return $this->render('products/add_edit.thml.twig', ['form'=>$form->createView()]);
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

        return $this->renderView('default/index.html.twig');

    }
}
