<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 23/05/2017
 * Time: 10:07
 */

namespace Application\Monitoring;


use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MvcWatcherFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, 'mvc-watcher');
    }
    
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $watcher = new MvcWatcher();
        
        $logger = $container->get('my-logger');
        $watcher->setLogger($logger);
        
        return $watcher;
    }

}