<?php

namespace Alinet\Nodo\TramiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Responsables
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Alinet\Nodo\TramiteBundle\Entity\ResponsablesRepository")
 */
class Responsables
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="cargo", type="string", length=255 ,nullable=true)
     */
    private $cargo;

    /**
     * @var string
     *
     * @ORM\Column(name="ci", type="string", length=255)
     */
    private $ci;



    /**
     * @var string
     *
     * Los tipos de responsables van a ser 2 Firma_Cheque o Firma_Facturas
     *
     * @ORM\Column(name="tiporesponsable", type="string", length=255)
     */
    private $tiporesponsable;

    /**
     * @ORM\ManyToOne(targetEntity="Empresa" , inversedBy="responsables")
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
     * Set nombre
     *
     * @param string $nombre
     * @return Responsables
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set cargo
     *
     * @param string $cargo
     * @return Responsables
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;

        return $this;
    }

    /**
     * Get cargo
     *
     * @return string 
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * Set ci
     *
     * @param string $ci
     * @return Responsables
     */
    public function setCi($ci)
    {
        $this->ci = $ci;

        return $this;
    }

    /**
     * Get ci
     *
     * @return string 
     */
    public function getCi()
    {
        return $this->ci;
    }




    /**
     * Set tiporesponsable
     *
     * @param string $tiporesponsable
     * @return Responsables
     */
    public function setTiporesponsable($tiporesponsable)
    {
        $this->tiporesponsable = $tiporesponsable;

        return $this;
    }

    /**
     * Get tiporesponsable
     *
     * @return string 
     */
    public function getTiporesponsable()
    {
        return $this->tiporesponsable;
    }


    /**
     * Set empresa
     *
     * @param \Alinet\Nodo\TramiteBundle\Entity\Empresa $empresa
     * @return Responsables
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
