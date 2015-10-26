<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 21/10/14
 * Time: 12:14
 */


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Alinet\Nodo\TramiteBundle\Entity\Tramite;



class LoadTramiteData implements FixtureInterface {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {


        for( $i=0;$i<100 ;$i++){

            $tramite=new Tramite();
            $tramite->setEmpresa('Empresa Cubana del Pan') ;

          if($i%2==0){
            $tramite->setDescripcion("Ok");
          }else{
              $tramite->setDescripcion("Mal");
          }

            if($i%2==0){
                $tramite->setDescripcionUeb("Sin ningun problema");
            }else{
                $tramite->setDescripcionUeb("Demora por falta de insumos");
            }



            $tramite->setEstado("ok");
            $tramite->setEstadoUeb("ok");
            $tramite->setFechaEjec(new DateTime('now'));
            $tramite->setFechaSolNodo(new DateTime('now'));

            if($i%2==0){
                $tramite->setObservaciones("El plan fue cumplido con demoras");
            }else{
                $tramite->setObservaciones("Continuan los problemas");
            }


            $tramite->setFechaSolEtecsa(new DateTime('now'));

            if($i%2==0){
                $tramite->setProvincia("La Habana");
            }else{
                $tramite->setProvincia("Santiago");
            }

            $manager->persist($tramite);

        }


        $manager->flush();
    }
}