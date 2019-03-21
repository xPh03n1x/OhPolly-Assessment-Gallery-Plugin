<?php
class OhPolly_QuickShop_IndexController extends Mage_Core_Controller_Front_Action{

	public function IndexAction(){
		$this->loadLayout();   
		$this->getLayout()->getBlock("head")->setTitle($this->__("QuickShop"));

		$breadcrumbs=$this->getLayout()->getBlock("breadcrumbs");
		$breadcrumbs->addCrumb("home",array(
			"label"=>$this->__("Home Page"),
			"title"=>$this->__("Home Page"),
			"link"=>Mage::getBaseUrl()
		));
		$breadcrumbs->addCrumb("quickshop",array(
			"label"=>$this->__("QuickShop"),
			"title"=>$this->__("QuickShop")
		));

		$this->renderLayout();
	}
}