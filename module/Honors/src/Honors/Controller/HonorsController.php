<?php

namespace Honors\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Form\Annotation\AnnotationBuilder;
use Zend\View\Model\ViewModel;
use Honors\Model\AppForm;
use Honors\Entity\Honors;
use Doctrine\ORM\Tools\Pagination; // goes at top of file

class HonorsController extends AbstractActionController {

    
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
    
    public function listAction()
    {
    	$em = $this->getEntityManager();
    	$request = $this->getRequest();
    	$data = $em->getRepository('Honors\Entity\Honors')->findAll();
    	$srchStr = '';
    	if ($request->isPost()) {
    		if(strlen($request->getPost()->searchStr) >= 1){
    			$srchStr = $request->getPost()->searchStr;
    			$query = $em->createQuery("SELECT u FROM Honors\Entity\Honors u WHERE upper(u.firstname) LIKE :firstname OR upper(u.lastname) LIKE :lastname ");
    			$query->setParameters(array(
    					'firstname' => strtoupper($srchStr)."%",
    					'lastname' => strtoupper($srchStr)."%",
    			));
    			$data = $query->getResult();
    		}
    		else{
    			$data = $em->getRepository('Honors\Entity\Honors')->findAll();
    		}
    	}
    	return new ViewModel(array(
    			'data' => $data,
    			'srchStr' => $srchStr,
    	));
    }
    
    public function listsortAction()
    {
    	$em = $this->getEntityManager();
    	$request = $this->getRequest();
		$c = count($paginator);
    	$data = $em->getRepository('Honors\Entity\Honors')->findAll();
        return new ViewModel(array(
            'data' => $paginator,    	           
  		));    
    }

    public function indexAction() {
        $form = $this->getForm();
        return array(
            'title' => 'Honors College',
            'form' => $form,
            'messages' => $this->flashmessenger()->getMessages()
        );
    }

    public function getForm() {
        if (!$this->form) {
            $honors_application = new AppForm();
            $builder = new AnnotationBuilder();
            $this->form = $builder->createForm($honors_application);
        }
        return $this->form;
    }

   
}

