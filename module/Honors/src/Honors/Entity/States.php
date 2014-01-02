<?php

namespace Honors\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;
/**
 * Honnors
 *
 * @ORM\Table(name="States")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class States
{

	/**
	 * @ORM\Column(name="id", type="integer", nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(name="country", type="string", length=40, nullable=true)
	 */
	private $country;
	
	/**
	 * @ORM\Column(name="state", type="string", length=40, nullable=true)
	 */
	private $state;
	
	/**
	 * @ORM\Column(name="descr", type="string", length=40, nullable=true)
	 */	
	private $descr;



	public function getID()
	{
		return $this->id;
	}
	

	public function getCountry()
	{
		return $this->country;
	}


	public function getState()
	{
		return $this->state;
	}

	public function getDescr()
	{
		return $this->descr;
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
		$this->country = $data['country'];
		$this->state = $data['state'];
		$this->city = $data['city'];
	}
	 
}