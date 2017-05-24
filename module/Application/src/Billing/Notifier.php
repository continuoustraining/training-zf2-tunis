<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 23/05/2017
 * Time: 15:06
 */

namespace Application\Billing;

use Zend\EventManager\Event;
use Zend\Log\LoggerAwareInterface;
use Zend\Log\LoggerAwareTrait;

class Notifier implements LoggerAwareInterface
{
    use LoggerAwareTrait;
    
    public function notify(Event $event)
    {
        /** @var Bill $bill */
        $bill = $event->getTarget();
        
        /** Send bill to customer by mail */
        $this->logger->info('Bill ' . $bill->getUrl() . ' has been sent to customer');
    }
}