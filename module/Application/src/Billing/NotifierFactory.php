<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 23/05/2017
 * Time: 15:12
 */

namespace Application\Billing;


use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class NotifierFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, 'billing-notifier');
    }
    
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $notifier = new Notifier();
        
        $notifier->setLogger($container->get('my-logger'));
        
        return $notifier;
    }

}