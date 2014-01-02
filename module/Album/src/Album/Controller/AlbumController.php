<?php

namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Album\Form\AlbumForm;
use Doctrine\ORM\EntityManager;
use Album\Entity\Album;
use Doctrine\DBAL\Driver\OCI8\OCI8Connection;
use Doctrine\ORM\Query\ResultSetMapping;
use Zend\Form\Element\DateTime;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Form\View\Helper;
use ZfcDatagrid\Column;
use ZfcDatagrid\Column\Type;
use ZfcDatagrid\Column\Style;

class AlbumController extends AbstractActionController {

    /**
     * Entity manager instance
     *           
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;

    public function setEntityManager(EntityManager $em) {
        $this->em = $em;
    }

    public function getEntityManager() {

        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->em;
    }

    public function getGrid() {
        $em = $this->getEntityManager();
        $request = $this->getRequest();
        #$data = $em->getRepository('Album\Entity\Album')->findAll();
        
        $query = $em->createQuery("SELECT u.id, u.artist, u.title, u.genre FROM Album\Entity\Album u");
//        echo '<pre>';
//        print_r($query);        echo '</pre>';
//        exit;
        $data = $query->getResult();
        $dataGrid = $this->getServiceLocator()->get('zfcDatagrid');

        $dataGrid->setTitle('Albums');
        $dataGrid->setDefaultItemsPerPage(5);
        #$dataGrid->setRowClickLink('/album/edit');
        $dataGrid->setDataSource($data);

        $action = new Column\Action\Button();
        $action->setLabel('Edit');
        $action->setAttribute('href', 'album/edit/' . $action->getRowIdPlaceholder());

        #$action->setAttribute('Style\Color', Style\Color::$RED);

        $col = new Column\Action();
        $col->setLabel('Actions');
        $col->setWidth(10);
        $col->addAction($action);
        $dataGrid->addColumn($col);

        #$dataGrid->setRowClickAction($action);

        $col = new Column\Standard('id');
        $col->setIdentity();
        $dataGrid->addColumn($col);

        $col = new Column\Standard('artist');
        $col->setLabel('Artist');
        $col->setWidth(25);
        $col->setSortDefault(1, 'ASC');
        $col->addStyle(new Style\Bold());
        $dataGrid->addColumn($col);

        $col = new Column\Standard('title');
        $col->setLabel('Title');
        $col->setWidth(15);
        $dataGrid->addColumn($col);

        $col = new Column\Standard('genre');
        $col->setLabel('Genre');
        $col->setWidth(15);
        $dataGrid->addColumn($col);
        $dataGrid->setDataSource($data);

        return $dataGrid;
    }

    public function indexAction() {
        $em = $this->getEntityManager();
        $request = $this->getRequest();
        $dataGrid = $this->getGrid();
        $dataGrid->execute();
        return $dataGrid->getResponse();
    }

    public function indexOldAction() {
        $em = $this->getEntityManager();
        $request = $this->getRequest();
        #$data = $em->getRepository('Album\Entity\Album')->findAll();
        #$srchStr = '';
        $dataGrid = $this->getGrid();

        $dataGrid->execute();

        if ($request->isPost()) {
            if (strlen($request->getPost()->searchStr) >= 1) {

                $srchStr = $request->getPost()->searchStr;
                #$srchStr = $request->getPost()->searchStr;
                $query = $em->createQuery("SELECT u FROM Album\Entity\Album u WHERE upper(u.title) LIKE :title OR upper(u.artist) LIKE :artist ");
                $query->setParameters(array(
                    'title' => strtoupper($srchStr) . "%",
                    'artist' => strtoupper($srchStr) . "%",
                ));
                $data = $query->getResult();
            } else {
                $data = $em->getRepository('Album\Entity\Album')->findAll();
            }
        }
        return $dataGrid->getResponse();
        #return new ViewModel(array(
        # 		'albums' => $data,
        #         'srchStr' => $srchStr,
        #
    	            # ));
    }

    public function dateconvert($dateOriginal) {
        $dateOriginal = preg_replace("/[^0-9\/]/", "", $dateOriginal); //sanitizing
        $temp = explode("/", $dateOriginal);
        $dateNew = $temp[2] . "-" . $temp[1] . "-" . $temp[0];
        $dateNew = date("Y-m-d", strtotime($dateNew));
        return $dateNew;
    }

    public function editAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('album', array(
                        'action' => 'add'
            ));
        }

        $album = $this->getEntityManager()->find('Album\Entity\Album', $id);

        $em = $this->getEntityManager();
        $genre = $em->getRepository('Album\Entity\Genre')->findAll();
        $request = $this->getRequest();

        if ($request->isPost()) {
            $data = new Album();
            $data->id = $id;
            $data->title = $request->getPost()->title;
            $data->artist = $request->getPost()->artist;
            $data->genre = $request->getPost()->genre;

            $format = "D M d Y H:i:s +";
            $datestr = $request->getPost()->date_release;

            die(var_dump($request->getPost()));

            #$data->date_release = $datestr;
            #$data->date_release = dateconvert($datestr.date($format));
            #$dataStr = $datestr.date($format);
            #$data->date_release = new \DateTime("now");
            #$data->date_release = DateTime("2011-08-01 00:00:00");    		
            #die(var_dump($data->date_release.date($format) ));

            $this->getEntityManager()->merge($data);
            $this->getEntityManager()->flush();
            // Redirect to list of albums
            return $this->redirect()->toRoute('album');
        }

        return array(
            'id' => $id,
            'album' => $album,
            'genre' => $genre,
        );
    }

    public function addAction() {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $album = new Album();
            $album->title = $request->getPost()->title;
            $album->artist = $request->getPost()->artist;
            $this->getEntityManager()->persist($album);
            $this->getEntityManager()->flush();
            // Redirect to list of albums
            return $this->redirect()->toRoute('album');
        }
        return array(
            'title' => 'Add Album',
        );
    }

    public function deleteAction() {
        $id = (int) $this->getEvent()->getRouteMatch()->getParam('id');
        if (!$id) {
            return $this->redirect()->toRoute('album');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getpost()->del;
            if ($del == 'Yes') {
                $id = (int) $request->getpost()->id;
                $album = $this->getEntityManager()->find('Album\Entity\Album', $id);

                if ($album) {
                    $this->getEntityManager()->remove($album);
                    $this->getEntityManager()->flush();
                }
            }
            // Redirect to list of albums
            return $this->redirect()->toRoute('album');
        }

        return array(
            'id' => $id,
            'album' => $this->getEntityManager()->find('Album\Entity\Album', $id)->getArrayCopy()
        );
    }

    public function exportAction() {
        $this->helper->layout()->disableLayout();
        $this->helper->viewRenderer->setNoRender(true);

        $this->tbl = new Contacts();
        $xlsTbl = $this->tbl->exportData();

        header("Content-Type: application/vnd.ms-excel");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("content-disposition: attachment;filename=download.xls");

        echo "<table>$xlsTbl</table>";
    }

    public function exportData() {

        $em = $this->getEntityManager();
        $request = $this->getRequest();
        $result = $em->getRepository('Album\Entity\Album')->findAll();


        $xlsTbl = "<tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Region</th><th>Enquiry Type</th><th>Telephone</th><th>Message</th><th>Type</th></tr>";
        foreach ($result as $key => $val) {
            $xlsTbl .= "<tr>";
            $xlsTbl .= "<td>" . $val->artist . "</td>";
            $xlsTbl .= "<td>" . $val->title . "</td>";
            $xlsTbl .= "<td>" . $val->genre . "</td>";
            $xlsTbl .= "</tr>";
        }

        return $xlsTbl;
    }

    public function exportXlsAction() {
        set_time_limit(0);

        $em = $this->getEntityManager();
        $request = $this->getRequest();
        $data = $em->getRepository('Album\Entity\Album')->findAll();
        $applicationPath = getcwd();
        $my_folder = dirname(realpath(__FILE__)) . DIRECTORY_SEPARATOR;
        #die(var_dump($my_folder)); 

        $filename = $my_folder . "\tmp\excel.xls";

        $realPath = realpath($filename);

        if (false === $realPath) {
            touch($filename);
            chmod($filename, 0777);
        }

        $filename = realpath($filename);
        $handle = fopen($filename, "w");
        $finalData = array();

        foreach ($data AS $row) {
            $finalData[] = array(
                utf8_decode($row["col1"]), // For chars with accents.
                utf8_decode($row["col2"]),
                utf8_decode($row["col3"]),
            );
        }

        foreach ($finalData AS $finalRow) {
            fputcsv($handle, $finalRow, "\t");
        }

        fclose($handle);

        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $this->getResponse()->setRawHeader("Content-Type: application/vnd.ms-excel; charset=UTF-8")
                ->setRawHeader("Content-Disposition: attachment; filename=excel.xls")
                ->setRawHeader("Content-Transfer-Encoding: binary")
                ->setRawHeader("Expires: 0")
                ->setRawHeader("Cache-Control: must-revalidate, post-check=0, pre-check=0")
                ->setRawHeader("Pragma: public")
                ->setRawHeader("Content-Length: " . filesize($filename))
                ->sendResponse();

        readfile($filename);
        unlink($filename);

        exit();
    }

}