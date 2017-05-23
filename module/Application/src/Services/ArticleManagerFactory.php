<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 22/05/2017
 * Time: 16:02
 */

namespace Application\Services;


use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ArticleManagerFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, 'article-manager');
    }
    
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        $manager = new ArticleManager();
        
        $manager->setTranslator($container->get('translator'));
        
        return $manager;
    }

}