<?php

namespace Honors\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;
/**
 * Honors
 *
 * @ORM\Table(name="Honors")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Honors
{

    /**
     * @ORM\Column(name="honors_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")      
     */
    private $honors_id;
	
	/**
	 * @ORM\Column(name="acadyear", type="string", length=10, nullable=true)
	 */
	private $acadyear;
	
	/**
	 * @ORM\Column(name="lastname", type="string", length=18, nullable=true)
	 */	
	private $lastname;

	/**
	 * @ORM\Column(name="firstname", type="string", length=18, nullable=true)
	 */
	private $firstname;
		
	/**
	 * @ORM\Column(name="middle", type="string", length=10, nullable=true)
	 */
	private $middle;

	/**
	 * @ORM\Column(name="address", type="string", length=60, nullable=true )
	 */
	private $address;

	/**
	 * @ORM\Column(name="zip", type="string", length=10, nullable=true)
	 */
	private $zip;
		
	/**
	 * @ORM\Column(name="state", type="string", length=18, nullable=true)
	 */
	private $state;


	/**
	 * @ORM\Column(name="phone", type="string", length=11, nullable=true)
	 */
	private $phone;
	


	public function getId()
	{
		return $this->honors_id;
	}


	public function setLastname($lastname)
	{
		$this->lastname = $lastname;
		 
		return $this;
	}

	public function getLastname()
	{
		return $this->lastname;
	}

	public function setFirstname($firstname)
	{
		$this->firstname = $firstname;
		 
		return $this;
	}

	public function getFirstname()
	{
		return $this->firstname;
	}

	public function setMiddle($middle)
	{
		$this->middle = $middle;

		return $this;
	}

	public function getMiddle()
	{
		return $this->middle;
	}


	public function setAddress($address)
	{
		$this->address = $address;

		return $this;
	}


	public function getAddress()
	{
		return $this->address;
	}


	public function setZip($zip)
	{
		$this->zip = $zip;
	
		return $this;
	}
	
	
	public function getZip()
	{
		return $this->zip;
	}

	public function setAcadyear($zip)
	{
		$this->acadyear = $acadyear;
	
		return $this;
	}
	
	
	public function getAcadyear()
	{
		return $this->acadyear;
	}
	

	public function setPhone($phone)
	{
		$this->phone = $phone;
	
		return $this;
	}
	
	
	public function getPhone()
	{
		return $this->phone;
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
		$this->honors_id = $data['honors_id'];
		$this->lastname = $data['lastname'];
		$this->firstname = $data['firstname'];
		$this->middle = $data['middle'];
		$this->address = $data['address'];
		$this->zip = $data['zip'];
		$this->state = $data['state'];
	}
	 
}