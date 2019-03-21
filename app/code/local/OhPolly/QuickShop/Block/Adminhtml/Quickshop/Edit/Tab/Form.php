<?php
class OhPolly_QuickShop_Block_Adminhtml_Quickshop_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form{
	protected function _prepareForm(){
		$form=new Varien_Data_Form();
		$this->setForm($form);
		$fieldset=$form->addFieldset("quickshop_form",array("legend"=>Mage::helper("quickshop")->__("Image Details")));

		$fieldset->addField('image_name','image',array(
			'label'=>Mage::helper('quickshop')->__('Image'),
			'name' =>'image_name',
			'note'=>'(*.jpg,*.png,*.gif)'
		));
		$fieldset->addField("link","text",array(
			"label"=>Mage::helper("quickshop")->__("URL target"),
			"class" =>"required-entry",
			"required"=>true,
			"name"=>"link"
		));

		if(Mage::getSingleton("adminhtml/session")->getQuickshopData()){
			$form->setValues(Mage::getSingleton("adminhtml/session")->getQuickshopData());
			Mage::getSingleton("adminhtml/session")->setQuickshopData(null);
		} 
		elseif(Mage::registry("quickshop_data")){
			$form->setValues(Mage::registry("quickshop_data")->getData());
		}

		return parent::_prepareForm();
	}
}