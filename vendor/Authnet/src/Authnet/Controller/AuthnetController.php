<?php

/**
 * Description of AuthnetController
 *
 * @author yn
 * @role 
 */

namespace Authnet\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use \Authnet\lib\AuthorizeNetDPM as AuthDpm;
use Authnet\Options\ModuleOptions as ModOpt;

class AuthnetController extends AbstractActionController {

    protected $billingForm;
    protected $url = 'https://apps.ess.unlv.edu/transcriptrequest/';
    protected $amount = '5.00';         // change to the $ amount corresponding to the transaction
    protected $environment = 'sandbox';   // change to 'live' when in production or to sandbox for the test
    protected $Shipping;
    protected $bankform;
    protected $ccform;

    public function requestAction($setAmount = NULL, $url = NULL) {

        require_once '/usr/local/zend/apache2/htdocs/student_enrollment/vendor/Authnet/config/AuthorizeNet.php'; // The SDK

        $billing = $this->getBillingForm();
        $shipping = $this->getShippingForm();
        $ccform = $this->getccForm();
        $bankform = $this->getBankForm();
        $modopt = $this->getServiceLocator()->get('authnet_module_options');
        $dpm = new AuthDpm;

        return array(
            'Billing' => $billing,
            'Shipping' => $shipping,
            'Cc' => $ccform,
            'Bank' => $bankform,
            'form_vars' => $dpm->directPostDemo(
                    (isset($this->url) ? $this->url : $this->getUrl()), 
                    $modopt->getApiLoginId($this->environment), 
                    $modopt->getApiTransactionKey($this->environment), 
                    (($setAmount == NULL) ? $this->amount : $setAmount), 
                    $modopt->getApiMd5Settings($this->environment), 
                    $this->environment
            )
        );
    }

    public function getUrl() {
        // Get HTTP/HTTPS (the possible values for this vary from server to server)
        $Url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] && !in_array(strtolower($_SERVER['HTTPS']), array('off', 'no'))) ? 'https' : 'http';
        // Get domain portion
        $Url .= '://' . $_SERVER['HTTP_HOST'];
        // Get path to script
        $Url .= $_SERVER['REQUEST_URI'];
        // Add path info, if any
        if (!empty($_SERVER['PATH_INFO']))
            $Url .= $_SERVER['PATH_INFO'];
        // Add query string, if any 
        if (!empty($_SERVER['QUERY_STRING']))
            $Url .= '?' . ltrim($_SERVER['REQUEST_URI'], '?');

        return $Url;
    }

    public function receiptAction() {
        $request = $this->getRequest();
        if ($request->isPost()):
            $dpm->directPostDemo(
                    $url, 
                    $modopt->getApiLoginId($this->environment), 
                    $modopt->getApiTransactionKey($this->environment), 
                    $this->amount, 
                    $modopt->getApiMd5Settings($this->environment), 
                    $this->environment
            );
        endif;
    }
    
    public function getccForm() {
        if (!$this->ccform) {
            $this->setccForm($this->getServiceLocator()->get('authnet_cc_form'));
        }
        return $this->ccform;
    }

    public function setccForm($ccForm) {
        $this->ccform = $ccForm;
        $fm = $this->flashMessenger()->setNamespace('authnet_cc_form')->getMessages();
        if (isset($fm[0])) {
            $this->ccform->setMessages(
                    array('identity' => array($fm[0]))
            );
        }
        return $this;
    }
    
    public function getBankForm() {
        if (!$this->bankform) {
            $this->setBankForm($this->getServiceLocator()->get('authnet_bank_form'));
        }
        return $this->bankform;
    }

    public function setBankForm($bankForm) {
        $this->bankform = $bankForm;
        $fm = $this->flashMessenger()->setNamespace('authnet_bank_form')->getMessages();
        if (isset($fm[0])) {
            $this->bankform->setMessages(
                    array('identity' => array($fm[0]))
            );
        }
        return $this;
    }
    
    public function getShippingForm() {
        if (!$this->Shipping) {
            $this->setShippingForm($this->getServiceLocator()->get('authnet_ship_form'));
        }
        return $this->Shipping;
    }

    public function setShippingForm($shippingForm) {
        $this->Shipping = $shippingForm;
        $fm = $this->flashMessenger()->setNamespace('authnet_ship_form')->getMessages();
        if (isset($fm[0])) {
            $this->Shipping->setMessages(
                    array('identity' => array($fm[0]))
            );
        }
        return $this;
    }

    public function getBillingForm() {
        if (!$this->billingForm) {
            $this->setBillingForm($this->getServiceLocator()->get('authnet_dpm_form'));
        }
        return $this->billingForm;
    }

    public function setBillingForm($billingForm) {
        $this->billingForm = $billingForm;
        $fm = $this->flashMessenger()->setNamespace('authnet_dpm_form')->getMessages();
        if (isset($fm[0])) {
            $this->billingForm->setMessages(
                    array('identity' => array($fm[0]))
            );
        }
        return $this;
    }
}

?>
