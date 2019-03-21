<?php
	
class OhPolly_QuickShop_Block_Adminhtml_Quickshop_Edit extends Mage_Adminhtml_Block_Widget_Form_Container{

	public function __construct(){
		parent::__construct();
		$this->_objectId="id";
		$this->_blockGroup="quickshop";
		$this->_controller="adminhtml_quickshop";
		$this->_updateButton("save","label",Mage::helper("quickshop")->__("Save"));
		$this->_updateButton("delete","label",Mage::helper("quickshop")->__("Delete"));

		// If we also wanted to add "Save and Continue" we can use:
		// $this->_addButton("saveandcontinue",array(
		// 	"label"=>Mage::helper("quickshop")->__("Save Changes And Continue Editing"),
		// 	"onclick"=>"saveAndContinueEdit()",
		// 	"class"=>"save",
		// 	),-100);

		// $this->_formScripts[]="function saveAndContinueEdit(){editForm.submit($('edit_form').action+'back/edit/');}";
	}

	public function getHeaderText(){
		if(Mage::registry("quickshop_data")&&Mage::registry("quickshop_data")->getId()){
			return Mage::helper("quickshop")->__("Edit Image #'%s'", $this->htmlEscape(Mage::registry("quickshop_data")->getId()));
		}
		else{return Mage::helper("quickshop")->__("Add Image");}
	}
}