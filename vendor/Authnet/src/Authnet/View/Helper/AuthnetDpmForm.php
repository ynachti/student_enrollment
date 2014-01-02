<?php

namespace Authnet\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Authnet\Form\Creditc as TransactionForm;
use Zend\Authentication\AuthenticationService;
use Authnet\Controller\AuthnetController as authnetForm;
use Zend\View\Model\ViewModel;

class AuthnetDpmForm extends AbstractHelper {

    /**
     * Login Form
     * @var LoginForm
     */
    protected $transactionForm;

    /**
     * $var string template used for view
     */
    protected $viewTemplate = 'authnet/authnet/request.phtml';

    /**
     * __invoke
     *
     * @access public
     * @param array $options array of options
     * @return string
     */
    public function __invoke($options = array()) {
        //$vm = authnetForm::getMethodFromAction('Request');

        $vm = new ViewModel(
                array(
            'loginForm' => $this->getLoginForm(),
            'redirect' => $redirect,
                )
        );

        $vm->setTemplate($this->viewTemplate);

        return $this->getView()->render($vm);
    }

    /**
     * Retrieve Login Form Object
     * @return LoginForm
     */
    public function getLoginForm() {
        return $this->loginForm;
    }

    /**
     * Inject Login Form Object
     * @param LoginForm $loginForm
     * @return ZfcUserLoginWidget
     */
    public function setLoginForm(TransactionForm $loginForm) {
        $this->loginForm = $loginForm;
        return $this;
    }

    /**
     * @param string $viewTemplate
     * @return ZfcUserLoginWidget
     */
    public function setViewTemplate($viewTemplate) {
        $this->viewTemplate = $viewTemplate;
        return $this;
    }

}
