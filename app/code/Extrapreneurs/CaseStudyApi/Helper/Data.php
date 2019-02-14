<?php
namespace Extrapreneurs\CaseStudyApi\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    protected $_storeManager;
    protected $_scopeConfig;
    /**
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig

    ) {
        $this->_storeManager = $storeManager;
        $this->_scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

    public function getToken(){
                //Authentication rest API magento2.Please change url accordingly your url
        $adminUrl=$this->_storeManager->getStore()->getBaseUrl().'/rest/V1/integration/admin/token';
        $admin_username = $this->_scopeConfig->getValue('casestudyapi/general/admin_username');
        $admin_password = $this->_scopeConfig->getValue('casestudyapi/general/admin_password');
        $ch = curl_init();
        //Change username and password
        $data = array("username" => $admin_username, "password" => $admin_password);                                                                    
        $data_string = json_encode($data);                       
        $ch = curl_init($adminUrl); 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($data_string))                                                                       
        );       
        $token = curl_exec($ch);
        $token=  json_decode($token);  
    	return $token;
    }
}
