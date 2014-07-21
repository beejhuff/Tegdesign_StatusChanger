<?php
class Tegdesign_StatusChanger_Adminhtml_SwitchController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction($observer)
    {

		$post = $this->getRequest()->getPost();
		
		try {

			if (empty($post)) {
				Mage::throwException($this->__('Nothing selected'));
			}

			if (!isset($post['order_ids'])) {
				Mage::throwException($this->__('No order ids found'));
			}

			$order_ids = $post['order_ids'];

			foreach ($order_ids as $order_id) {
				
				$order = Mage::getModel("sales/order")->load($order_id);
				$order->setState(Mage_Sales_Model_Order::STATE_PROCESSING,'processing','Order status switched using admin')->save();

			}

			$message = $this->__('Status changed successfully!');
			Mage::getSingleton('adminhtml/session')->addSuccess($message);

		} catch (Exception $e) {
			Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
		}

		$this->_redirect('*/*');

    }

}