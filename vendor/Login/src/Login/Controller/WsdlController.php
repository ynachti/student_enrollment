<?php

/**
 * Description of WsdlController
 * @wsdl step 1
 * uses cre:UNL_FIELD1 for user with the values of (nshe, ssn, L#)
 * uses cre:UNL_FIELD3 for field type with values (S->Social#, L-> L#, N->NSHEID)
 * uses cre:UNL_AUTH_TYPE for the authorization type (ST -> student)
 * uses cre:UNL_APP_TYPE for the application type (IOSAUTH for testing)
 * uses cre:UNL_KEY each application has its own key and APP_TYPE (IOSAUTH key = yQsBWE7rFpgMh9HzDTnA)
 * returns the cre:UNL_AUTH_NBR
 * wsdl step 2 - uses the cre:UNL_AUTH_NBR and returns the data
 * @author yn
 */

namespace Login\Controller;

use Zend\Soap\Client as Client;
use Zend\Soap\AutoDiscover as AutoDiscover;

class WsdlController {
    protected $app_type;
    protected $wsdl;

    const UNL_AUTH_NBR = NULL;
    const UNL_AUTH_TYPE = 'ST';
    //const UNL_APP_TYPE = 'IOSAUTH';
    const UNL_KEY = 'yQsBWE7rFpgMh9HzDTnA';
    const UNL_AUTH_FLG = NULL;

    public function __construct($enviro, $app) {
        $wsdl = $this->setWsdl($enviro);
        $app_type = $this->setAppType($app);
    }

    public function getWsdlResponse($unl_field1, $unl_field3) {
        ini_set("soap.wsdl_cache_enabled", "0");
        $wsdl = "https://css-tst.unlv.nevada.edu/PSIGW/PeopleSoftServiceListeningConnector/CI_UNLAUTH_STD.1.wsdl";

        $parameters = array(
            'UNL_FIELD1' => $unl_field1,
            'UNL_FIELD3' => $unl_field3,
            'UNL_AUTH_NBR' => self::UNL_AUTH_NBR,
            'UNL_AUTH_TYPE' => self::UNL_AUTH_TYPE,
            'UNL_APP_TYPE' => $this->app_type,
            'UNL_KEY' => self::UNL_KEY,
            'UNL_AUTH_FLG' => self::UNL_AUTH_FLG
        );
        $options = array('compression' => SOAP_COMPRESSION_ACCEPT, 'cache_wsdl' => 0);
        $client = new Client($this->wsdl, $options);
        $request = $client->CI_UNLAUTH_STD_C($parameters);

        //wsdl step 2 - uses the cre:UNL_AUTH_NBR and returns the data  
        $response = $client->CI_UNLAUTH_STD_G(array('UNL_AUTH_NBR' => $request->detail->UNLAUTH_STD->UNL_AUTH_NBR->_));

        return $response;
    }

    public function setWsdl($enviro) {
        if ($enviro === 'test'):
            $this->wsdl = "https://css-tst.unlv.nevada.edu/PSIGW/PeopleSoftServiceListeningConnector/CI_UNLAUTH_STD.1.wsdl";            
        endif;
        return $this->wsdl;
    }
    
    public function setAppType($app=NULL){
        switch ($app) {
                case 'tranreq':
                    $this->app_type = 'IOSAUTH';
                    break;
                default:
                    $this->app_type = 'IOSAUTH';
                    break;
            }
    return $this->app_type;
            
        }
}
?>