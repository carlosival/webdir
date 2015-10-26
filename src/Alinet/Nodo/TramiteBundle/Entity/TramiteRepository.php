<?php

namespace Alinet\Nodo\TramiteBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * TramiteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TramiteRepository extends EntityRepository
{


    public function findEnlacesNoEjecutados()
    {
        return $this->getEntityManager()
        ->createQuery("SELECT e FROM TramiteBundle:Tramite e WHERE e.fechaEjec IS NULL ")
        ->getResult();
    }

    public function findEnlacesNoEjecutadosbyProvincia($provincia)
    {
        return $this->getEntityManager()
            ->createQuery("SELECT e FROM TramiteBundle:Tramite e WHERE (e.fechaEjec IS NULL AND e.provincia = :provincia)")
            ->setParameter('provincia', $provincia)
            ->getResult();
    }

    public function findEnlacesEjecutados()
    {
        return $this->getEntityManager()
            ->createQuery("SELECT e FROM TramiteBundle:Tramite e WHERE e.fechaEjec IS NOT NULL ")
            ->getResult();
    }

    public function findEnlacesEjecutadosbyProvincia($provincia)
    {
        return $this->getEntityManager()
            ->createQuery("SELECT e FROM TramiteBundle:Tramite e WHERE (e.fechaEjec IS NOT NULL AND e.provincia = :provincia)")
            ->setParameter('provincia', $provincia)
            ->getResult();
    }


}