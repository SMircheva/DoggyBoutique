<?php

namespace EShopBundle\Form;

use EShopBundle\Entity\Category;
use EShopBundle\Entity\Color;
use EShopBundle\Entity\Product;
use EShopBundle\Entity\Size;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')
            ->add('price')
            ->add('description', TextareaType::class)
            ->add('category', EntityType::class, [
                    'class' => Category::class,
                    'choice_label' => 'name',
                    'placeholder' => ''
                ])
            ->add('colors', EntityType::class,[
                'class' => Color::class,
                'choice_label' => 'name',
                'multiple' => true
            ])
            ->add('sizes', EntityType::class, [
                'class' => Size::class,
                'choice_label' => 'name',
                'multiple' => true
            ])
            ->add('image', FileType::class, [
                'attr' => [
                    'accept' => 'image/*'
                ]
            ])
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', Product::class);
    }

    public function getBlockPrefix()
    {
        return 'eshop_bundle_product_type';
    }
}
