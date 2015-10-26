<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 23/10/14
 * Time: 13:50
 */

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Alinet\Nodo\TramiteBundle\Entity\Usuario;

class LoadUsuarioData implements FixtureInterface {


    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.

       for($i=0;$i<2 ;$i++){

           $usuario=new Usuario();
           $usuario->setCorreo('usuario'.$i.'@gmail.com');
           $usuario->setNombre('Usuario'.$i);

           $usuario->setPassword('123');

           $usuario->setSalt('123');

           if($i%2==0){
           $usuario->setRol('ROLE_UEB_PROVINCIA');
           }else{

               $usuario->setRol('ROLE_SUPER_ADMIN');
           }

           $manager->persist($usuario);
       }

        $manager->flush();
    }
}