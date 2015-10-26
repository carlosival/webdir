<?php

namespace Alinet\Nodo\TramiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Correo
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Alinet\Nodo\TramiteBundle\Entity\CorreoRepository")
 */
class Correo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="correo", type="string", length=255)
     */
    private $correo;

    /**
     * @var string
     *
     * @ORM\Column(name="duenno", type="string", length=255)
     *
     */
    private $duenno;

    /**
     * @ORM\ManyToOne(targetEntity="Empresa" , inversedBy="correos")
     *
     **/
    private $empresa;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set correo
     *
     * @param string $correo
     * @return Correo
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get correo
     *
     * @return string 
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set duenno
     *
     * @param string $duenno
     * @return Correo
     */
    public function setDuenno($duenno)
    {
        $this->duenno = $duenno;

        return $this;
    }

    /**
     * Get duenno
     *
     * @return string 
     */
    public function getDuenno()
    {
        return $this->duenno;
    }


    /**
     * Set empresa
     *
     * @param \Alinet\Nodo\TramiteBundle\Entity\Empresa $empresa
     * @return Correo
     */
    public function setEmpresa(\Alinet\Nodo\TramiteBundle\Entity\Empresa $empresa = null)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa
     *
     * @return \Alinet\Nodo\TramiteBundle\Entity\Empresa 
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /*
     *
     * Esto no es necesario para las relaciones one-to-many / many-to-one
     *
     * public function addEmpresa()
    {

        if (!$this->->contains($task)) {
            $this->tasks->add($task);
        }
    }*/

}
