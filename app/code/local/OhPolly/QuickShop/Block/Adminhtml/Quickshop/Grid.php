<?php
class OhPolly_QuickShop_Block_Adminhtml_Quickshop_Grid extends Mage_Adminhtml_Block_Widget_Grid{

	public function __construct(){
		parent::__construct();
		$this->setId("quickshopGrid");
		$this->setDefaultSort("id");
		$this->setDefaultDir("DESC");
		$this->setSaveParametersInSession(true);
	}

	protected function _prepareCollection(){
		$collection=Mage::getModel("quickshop/quickshop")->getCollection();
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}

	protected function _prepareColumns(){
		$this->addColumn("id",array(
			"header"=>Mage::helper("quickshop")->__("ID"),
			"align"=>"right",
			"width"=>"50px",
			"type"=>"number",
			"index"=>"id"
		));

		$this->addColumn("image_name",array(
			"header"=>Mage::helper("quickshop")->__("Image"),
			"align"=>"center",
			"width"=>"100px",
			"type"=>"image",
			"index"=>"image_name",
			"escape"=>true,
			"sortable"=>false,
			"filter"=>false,
			"renderer"=>Mage::getBlockSingleton('OhPolly_QuickShop_Block_Adminhtml_Quickshop_Grid_Image_Renderer') 
		));

		$this->addColumn("link",array(
			"header"=>Mage::helper("quickshop")->__("URL target"),
			"index"=>"link"
		));
		return parent::_prepareColumns();
	}

	public function getRowUrl($row){
		return $this->getUrl("*/*/edit",array("id"=>$row->getId()));
	}

	protected function _prepareMassaction(){
		$this->setMassactionIdField('id');
		$this->getMassactionBlock()->setFormFieldName('ids');
		$this->getMassactionBlock()->setUseSelectAll(true);
		$this->getMassactionBlock()->addItem('remove_quickshop',array(
			'label'=>Mage::helper('quickshop')->__('Delete Selected Images'),
			'url'=>$this->getUrl('*/adminhtml_quickshop/massRemove'),
			'confirm'=>Mage::helper('quickshop')->__('Are you sure you want to remove the selected images?')
		));
		return $this;
	}
}

class OhPolly_QuickShop_Block_Adminhtml_Quickshop_Grid_Image_Renderer extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract{

	public function render(Varien_Object $row){
		return '<img width="100" src="'.str_replace("\\","/",Mage::getBaseUrl('media').$row['image_name']).'" />';
	}

}