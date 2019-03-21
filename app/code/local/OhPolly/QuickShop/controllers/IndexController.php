<?php
class OhPolly_QuickShop_IndexController extends Mage_Core_Controller_Front_Action{

	protected $perPage;
	protected $totalPages;

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
		$gallery=Mage::getModel("quickshop/quickshop")->getCollection()->setPageSize($this->perPage);
		$this->totalPages=$gallery->getLastPageNumber();

		$this->getLayout()->getBlock('quickshop_index')->setQuickShopGallery($gallery->setCurPage(1));
		$this->getLayout()->getBlock('quickshop_index')->setGalleryPages($this->totalPages);

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
		$gallery=Mage::getModel("quickshop/quickshop")->getCollection()->setPageSize($this->perPage)->setCurPage($_POST['getQuickShopPage']);
		$return=array();
		foreach($gallery as $k=>$img){
			array_push($return,array('img'=>$img->getImageName(),'link'=>$img->getLink()));
		}
		echo json_encode($return);
	}
}