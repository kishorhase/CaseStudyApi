<?php


namespace Extrapreneurs\CaseStudyApi\Block\Product;

class Save extends \Magento\Framework\View\Element\Template
{

    protected  $_helperData;
    protected $_storeManager;
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
        array $data = []
    ) {
                $this->_helperData = $helperData;
        parent::__construct($context, $data);
    }

    public function saveProduct(){

        $post = (array) $this->getRequest()->getPost();

         $post = (array) $this->getRequest()->getPost();
        

        if (!empty($post)) {

            $token = $this->_helperData->getToken();

            $sku = $post['sku'];
            $name = $post['product_name'];
            $price = $post['price'];
            $weight = $post['weight'];
            $inventory_stock = $post['stock'];
            $description = $post['description'];
            $short_description = $post['description'];

            $sampleProductData = array(
                'sku'               => $sku,
                'name'              => $name,
                'visibility'        => 4,
                'type_id'           => 'simple',
                'price'             => $price,
                'status'            => 1,
                'attribute_set_id'  => 4,
                'weight'            => $weight,
                'extension_attributes' => array(
                        "stock_item"=>array(
                                'qty' => $inventory_stock,'is_in_stock' => 1,'manage_stock' => 1,'use_config_manage_stock' => 1,'min_qty' => 0,'use_config_min_qty' => 1,'min_sale_qty' => 1,'use_config_min_sale_qty' => 1,'max_sale_qty ' => 10,'use_config_max_sale_qty' => 1,'is_qty_decimal' => 0,'backorders' => 0,'use_config_backorders' => 1,'notify_stock_qty' => 1,'use_config_notify_stock_qty' => 1
                        ),
                ),
                'custom_attributes' => array(
                    array( 'attribute_code' => 'description', 'value' => $description ),
                    array( 'attribute_code' => 'short_description', 'value' => $short_description ),
                ),
            );

            $productData = json_encode(array('product' => $sampleProductData));
            $headers = array('Content-Type:application/json','Authorization:Bearer '.$token);

            $requestUrl=$this->_storeManager->getStore()->getBaseUrl()."rest/V1/products";
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL, $requestUrl);
            curl_setopt($ch,CURLOPT_POSTFIELDS, $productData);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            return json_decode($response);
        }else{
           return null; 
        }
    }

    public function getFormAction(){
        return $this->_storeManager->getStore()->getBaseUrl().'casestudyapi/product/save';
    }
}
