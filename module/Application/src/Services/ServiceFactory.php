<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 22/05/2017
 * Time: 15:50
 */

namespace Application\Services;


use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, 'default');
    }

    public function __invoke(ContainerInterface $container, $requestedName)
    {
        return new \ArrayObject([]);
    }
}