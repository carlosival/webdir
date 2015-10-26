<?php

namespace Alinet\Nodo\TramiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Telefono
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Alinet\Nodo\TramiteBundle\Entity\TelefonoRepository")
 */
class Telefono
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
     * @ORM\Column(name="telefono", type="string", length=255)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="duenno", type="string", length=255)
     *
     */
    private $duenno;

    /**
     * @ORM\ManyToOne(targetEntity="Empresa" , inversedBy="telefonos")
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
     * Set telefono
     *
     * @param string $telefono
     * @return Telefono
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telfono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set duenno
     *
     * @param string $duenno
     * @return Telefono
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
     * @return Telefono
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


}
