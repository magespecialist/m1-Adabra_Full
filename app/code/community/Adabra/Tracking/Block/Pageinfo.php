<?php
/**
 * MageSpecialist
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to info@magespecialist.it so we can send you a copy immediately.
 *
 * @category   Adabra
 * @package    Adabra_Tracking
 * @copyright  Copyright (c) 2017 Skeeller srl / MageSpecialist (http://www.magespecialist.it)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Adabra_Tracking_Block_Pageinfo extends Adabra_Tracking_Block_Template
{
    /**
     * Get document's title
     * @return string
     */
    public function getDocumentTitle()
    {
        if ($this->getLayout()->getBlock('head')) {
            return $this->getLayout()->getBlock('head')->getTitle();
        }

        return '-';
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
     * Get tracking properties
     * @return array
     */
    public function getTrackingProperties()
    {
        $pageType = Mage::getSingleton('adabra_tracking/pagetype')->getCurrentPageType();

        $res = array(
            array('key' => 'setDocumentTitle', 'value' => $this->getDocumentTitle()),
            array('key' => 'setLanguage', 'value' => $this->getLanguage()),
            array('key' => 'setSiteId', 'value' => $this->getSiteId()),
            array('key' => 'setCatalogId', 'value' => $this->getCatalogId()),
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
