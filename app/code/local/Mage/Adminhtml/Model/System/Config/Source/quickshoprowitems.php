<?php
class Mage_Adminhtml_Model_System_Config_Source_quickshoprowitems{
	public function toOptionArray(){
		return array(
			array('value'=>1,'label'=>Mage::helper('adminhtml')->__('Three')),
			array('value'=>2,'label'=>Mage::helper('adminhtml')->__('Four')),
		);
	}
}