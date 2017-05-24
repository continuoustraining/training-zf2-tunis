<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 23/05/2017
 * Time: 15:29
 */

namespace Application\Controller;


use Application\Billing\Bill;
use Application\Billing\BillingManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class BillingController extends AbstractActionController
{
    /** @var  BillingManager */
    protected $billingManager;

    /**
     * @param BillingManager $billingManager
     * @return BillingController
     */
    public function setBillingManager($billingManager)
    {
        $this->billingManager = $billingManager;
        return $this;
    }
    
    public function printAction()
    {
        $bill = new Bill();
        
        $this->billingManager->printToPdf($bill);
        
        $viewModel = new ViewModel(['bill' => $bill]);
        
        return $viewModel;
        return compact('bill');
//        return [
//            'bill' => $bill
//        ];
    }
}