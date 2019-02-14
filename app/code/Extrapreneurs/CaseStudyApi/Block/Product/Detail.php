<?php


namespace Extrapreneurs\CaseStudyApi\Block\Product;

class Detail extends \Magento\Framework\View\Element\Template
{

    protected  $_helperData;
    protected $_storeManager;
    protected $_request;
    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Extrapreneurs\CaseStudyApi\Helper\Data $helperData,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\Request\Http $request,
        array $data = []
    ) {
                $this->_helperData = $helperData;
                $this->_request = $request;
                parent::__construct($context, $data);
    }

    public function getProductDetail(){

        $id = $this->_request->getParam('id');

        $token = $this->_helperData->getToken();
        $headers = array("Authorization: Bearer $token");

        //$requestUrl=$this->_storeManager->getStore()->getBaseUrl()."/rest/all/V1/products/sku_aa1";
        $requestUrl=$this->_storeManager->getStore()->getBaseUrl()."/rest/V1/products/id/$id";
        $ch = curl_init();
        $ch = curl_init($requestUrl); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   
        $result = curl_exec($ch);
        $result=  json_decode($result);
        return $result;
    }
}
