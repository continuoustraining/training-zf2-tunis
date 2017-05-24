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

class UserControllerFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, 'Application\User');
    }

    /**
     *
     */
    function __invoke(ContainerInterface $container, $requestedName)
    {
        $controller = new UserController();
        
        $form = $container->getServiceLocator()
            ->get('formElementManager')
            ->get('user-form');
        
        $controller->setUserForm($form);
        
        return $controller;
    }

}