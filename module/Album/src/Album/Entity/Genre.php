<?php
 
namespace Album\Entity;
 
use Doctrine\ORM\Mapping as ORM;
 
/**
 * Genre
 *
 * @ORM\Table(name="genre")
 * @ORM\Entity
 */
class Genre
{
       
    /**   
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")      
     */
    private $id;
 
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;
       
    public function getId()
    {
        return $this->id;
    }
     
    public function setTitle($genre)
    {
        $this->title = $title;     
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }
     
    public function __get($property)
    {
    	return $this->$property;
    }
    
    public function __set($property, $value)
    {
    	$this->$property = $value;
    }
    
    public function getArrayCopy()
    {
    	return get_object_vars($this);
    }
    

    public function populate($data = array())
    {
    	$this->id = $data['id'];
    	$this->genre = $data['title'];
    }
    
}