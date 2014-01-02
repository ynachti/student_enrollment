<?php

namespace Honors\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Honors\Form\AppForm;
use Doctrine\ORM\EntityManager;
use Honors\Entity\Honors;
use Doctrine\DBAL\Driver\OCI8\OCI8Connection;
use Doctrine\ORM\Query\ResultSetMapping;
use Zend\Form\Element\DateTime;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Form\View\Helper;
use ZfcDatagrid\Column;
use ZfcDatagrid\Column\Type;
use ZfcDatagrid\Column\Style;

/**
 * adminController
 *
 * @author
 *
 * @version
 *
 */
class ExcelController extends AbstractActionController {
	/**
	 * The default action - show the home page
	 */

	
	/**
	 * Entity manager instance
	 *
	 * @var Doctrine\ORM\EntityManager
	 */
	protected $em;
	
	protected $form;
	
	public function setEntityManager(EntityManager $em)
	{
		$this->em = $em;
	}
	
	public function getEntityManager()
	{
	
		if (null === $this->em) {
			$this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		}
	
		return $this->em;
	}
	
	public function index()
	{
		$em = $this->getEntityManager();
		$request = $this->getRequest();
		$query = $em->createQuery("SELECT u FROM Honors\Entity\Honors u");
		
		$data = $query->getResult();
		return array(			
				'data' => $data,			
		);
	
		
	}
	
	
	public function exportXlsAction()
	{
		set_time_limit( 0 );
	
		
		$em = $this->getEntityManager();
		$request = $this->getRequest();
		$query = $em->createQuery("SELECT u FROM Honors\Entity\Honors u");
		
		$data = $query->getResult();
		$applicationpath = dirname(__FILE__);
		#die(var_dump($applicationpath));
		$filename = "\excel-" . date( "m-d-Y" ) . ".xls";
	
		$realPath = realpath( $filename );
	
		if ( false === $realPath )
		{
			touch( $filename );
			chmod( $filename, 0777 );
		}
	
		$filename = realpath( $filename );
		$handle = fopen( $filename, "w" );
		$finalData = array();
	
		foreach ( $data AS $row )
		{
			$finalData[] = array(
					utf8_decode( $row["col1"] ), // For chars with accents.
					utf8_decode( $row["col2"] ),
					utf8_decode( $row["col3"] ),
			);
		}
	
		foreach ( $finalData AS $finalRow )
		{
			fputcsv( $handle, $finalRow, "\t" );
		}
	
		fclose( $handle );
	
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
	
		$this->getResponse()->setRawHeader( "Content-Type: application/vnd.ms-excel; charset=UTF-8" )
		->setRawHeader( "Content-Disposition: attachment; filename=excel.xls" )
		->setRawHeader( "Content-Transfer-Encoding: binary" )
		->setRawHeader( "Expires: 0" )
		->setRawHeader( "Cache-Control: must-revalidate, post-check=0, pre-check=0" )
		->setRawHeader( "Pragma: public" )
		->setRawHeader( "Content-Length: " . filesize( $filename ) )
		->sendResponse();
	
		readfile( $filename ); exit();
	}
	
}