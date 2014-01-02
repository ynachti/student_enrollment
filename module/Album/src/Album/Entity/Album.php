<?php
 
namespace Album\Entity;
 
use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation; 
/**
 * Album
 *
 * @ORM\Table(name="album")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Album
{
    
            
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")      
     */
    private $id;
 
    /**
     * @ORM\Column(name="artist", type="string", length=255, nullable=true)
     */
    private $artist;
 
    /**
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     * @Annotation\Filter({"title":"StripTags"})
     
     */
    private $title;
 
    /**    
     * @ORM\Column(name="genre", type="string", length=40, nullable=true)
     */    
    private $genre;
           
    /**
     * @ORM\Column(name="date_release", type="date", nullable=true)
     */
    private $date_release;
    
    /**
     * @ORM\Column(name="filestr", type="text", nullable=true)
     */
    private $filestr;
    
    
    public function getId()
    {
        return $this->id;
    }
 
    
    public function setArtist($artist)
    {
        $this->artist = $artist;
     
        return $this;
    }

    public function getArtist()
    {
        return $this->artist;
    }
 
    public function setTitle($title)
    {
        $this->title = $title;
     
        return $this;
    }
 
    public function getTitle()
    {
        return $this->title;
    }
    
    public function setGenre($genre)
    {
    	$this->genre = $genre;
    	 
    	return $this;
    }
    
    public function getGenre()
    {
    	return $this->genre;
    }

    
    public function setRelease_Date($date_release)
    {
    	$this->date_release = new \DateTime();
        
    	return $this;
    }


    public function getDate_Release()
    {
    	return $this->date_release;
    }
    
        
    public function getFileStr()
    {
    	return $this->filestr;
    }
    
    
    public function setFileStr($filestr)
    {
    	$this->filestr = $filestr;
    
    	return $this;
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
    	$this->artist = $data['artist'];
    	$this->title = $data['title'];
    	$this->genre = $data['genre'];
    	$this->date_release = $data['date_release'];
    	$this->filestr = $data['filestr'];
    }
       
}