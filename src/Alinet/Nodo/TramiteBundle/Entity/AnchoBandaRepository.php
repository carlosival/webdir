<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 11/05/15
 * Time: 16:48
 */

namespace Alinet\Nodo\TramiteBundle\Entity;

use Doctrine\ORM\EntityRepository;
class AnchoBandaRepository extends EntityRepository{





    public function findAnchoNoEjecutados()
    {
        return $this->getEntityManager()
            ->createQuery("SELECT e FROM TramiteBundle:AnchoBanda e WHERE e.fechaEjec IS NULL ")
            ->getResult();
    }

    public function findAnchoNoEjecutadosbyProvincia($provincia)
    {
        return $this->getEntityManager()
            ->createQuery("SELECT e FROM TramiteBundle:AnchoBanda e WHERE (e.fechaEjec IS NULL AND e.provincia = :provincia)")
            ->setParameter('provincia', $provincia)
            ->getResult();
    }

    public function findAnchoEjecutados()
    {
        return $this->getEntityManager()
            ->createQuery("SELECT e FROM TramiteBundle:AnchoBanda e WHERE e.fechaEjec IS NOT NULL ")
            ->getResult();
    }

    public function findAnchoEjecutadosbyProvincia($provincia)
    {
        return $this->getEntityManager()
            ->createQuery("SELECT e FROM TramiteBundle:AnchoBanda e WHERE (e.fechaEjec IS NOT NULL AND e.provincia = :provincia)")
            ->setParameter('provincia', $provincia)
            ->getResult();
    }



} 