<?php

namespace Alinet\Nodo\TramiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tramite
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Alinet\Nodo\TramiteBundle\Entity\TramiteRepository")
 */
class Tramite
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_sol_nodo", type="date",nullable=true)
     */
    private $fechaSolNodo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_sol_etecsa", type="date",nullable=true)
     */
    private $fechaSolEtecsa;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255,nullable=true)
     */
    private $descripcion;


    /**
     * @var string
     *
     * @ORM\Column(name="empresa", type="string", length=255,nullable=true)
     */
    private $empresa;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=15,nullable=true)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_ueb", type="string", length=15,nullable=true)
     */
    private $estadoUeb;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_ueb", type="string", length=255,nullable=true)
     */
    private $descripcionUeb;

    /**
     * @var string
     *
     * @ORM\Column(name="provincia", type="string", length=20,nullable=true)
     */
    private $provincia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ejec", type="date", nullable=true)
     */
    private $fechaEjec;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=255,nullable=true)
     */
    private $observaciones;


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
     * Set fechaSolNodo
     *
     * @param \DateTime $fechaSolNodo
     * @return Tramite
     */
    public function setFechaSolNodo($fechaSolNodo)
    {
        $this->fechaSolNodo = $fechaSolNodo;

        return $this;
    }

    /**
     * Get fechaSolNodo
     *
     * @return \DateTime 
     */
    public function getFechaSolNodo()
    {
        return $this->fechaSolNodo;
    }

    /**
     * Set fechaSolEtecsa
     *
     * @param \DateTime $fechaSolEtecsa
     * @return Tramite
     */
    public function setFechaSolEtecsa($fechaSolEtecsa)
    {
        $this->fechaSolEtecsa = $fechaSolEtecsa;

        return $this;
    }

    /**
     * Get fechaSolEtecsa
     *
     * @return \DateTime 
     */
    public function getFechaSolEtecsa()
    {
        return $this->fechaSolEtecsa;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Tramite
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Tramite
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set estadoUeb
     *
     * @param string $estadoUeb
     * @return Tramite
     */
    public function setEstadoUeb($estadoUeb)
    {
        $this->estadoUeb = $estadoUeb;

        return $this;
    }

    /**
     * Get estadoUeb
     *
     * @return string 
     */
    public function getEstadoUeb()
    {
        return $this->estadoUeb;
    }

    /**
     * Set descripcionUeb
     *
     * @param string $descripcionUeb
     * @return Tramite
     */
    public function setDescripcionUeb($descripcionUeb)
    {
        $this->descripcionUeb = $descripcionUeb;

        return $this;
    }

    /**
     * Get descripcionUeb
     *
     * @return string 
     */
    public function getDescripcionUeb()
    {
        return $this->descripcionUeb;
    }

    /**
     * Set provincia
     *
     * @param string $provincia
     * @return Tramite
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia
     *
     * @return string 
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Set fechaEjec
     *
     * @param \DateTime $fechaEjec
     * @return Tramite
     */
    public function setFechaEjec($fechaEjec)
    {
        $this->fechaEjec = $fechaEjec;

        return $this;
    }

    /**
     * Get fechaEjec
     *
     * @return \DateTime 
     */
    public function getFechaEjec()
    {
        return $this->fechaEjec;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return Tramite
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string 
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set empresa
     *
     * @param string $empresa
     * @return Tramite
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa
     *
     * @return string 
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    public function __toString(){

        return $this->getEmpresa().'idtramite'.$this->getId();
    }

}
