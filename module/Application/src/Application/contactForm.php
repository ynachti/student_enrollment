<?php
namespace Application;

use Zend\Form\Form,
	Zend\Captcha\AdapterInterface as CaptchaAdapter;



class ContactForm extends Form
{
	protected $captchaAdapter;
	/* (non-PHPdoc)
	 * @see \Zend\Form\Fieldset::__clone()
	 */
	public function __construct($captchaAdapter = NULL)
	{
		// TODO: Auto-generated method stub
		if ($captchaAdapter instanceof CaptchaAdapter) {
			$this->setCaptchaAdapter($captchaAdapter);
			parent::__construct(null);
			return;
		}
	}
	protected function setCaptchaAdapter(CaptchaAdapter $captcha){
		$this->captchaAdapter = $captcha;
	}

}