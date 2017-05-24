<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 23/05/2017
 * Time: 14:57
 */

namespace Application\Billing;


use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;

class BillingManager implements EventManagerAwareInterface
{
    use EventManagerAwareTrait;
    
    public function printToPdf(Bill $bill)
    {
        /** bill printing logic */
        
        $bill->setUrl('http://example.com');
        
        $this->getEventManager()->trigger($bill::EVENT_PRINT, $bill);
    }
}