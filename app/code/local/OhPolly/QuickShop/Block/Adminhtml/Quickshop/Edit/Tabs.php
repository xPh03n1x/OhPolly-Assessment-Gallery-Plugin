<?php
class OhPolly_QuickShop_Block_Adminhtml_Quickshop_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs{
	public function __construct(){
		parent::__construct();
		$this->setId("quickshop_tabs");
		$this->setDestElementId("edit_form");
		$this->setTitle(Mage::helper("quickshop")->__("Image Details"));
	}

	protected function _beforeToHtml(){
		$this->addTab("form_section",array(
			"label"=>Mage::helper("quickshop")->__("Image Details"),
			"title"=> Mage::helper("quickshop")->__("Image Details"),
			"content"=>$this->getLayout()->createBlock("quickshop/adminhtml_quickshop_edit_tab_form")->toHtml(),
		));
		return parent::_beforeToHtml();
	}

}