<?php
/**
 * Hashcrypt Technologies
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Hashcrypt.com license that is
 * available through the world-wide-web at this URL:
 * https://www.hashcrypt.com/license.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Hashcrypt
 * @package     Hashcrypt_Smtp
 * @copyright   Copyright (c) 2018 Hashcrypt Technologies (http://www.hashcrypt.com/)
 * @license     https://www.hashcrypt.com/license.txt
 */
namespace Hashcrypt\Smtp\Helper;

use Magento\Framework\Registry;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    const XML_PATH_HELLOWORLD = 'smtp/';

    public function getConfigValue($field, $storeId = null)
	{
		return $this->scopeConfig->getValue(
			$field, ScopeInterface::SCOPE_STORE, $storeId
		);
	}
	public function getGeneralConfig($code, $storeId = null)
	{
		return $this->getConfigValue(self::XML_PATH_HELLOWORLD .'general/'. $code, $storeId);
	}
	public function versionCompare($verion){
		$ve = explode('.',$verion);
		if($ve[1] >= 2){
			if($ve[2] >= 0){
				return true;
			}else{
				return false;
			}
		}
	}
}
