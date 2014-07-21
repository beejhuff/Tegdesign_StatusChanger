<?php
class Tegdesign_StatusChanger_Model_Observer
{
    public function addMassAction($observer)
    {
        $block = $observer->getEvent()->getBlock();
        if(get_class($block) =='Mage_Adminhtml_Block_Widget_Grid_Massaction'
            && $block->getRequest()->getControllerName() == 'sales_order')
        {
            $block->addItem('statuschanger', array(
                'label' => 'Switch to Processing',
                'url' => Mage::app()->getStore()->getUrl('statuschanger/adminhtml_switch'),
                'confirm'  => 'Are you sure?'
            ));
        }
    }
}