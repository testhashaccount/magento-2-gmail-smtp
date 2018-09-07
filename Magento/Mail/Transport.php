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
namespace Hashcrypt\Smtp\Magento\Mail;

use Magento\Framework\Exception\MailException;
use Magento\Framework\Mail\TransportInterface;
use Magento\Framework\Phrase;
use Magento\Framework\Registry;
use Hashcrypt\Smtp\Mail\Rse\Mail;
use Psr\Log\LoggerInterface;

/**
 * Class Transport
 * @package Hashcrypt\Smtp\Mail
 */
class Transport
{
    /**
     * @var int Store Id
     */
    protected $_storeId;

    /**
     * @var \Hashcrypt\Smtp\Mail\Rse\Mail
     */
    protected $resourceMail;

    /**
     * @var \Hashcrypt\Smtp\Model\LogFactory
     */

    /**
     * @var \Magento\Framework\Registry $registry
     */
    protected $registry;

    /**
     * @var Data
     */
    protected $helper;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Transport constructor.
     * @param Mail $resourceMail
     * @param LogFactory $logFactory
     * @param Registry $registry
     * @param Data $helper
     * @param LoggerInterface $logger
     */
    public function __construct(
        Mail $resourceMail,
        Registry $registry
    )
    {
        $this->resourceMail = $resourceMail;
        $this->registry     = $registry;
    }

    /**
     * @param TransportInterface $subject
     * @param \Closure $proceed
     * @throws \Exception
     *
     * @return null
     */
    public function aroundSendMessage(
        TransportInterface $subject,
        \Closure $proceed
    )
    {
        $message        = $this->getMessage($subject);
        $transport = $this->resourceMail->getTransport();
        try {
            $transport->send($message);
        } catch (\Exception $e) {
            throw new MailException(new Phrase($e->getMessage()), $e);
        }
        
    }
    /**
     * @param $transport
     * @return mixed|null
     */
     protected function getMessage($transport)
     {
         try {
             $reflectionClass = new \ReflectionClass($transport);
             $message         = $reflectionClass->getProperty('_message');
             $message->setAccessible(true);
 
             return $message->getValue($transport);
         } catch (\Exception $e) {
             return null;
         }
     }
    
}
