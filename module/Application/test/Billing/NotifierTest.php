<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 24/05/2017
 * Time: 16:26
 */

namespace ApplicationTest\Billing;


use Application\Billing\Bill;
use Application\Billing\Notifier;
use Zend\EventManager\Event;
use Zend\Log\Logger;

class NotifierTest extends \PHPUnit_Framework_TestCase
{
    public function testNotifyLogsBillUrl()
    {
        $notifier = new Notifier();
        $url = 'http://my-great-url.com';
        $bill = new Bill();
        $bill->setUrl($url);
        $event = new Event();
        $event->setTarget($bill);
        
        $logger = $this->getMockBuilder(Logger::class)
            ->getMock();
        $notifier->setLogger($logger);
        
        $logger->expects($this->once())
            ->method('info')
            ->with($this->stringContains($url));
        
        $notifier->notify($event);
    }
}