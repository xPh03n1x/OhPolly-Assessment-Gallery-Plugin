<?php
class OhPolly_QuickShop_Model_Mysql4_Quickshop extends Mage_Core_Model_Mysql4_Abstract{
	protected function _construct(){
		$this->_init('quickshop/quickshop','id');
	}
}