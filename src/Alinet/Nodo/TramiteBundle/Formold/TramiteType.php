<?php

namespace Alinet\Nodo\TramiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TramiteType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fechaSolNodo')
            ->add('fechaSolEtecsa')
            ->add('descripcion')
            ->add('estado')
            ->add('estadoUeb')
            ->add('descripcionUeb')
            ->add('provincia')
            ->add('fechaEjec')
            ->add('observaciones')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Alinet\Nodo\TramiteBundle\Entity\Tramite'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'alinet_nodo_tramitebundle_tramite';
    }
}
