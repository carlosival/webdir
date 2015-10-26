<?php

namespace Alinet\Nodo\TramiteBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * EmpresaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EmpresaRepository extends EntityRepository
{

 public function findbyProblemas (){

     return $this->getEntityManager()
         ->createQuery("SELECT e FROM TramiteBundle:Empresa e WHERE e.estado  NOT LIKE %'Ok'% ")
         ->getResult();

 }


}