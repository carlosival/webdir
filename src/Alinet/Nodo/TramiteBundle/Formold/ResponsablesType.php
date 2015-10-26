<?php

namespace Alinet\Nodo\TramiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ResponsablesType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {



        $builder
            ->add('nombre','text',array('label'=>'Nombre' , 'attr' => array('class' => 'form-control')))
            ->add('cargo','text',array('required' => false ,'label'=>'Cargo' , 'attr' => array('class' => 'form-control')))
            ->add('ci','text',array( 'label'=>'Carnet de Identidad' , 'attr' => array('class' => 'form-control')))
//            ->add('nocontrato','text',array('label'=>'Numero de Contrato' , 'attr' => array('class' => 'form-control')))
//            ->add('fechainicio','date',array('label'=>'Fecha de Inicio de Contrato' ,'attr'=>array('class'=>'fecha' )))
 //           ->add('fechavencimiento','date',array('label'=>'Fecha de Vencimiento de Contrato' ,'attr'=>array('class'=>'fecha')))
            ->add('tiporesponsable','choice', array(
                'choices' => array('cheque' => 'Firma de Cheques', 'factura' => 'Firma de Facturas'),
                'preferred_choices' => array('factura'),
                'required' => true,
                'expanded' => false,
                'attr' => array('class' => 'form-control'),
                'label' => 'Responsabilidad',

            ))
            ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Alinet\Nodo\TramiteBundle\Entity\Responsables'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'alinet_nodo_tramitebundle_responsables';
    }
}
