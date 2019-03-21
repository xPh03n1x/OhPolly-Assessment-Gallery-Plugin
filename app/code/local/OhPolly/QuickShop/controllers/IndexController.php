<?php
class OhPolly_QuickShop_IndexController extends Mage_Core_Controller_Front_Action{

	protected $perPage;

	protected function _construct(){
		// Get the module's setting for pagination
		$this->perPage=Mage::getStoreConfig('quickshop/settings/page_items');

		// Filter out POST requests so we can support AJAX calls
		if(isset($_POST)&&isset($_POST['getQuickShopPage'])){
			$this->ajaxRequest();
			exit;
		}
	}

	public function IndexAction(){
		$this->loadLayout();   
		$pageTitle=Mage::getStoreConfig('quickshop/settings/page_title');
		$this->getLayout()->getBlock("head")->setTitle($this->__($pageTitle));

		$this->getLayout()->getBlock('quickshop_index')->setQuickShopGallery(
				Mage::getModel("quickshop/quickshop")->getCollection()->setPageSize($this->perPage)->setCurPage(1)
			);

		// Display breadcrumbs only if the setting is enabled through the admin panel
		if(Mage::getStoreConfig('quickshop/settings/page_breadcrumbs')){
			$breadcrumbs=$this->getLayout()->getBlock("breadcrumbs");
			$breadcrumbs->addCrumb("home",array(
				"label"=>$this->__("Home Page"),
				"title"=>$this->__("Home Page"),
				"link"=>Mage::getBaseUrl()
			));
			$breadcrumbs->addCrumb("quickshop",array(
				"label"=>$this->__($pageTitle),
				"title"=>$this->__($pageTitle)
			));
		}

		$this->renderLayout();
	}

	private function ajaxRequest(){
		$gallery=Mage::getModel("quickshop/quickshop")->getCollection()->setPageSize($this->perPage)->setCurPage(1);
		echo "Hello there!";
	}
}