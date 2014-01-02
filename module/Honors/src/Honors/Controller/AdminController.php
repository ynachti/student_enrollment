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
 * AdminController
 *
 * @author
 *
 * @version
 *
 */
class AdminController extends AbstractActionController {
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
	
	public function getGrid()
	{
		$em = $this->getEntityManager();
		$request = $this->getRequest();
		#$data = $em->getRepository('Album\Entity\Album')->findAll();
		$query = $em->createQuery("SELECT u.honors_id, u.firstname, u.lastname, u.acadyear FROM Honors\Entity\Honors u");				
		$data = $query->getResult();
		$dataGrid = $this->getServiceLocator()->get('zfcDatagrid');
	
		$dataGrid->setTitle('Honors');
		$dataGrid->setDefaultItemsPerPage(8);
		#$dataGrid->setRowClickLink('/album/edit');
		$dataGrid->setDataSource($data);
		#$datagrid->setShowFiltersInExport(array(''=>'Filter'));
		
		#$dataGrid->setShowFiltersInExport(array('render'=>'date'));
		#$filters->addFilter('date'=>array('render'=>'date'));
		
		$action = new Column\Action\Button();
		$action->setLabel('Edit');
		$action->setAttribute('href', 'admin/edit/'.$action->getRowIdPlaceholder());
	
		#$action->setAttribute('Style\Color', Style\Color::$RED);
	
		$col = new Column\Action();
		$col->setLabel('Actions');
		$col->setWidth(10);
	    $col->addAction($action);
		    $dataGrid->addColumn($col);
	
		    #$dataGrid->setRowClickAction($action);
		     
		    $col = new Column\Standard('honors_id');
		    $col->setIdentity();
		    $dataGrid->addColumn($col);
		     
		    $col = new Column\Standard('firstname');
		    $col->setLabel('First Name');
		    $col->setWidth(40);
		    $col->setSortDefault(1, 'ASC');
		    $col->addStyle(new Style\Bold());
		    $dataGrid->addColumn($col);
		     
		    $col = new Column\Standard('lastname');
		    $col->setLabel('Last Name');
		    $col->setWidth(40);
		    $dataGrid->addColumn($col);
		     
		    $col = new Column\Standard('acadyear');
		    #$col->setType(new \ZfcDatagrid\Column\Type\Number());
		    $col->setLabel('Academic Year');
		    $col->setWidth(10);
		    $dataGrid->addColumn($col);
		    $dataGrid->setDataSource($data);
	
		    return $dataGrid;
	}
	
	
	public function indexAction()
	{
		$em = $this->getEntityManager();
		$request = $this->getRequest();
		$dataGrid = $this->getGrid();
		$dataGrid->execute();
		return $dataGrid->getResponse();
	}
	
	
	public function editAction()
	{
		$id = (int) $this->params()->fromRoute('id', 0);
		if (!$id) {
			return $this->redirect()->toRoute('album', array(
					'action' => 'add'
			));
		}
			
		$data = $this->getEntityManager()->find('Honors\Entity\Honors', $id);
			
		$em = $this->getEntityManager();
		
		$query = $em->createQuery("SELECT u.state, u.descr FROM Honors\Entity\States u WHERE u.country = 'USA'");
		$states = $query->getResult();
		
		
		
		$request = $this->getRequest();
			
		if ($request->isPost()) {
			$data = new Honors();
			$data->honors_id = $id;
			$data->firstname = $request->getPost()->firstname;
			$data->lastname = $request->getPost()->lastname;
			$data->state = $request->getPost()->state;
	
			$this->getEntityManager()->merge($data);
			$this->getEntityManager()->flush();
			// Redirect to list of albums
			return $this->redirect()->toRoute('admin');
		}
	    #die(var_dump($states));
		return array(
				'id' => $id,
				'data' => $data,
				'states' => $states,
		);
	}
	
}