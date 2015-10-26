<?php

namespace Alinet\Nodo\TramiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TrasladosType extends AbstractType
{
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Alinet\Nodo\TramiteBundle\Entity\Traslados'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'alinet_nodo_tramitebundle_traslados';
    }
}
