<?php
class OhPolly_QuickShop_Block_Adminhtml_Quickshop extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct(){
		$this->_controller='adminhtml_quickshop';
		$this->_blockGroup='quickshop';
		$this->_headerText=Mage::helper('quickshop')->__('QuickShop Gallery Manager');
		$this->_addButtonLabel=Mage::helper('quickshop')->__('Add New Image');
		parent::__construct();
	}

}