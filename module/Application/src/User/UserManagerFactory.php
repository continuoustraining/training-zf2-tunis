<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 24/05/2017
 * Time: 17:44
 */

namespace Application\User;


use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserManagerFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, 'user-manager');
    }

    /**
     *
     */
    function __invoke(ContainerInterface $container, $requestedName)
    {
        $userManager = new UserManager();
        
        $entityManager = $container->get('entitymanager');
        $userManager->setEntityManager($entityManager);
        
        return $userManager;
    }

}