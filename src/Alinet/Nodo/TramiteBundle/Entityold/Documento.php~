<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Documento
 *
 * @author Carlos Martinez Ival
 */
namespace Alinet\Nodo\TramiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * 
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 * 
 */
class Documento {
    //put your code here


 /**
  *   @ORM\Id
  *   @ORM\Column(type="integer")
  *   @ORM\GeneratedValue(strategy="AUTO")
  */
private $id;

/**
* @ORM\Column( name="ruta", type="string", length=255, nullable=true)
*/
 private $path;

/**
* @Assert\File(maxSize="1000M")
*/
  private $file;

/**
 * @ORM\Column(name="createdat", type="date", nullable=false)
 * @Assert\Date()
 *
 */
  private $createdat;
/**
 *
 * @ORM\Column(name="createdby", type="string",nullable=true)
 * 
 *
 */
 private $createdby;

    /**
     *
     * @ORM\OneToOne(targetEntity="Tramite")
     *
     */
 private $tramite;

    /**
     * @var integer
     *
     * @ORM\Column(name="ediciones", type="integer",nullable=true)
     */
 private $ediciones;

 private $temp;



    public function getEdiciones(){

        return $this->ediciones;
}

    public  function setEdiciones($ediciones){
       $this->ediciones=$ediciones;
    }

public function getAbsolutePath()
{
return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->path;
}
public function getWebPath()
{
return null === $this->path ? null : $this->getUploadDir().'/'.$this->path;
}
public function getUploadRootDir() {
// la ruta absoluta al directorio dónde se deben guardar los documentos cargados
return __DIR__.'/../../../../../web/'.$this->getUploadDir();
}
protected function getUploadDir()
{
// se libra del __DIR__ para no desviarse al mostrar ‘doc/image‘ en la vista.
return 'uploads';
}
    

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
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        $partes= explode(".",$this->path);
       // array_pop($partes);
        
        $pieces_of_name=array_slice($partes,1);
        
        return implode("." , $pieces_of_name);
    }

    public function getExtension(){
        
         $partes = explode(".",$this->getRuta());

        return array_pop($partes);
    }
    /**
     * Set ruta
     *
     * @param string $ruta
     */
    public function setRuta($path)
    {
        $this->ruta = $path;
    }

    /**
     * Get ruta
     *
     * @return string 
     */
    public function getRuta()
    {
        return $this->path;
    }

   public function __toString() {
       
       return $this->getNombre();
   }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp = $this->path;
            $this->path = null;
        } else {
            $this->path = 'initial';
        }
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }



/**
* @ORM\PrePersist()
* @ORM\PreUpdate()
*/
public function preUpload()
{
if (null !== $this->file) {
// haz lo que quieras para generar un nombre único
$filename = sha1(uniqid(mt_rand(), true));
$this->setPath($filename.'.'.$this->file->getClientOriginalName());


}
}
/**
* @ORM\PostPersist()
* @ORM\PostUpdate()
*/
public function upload()
{
    if (null === $this->getFile()) {
        return;
    }

    // if there is an error when moving the file, an exception will
    // be automatically thrown by move(). This will properly prevent
    // the entity from being persisted to the database on error
    $this->getFile()->move($this->getUploadRootDir(), $this->path);

    // check if we have an old image
    if (isset($this->temp)) {
        // delete the old image
        unlink($this->getUploadRootDir().'/'.$this->temp);
        // clear the temp image path
        $this->temp = null;
    }
    $this->file = null;
}
/**
* @ORM\PostRemove()
*/
public function removeUpload()
{
    $file = $this->getAbsolutePath();
    if ($file) {
        unlink($file);
    }
}

public function __construct()
    {
        
       $this->createdat=new \DateTime("now");
       $this->ediciones=0;
    }

   

    /**
     * Set createdat
     *
     * @param date $createdat
     */
    public function setCreatedat($createdat)
    {
        $this->createdat = $createdat;
    }

    /**
     * Get createdat
     *
     * @return date 
     */
    public function getCreatedat()
    {
        return $this->createdat;
    }

    /**
     * Set createdby
     *
     * @param string $createdby
     */
    public function setCreatedby($createdby)
    {
        $this->createdby = $createdby;
    }

    /**
     * Get createdby
     *
     * @return string 
     */
    public function getCreatedby()
    {
        return $this->createdby;
    }

    /**
     * Set tramite
     *
     * @param \Alinet\Nodo\TramiteBundle\Entity\Tramite $tramite
     * @return Documento
     */
    public function setTramite(\Alinet\Nodo\TramiteBundle\Entity\Tramite $tramite = null)
    {
        $this->tramite = $tramite;

        return $this;
    }

    /**
     * Get tramite
     *
     * @return \Alinet\Nodo\TramiteBundle\Entity\Tramite 
     */
    public function getTramite()
    {
        return $this->tramite;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Documento
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }
}
