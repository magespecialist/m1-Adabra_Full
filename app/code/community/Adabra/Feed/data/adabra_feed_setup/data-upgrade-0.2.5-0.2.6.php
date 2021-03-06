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
 * @package    Adabra_Feed
 * @copyright  Copyright (c) 2017 Skeeller srl / MageSpecialist (http://www.magespecialist.it)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

// Fill v-fields
$tableName = $installer->getTable('adabra_feed/vfield');

$installer->getConnection()->insert($tableName, array(
    'code' => 'fidelity_card',
    'mode' => 'map',
    'value' => strtolower('fidelity_card'),
    'vfield_type' => Adabra_Feed_Model_Source_Vfield_Type::TYPE_CUSTOMER
));

$vFields = Mage::getSingleton('adabra_feed/source_vfield')->toArray();
foreach ($vFields as $vField) {
    $data  = array('vfield_type' => Adabra_Feed_Model_Source_Vfield_Type::TYPE_PRODUCT);
    $where = array('code = ?' => $vField);
    $installer->getConnection()->update($tableName, $data, $where);
}

$installer->endSetup();
