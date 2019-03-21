<?php
class OhPolly_QuickShop_Adminhtml_QuickshopbackendController extends Mage_Adminhtml_Controller_Action{

	protected function _isAllowed(){
		return true;
	}

	public function indexAction(){
		$this->loadLayout();
		$this->_title($this->__("QuickShop Management"));
		$this->renderLayout();
	}
}