<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 24/05/2017
 * Time: 11:40
 */

namespace Application\User;


use Psr\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserApiControllerFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, 'Application\UserApi');
    }

    /**
     *
     */
    function __invoke(ContainerInterface $container, $requestedName)
    {
        $controller = new UserApiController();
        
        $inputFilter = $container->getServiceLocator()
            ->get('user-filter');
        $controller->setInputFilter($inputFilter);
        
        $hydrator = $container->getServiceLocator()
            ->get('hydratorManager')
            ->get('classmethods');
        $controller->setHydrator($hydrator);
        
        $controller->setUserPrototype(new User);
        
        return $controller;
    }

}