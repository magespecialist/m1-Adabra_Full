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

class Adabra_Tracking_Block_Template extends Mage_Core_Block_Template
{
    /**
     * Return true if module can be shown
     * @return bool
     */
    public function canShow()
    {
        return Mage::helper('adabra_tracking')->getEnabled();
    }

    /**
     * Get payload
     * @param $key
     * @param $values
     * @return array
     */
    public function getPayload($key, $values)
    {
        if (!is_array($values)) {
            $values = array($values);
        }

        $res = array($key);
        foreach ($values as $value) {
            $res[] = $value;
        }

        return $res;
    }

    /**
     * Get adabra tracking host
     * @return string
     */
    public function getAdabraTrackingHost()
    {
        return Mage::helper('adabra_tracking')->getAdabraTrackingHost();
    }
}
