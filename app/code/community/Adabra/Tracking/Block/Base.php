<?php
class Adabra_Tracking_Block_Base extends Adabra_Tracking_Block_Abstract
{
    /**
     * Get document's title
     * @return string
     */
    public function getDocumentTitle()
    {
        return $this->getLayout()->getBlock('head')->getTitle();
    }

    /**
     * Get user ID
     * @return int
     */
    public function getSiteUserId()
    {
        $helperCustomer = Mage::helper('customer');
        if ($helperCustomer->isLoggedIn()) {
            return $helperCustomer->getCustomer()->getId();
        }

        return 0;
    }

    /**
     * Get document's language
     * @return string
     */
    public function getLanguage()
    {
        return substr(Mage::app()->getLocale()->getLocaleCode(), 0, 2);
    }

    /**
     * Get site ID
     * @return string
     */
    public function getSiteId()
    {
        return Mage::helper('adabra_tracking')->getSiteId();
    }

    /**
     * Get catalog ID
     * @return string
     */
    public function getCatalogId()
    {
        return Mage::helper('adabra_tracking')->getCatalogId();
    }

    /**
     * Get adabra tracking host
     * @return string
     */
    public function getAdabraTrackingHost()
    {
        return Mage::helper('adabra_tracking')->getAdabraTrackingHost();
    }

    /**
     * Return cart products information
     * @return array
     */
    public function getCartProductInfo()
    {


        $quote = Mage::getSingleton('checkout/cart')->getQuote();
        $quoteItems = $quote->getAllVisibleItems();

        $out = array(
            'ids' => array(),
            'qty' => array(),
        );

        foreach ($quoteItems as $quoteItem) {
            $out['ids'][] = $quoteItem->getSku();
            $out['qty'][] = $quoteItem->getQty();
        }

        return $out;
    }

    /**
     * Get tracking properties
     * @return array
     */
    public function getTrackingProperties()
    {
        $pageType = Mage::getSingleton('adabra_tracking/pagetype')->getCurrentPageType();

        $cartProductsInformation = $this->getCartProductInfo();

        $res = array(
            array('key' => 'setDocumentTitle', 'value' => $this->getDocumentTitle()),
            array('key' => 'setLanguage', 'value' => $this->getLanguage()),
            array('key' => 'setSiteId', 'value' => $this->getSiteId()),
            array('key' => 'setCatalogId', 'value' => $this->getCatalogId()),
            array('key' => 'setSiteUserId', 'value' => $this->getSiteUserId()),
            array('key' => 'setCtxParamProductIds', 'value' => implode(',', $cartProductsInformation['ids'])),
            array('key' => 'setCtxParamProductQuantities', 'value' => implode(',', $cartProductsInformation['qty'])),
            array('key' => 'setPageType', 'value' => $pageType),
        );

        if ($category = Mage::registry('current_category')) {
            $res[] = array('key' => 'setCategoryId', 'value' => $category->getId());
        }

        if ($product = Mage::registry('current_product')) {
            $res[] = array('key' => 'setProductId', 'value' => $product->getSku());
        }

        return $res;
    }
}
