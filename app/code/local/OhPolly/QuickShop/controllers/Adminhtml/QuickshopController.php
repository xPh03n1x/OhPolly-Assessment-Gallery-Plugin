<?php
class OhPolly_QuickShop_Adminhtml_QuickshopController extends Mage_Adminhtml_Controller_Action{
	protected function _isAllowed(){
		return Mage::getSingleton('admin/session')->isAllowed('quickshop/quickshop');
	}

	protected function _initAction(){
		$this->loadLayout()->_setActiveMenu('cms')->_addBreadcrumb(Mage::helper('adminhtml')->__('QuickShop Gallery Manager'),Mage::helper('adminhtml')->__('QuickShop Gallery Manager'));
		return $this;
	}

	public function indexAction(){
		$this->_title($this->__('QuickShop Gallery'));
		$this->_initAction();
		$this->renderLayout();
	}

	public function editAction(){
		$this->_title($this->__('QuickShop Gallery'));
		$this->_title($this->__('Edit Image'));

		$id=$this->getRequest()->getParam('id');
		$model=Mage::getModel('quickshop/quickshop')->load($id);
		if($model->getId()){
			Mage::register('quickshop_data',$model);
			$this->loadLayout();
			$this->_setActiveMenu('cms');
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('QuickShop Gallery Manager'),Mage::helper('adminhtml')->__('QuickShop Gallery Manager'));
			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
			$this->_addContent($this->getLayout()->createBlock('quickshop/adminhtml_quickshop_edit'))->_addLeft($this->getLayout()->createBlock('quickshop/adminhtml_quickshop_edit_tabs'));
			$this->renderLayout();
		}
		else{
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('quickshop')->__('Item does not exist.'));
			$this->_redirect("*/*/");
		}
	}

	public function newAction(){
		$this->_title($this->__('QuickShop Gallery'));
		$this->_title($this->__('New Image'));

		$id=$this->getRequest()->getParam('id');
		$model=Mage::getModel('quickshop/quickshop')->load($id);
		$data=Mage::getSingleton('adminhtml/session')->getFormData(true);
		if(!empty($data)){$model->setData($data);}

		Mage::register('quickshop_data',$model);

		$this->loadLayout();
		$this->_setActiveMenu('quickshop/quickshop');

		$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

		$this->_addBreadcrumb(Mage::helper('adminhtml')->__('QuickShop Gallery Manager'),Mage::helper('adminhtml')->__('QuickShop Gallery Manager'));

		$this->_addContent($this->getLayout()->createBlock('quickshop/adminhtml_quickshop_edit'))->_addLeft($this->getLayout()->createBlock('quickshop/adminhtml_quickshop_edit_tabs'));

		$this->renderLayout();
	}

	public function saveAction(){
		$post_data=$this->getRequest()->getPost();
		if($post_data){
			try{
				//save image
				try{
					if((bool)$post_data['image_name']['delete']==1){$post_data['image_name']='';}
					else{
						unset($post_data['image_name']);
						if(isset($_FILES)){
							if($_FILES['image_name']['name']){
								if($this->getRequest()->getParam('id')){
									$model=Mage::getModel('quickshop/quickshop')->load($this->getRequest()->getParam('id'));
									if($model->getData('image_name')){
										$io=new Varien_Io_File();
										$io->rm(Mage::getBaseDir('media').DS.implode(DS,explode('/',$model->getData('image_name'))));
									}
								}

								$path=Mage::getBaseDir('media').DS.'quickshop'.DS.'quickshop'.DS;
								$uploader=new Varien_File_Uploader('image_name');
								$uploader->setAllowedExtensions(array('jpg','png','gif'));
								$uploader->setAllowRenameFiles(false);
								$uploader->setFilesDispersion(false);
								$destFile=$path.$_FILES['image_name']['name'];
								$filename=$uploader->getNewFileName($destFile);
								$uploader->save($path,$filename);

								$post_data['image_name']='quickshop/quickshop/'.$filename;
							}
						}
					}
				}
				catch(Exception $e){
					Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
					$this->_redirect('*/*/edit',array('id'=>$this->getRequest()->getParam('id')));
					return;
				}


				//save image
				$model=Mage::getModel('quickshop/quickshop')
					->addData($post_data)
					->setId($this->getRequest()->getParam('id'))
					->save();

				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Image was successfully saved to the QuickShop Gallery!'));
				Mage::getSingleton('adminhtml/session')->setQuickshopData(false);

				if($this->getRequest()->getParam("back")){
					$this->_redirect('*/*/edit',array('id'=>$model->getId()));
					return;
				}
				$this->_redirect('*/*/');
				return;
			}
			catch(Exception $e){
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				Mage::getSingleton('adminhtml/session')->setQuickshopData($this->getRequest()->getPost());
				$this->_redirect('*/*/edit',array('id'=>$this->getRequest()->getParam('id')));
				return;
			}
		}
		$this->_redirect('*/*/');
	}

	public function deleteAction(){
		if($this->getRequest()->getParam('id')>0){
			try{
				$model=Mage::getModel('quickshop/quickshop');
				$model->setId($this->getRequest()->getParam('id'))->delete();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('The image was successfully deleted from the QuickShop Gallery!'));
				$this->_redirect('*/*/');
			}
			catch(Exception $e){
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit',array('id'=>$this->getRequest()->getParam('id')));
			}
		}
		$this->_redirect('*/*/');
	}

	public function massRemoveAction(){
		try{
			$ids=$this->getRequest()->getPost('ids',array());
			foreach($ids as $id){
				$model=Mage::getModel('quickshop/quickshop');
				$model->setId($id)->delete();
			}
			Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Image(s) were successfully removed!'));
		}
		catch(Exception $e){
			Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
		}
		$this->_redirect('*/*/');
	}
}