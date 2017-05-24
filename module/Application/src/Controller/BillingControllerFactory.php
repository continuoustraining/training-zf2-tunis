<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 23/05/2017
 * Time: 15:30
 */

namespace Application\Controller;


use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BillingControllerFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, 'Application\Billing');
    }
    
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $controller = new BillingController();
        
        $billingManager = $container->getServiceLocator()
            ->get('billing-manager');
        $controller->setBillingManager($billingManager);
        
        return $controller;
    }

}