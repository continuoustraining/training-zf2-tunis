<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 23/05/2017
 * Time: 15:02
 */

namespace Application\Billing;


use Psr\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BillingManagerFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, 'billing-manager');
    }

    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $manager = new BillingManager();
        
        $manager->getEventManager()
            ->attach(
                Bill::EVENT_PRINT,
                    [$container->get('billing-notifier'), 'notify']
            );
        
        return $manager;
    }
}

