<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Response;

class ProductoType extends AbstractType 
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $categorias = $options['categorias'];
        
        
        $builder
                ->add('id', NumberType::class,array('label' => 'id'))
                ->add('nombre', TextType::class,array('label' => 'Nombre'))
                ->add('idcategoria', choiceType::class,
                        array(  'required'   => true,
                                'label' => 'Categoria',
                                'choices' => $categorias,
                                'placeholder'=>'Seleccione la Categoria')
     
                )
                ->add('preciocompra', IntegerType::class,
                        array(  'required'   => true,
                                'label' => 'Precio de Compra',
                                'attr' => array('min' => 1)
                                 ) )
                ->add('precioventa', IntegerType::class,
                        array(  'label' => 'Precio de Venta',
                                'required'   => true,
                                'attr' => array('min' => 1)
                            ))
                ->add('Guardar', SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Producto',
            'categorias' => null,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_producto';
    }


}
