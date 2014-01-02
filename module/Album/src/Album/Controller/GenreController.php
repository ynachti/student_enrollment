<?php
namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Album\Entity\Genre;
use Doctrine\DBAL\Driver\OCI8\OCI8Connection;
use Doctrine\ORM\Query\ResultSetMapping;
use Zend\Form\Element\DateTime;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Form\View\Helper;

/**
 * GenreController
 *
 * @author
 *
 * @version
 *
 */
class GenreController extends AbstractActionController
{

   /**   
     * Entity manager instance
     *           
     * @var Doctrine\ORM\EntityManager
     */                
    protected $em;
 
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
    
    
    public function indexAction()
    {    	
	    $em = $this->getEntityManager();
	    $data = $em->getRepository('Album\Entity\Genre')->findAll();
	    
	    
	    return new ViewModel(array(
	    		'results' => $data
	    ));
	     
    }
    public function dateconvert($dateOriginal)
    {
    	$dateOriginal = preg_replace("/[^0-9\/]/","",$dateOriginal); //sanitizing
    	$temp = explode("/",$dateOriginal);
    	$dateNew = $temp[2]."-".$temp[1]."-".$temp[0];
    	$dateNew = date("Y-m-d", strtotime($dateNew));
    	return $dateNew;
    }
    
    public function editAction()
    {
    	$id = (int) $this->params()->fromRoute('id', 0);
    	if (!$id) {
    		return $this->redirect()->toRoute('genre', array(
    				'action' => 'add'
    		));
    	}
    	
    	$genre = $this->getEntityManager()->find('Album\Entity\Genre', $id);
        $em = $this->getEntityManager();
    	         
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    	    $data = new Genre();
    	    $data->id = $id;
    		$data->title = $request->getPost()->title;
    		$this->getEntityManager()->merge($data);
    		$this->getEntityManager()->flush();
    		// Redirect to list of albums
    		return $this->redirect()->toRoute('genre');    		       	
    	}
    
    	return array(
    			'id' => $id,
    			'formdata' => $genre,
    	);
    }
    
     
    public function addAction()
    {
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    	    $genre = new Genre();    	    
    		$genre->title = $request->getPost()->title;
    	    $this->getEntityManager()->persist($genre);
    	    $this->getEntityManager()->flush();
    	    // Redirect to list of albums
    	    return $this->redirect()->toRoute('genre');
    	}
    	return array(
    		'title' => 'Add Genre',
    	);    
    }
    
    public function deleteAction()
    {           
        $id = (int)$this->getEvent()->getRouteMatch()->getParam('id');
        if (!$id) {
            return $this->redirect()->toRoute('album');
        } 
        $request = $this->getRequest();               
        if ($request->isPost()) {                    
            $del = $request->getpost()->del;            
            if ($del == 'Yes') {
                $id = (int)$request->getpost()->id;
                $genre = $this->getEntityManager()->find('Album\Entity\Genre', $id);
                
                if ($genre) {
                    $this->getEntityManager()->remove($genre);
                    $this->getEntityManager()->flush();
                }
            }             
            // Redirect to list of albums
            return $this->redirect()->toRoute('genre');
        }
 
        return array(
            'id' => $id,
            'genre' => $this->getEntityManager()->find('Album\Entity\Genre', $id)->getArrayCopy()
        );
    }
}