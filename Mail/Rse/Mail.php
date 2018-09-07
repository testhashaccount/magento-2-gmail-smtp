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
namespace Hashcrypt\Smtp\Mail\Rse;

use Magento\Framework\App\ObjectManager;
use Hashcrypt\Smtp\Helper\Data;

/**
 * Class Mail
 * @package Hashcrypt\Smtp\Application\Rse
 */
class Mail extends \Zend_Application_Resource_Mail
{

    /**
     * @var boolean is module enable
     */
    protected $_moduleEnable;

    /**
     * @var boolean is developer mode
     */
    protected $_developerMode;

    /**
     * @var boolean is enable email log
     */
    protected $_emailLog = [];

    /**
     * @var string message body email
     */
    protected $_message;

    /**
     * @var array option by storeid
     */
    protected $_smtpOptions = [];

    /**
     * @var array
     */
    protected $_returnPath = [];

    protected $helperData;

    /**
     * Mail constructor.
     * @param null $options
     */
    public function __construct($options = null)
    {
        $this->helperData = ObjectManager::getInstance()->get(Data::class);
        parent::__construct($options);
    }
   /* public function __construct($options = null)
    {
        $this->smtpHelper = ObjectManager::getInstance()->get(Data::class);
        parent::__construct($options);
    }*/


    /**
     * @param $storeId
     * @param array $options
     * @return $this
     */

    /**
     * @param $storeId
     * @return mixed|null|\Zend_Mail_Transport_Abstract
     */
    public function getTransport()
    {
        $this->_smtpOptions = [
            'type'     => 'smtp',
            'host'     => 'smtp.gmail.com',
            'port'     => '465',
            'auth'     => 'login',
            'username' => $this->helperData->getGeneralConfig("email"),
            'password' => $this->helperData->getGeneralConfig("password"),
            'ssl' => 'ssl'
        ];

        $this->_transport = null;
        $this->setOptions(['transport' => $this->_smtpOptions]);

        return $this->init();
    }
}
