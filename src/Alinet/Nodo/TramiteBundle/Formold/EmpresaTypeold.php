<?php

namespace Alinet\Nodo\TramiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmpresaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre_pila','text',array('label'=>'Empresa'))
            ->add('nombre_oficial','text',array('label'=>'Entidad','required'=>'false'))
            ->add('direccion')
            ->add('codigo','text',array('label'=>'Codigo REU','required'=>'false'))
            ->add('cuentabancaria')
            ->add('estadocuentas','choice', array(
                'label'=>'Estado de las cuentas',
                'choice_list' => new ChoiceList(array(true, false), array('Ok', 'Problemas ')),
                'required' => true,))
            ->add('estadofacturas','choice', array(
                'label'=>'Estado de las facturas',
                'choice_list' => new ChoiceList(array(true, false), array('Ok', 'Problemas ')),
                'required' => true,))
            ->add('correos', 'collection', array(

                'type' => new CorreoType(),
                'label'=>'Correos',
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'options'=> array( 'data_class' =>'Alinet\Nodo\TramiteBundle\Entity\Correo', 'attr' => array('class' => 'correo-box'))

                ))
            ->add('telefonos', 'collection', array(

                'type' => new TelefonoType(),
                'label'=>'Telefonos',
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'options'=> array( 'data_class' =>'Alinet\Nodo\TramiteBundle\Entity\Telefono', 'attr' => array('class' => 'telefono-box'))

                ))
           ->add('responsables', 'collection', array(

                'type' => new ResponsablesType(),
                'label'=>'Responsables',
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'options'=> array( 'data_class' =>'Alinet\Nodo\TramiteBundle\Entity\Responsables', 'attr' => array('class' => 'responsable-box'))

            ))

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Alinet\Nodo\TramiteBundle\Entity\Empresa'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'alinet_nodo_tramitebundle_empresa';
    }
}
