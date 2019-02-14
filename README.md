Consideration : Magento 2.2 instlled with the sample data.

Installation :

    1) Extract ZIP file and copy & paste in magento document root 

    2) Enter the following commands to the magento document root to enable module:

	    php bin/magento module:enable Extrapreneurs_CaseStudyApi
	    php bin/magento setup:upgrade
	    php bin/magento cache:clean

	 3) Login magento admin panel and enter the configuration, this configuration is used for the token base authendication.
	 Path : Store->Configuration->Extrapreneurs->CaseStudyApi

Execution :

	1. To get All the product with offset and pagenation, access following url. 

	<MAGENTO BASE URL>/casestudyapi/product/index/currentpage/<CURRENT PAGE>/pagesize/<OFFSET>          

	e.g. http://example.com/casestudyapi/product/index/currentpage/1/pagesize/3

	

	2. To get product details base on product id, access following url.
	
	<MAGENTO BASE URL>/casestudyapi/product/detail/id/<PRODUCT ID>

	e.g. http://example.com/casestudyapi/product/detail/id/3



	3.To post the new product, access the following url and fill the product details and submit the form.

	<MAGENTO BASE URL>/casestudyapi/product/save

	e.g. http://example.com/casestudyapi/product/save
