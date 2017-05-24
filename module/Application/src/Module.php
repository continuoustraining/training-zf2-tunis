<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Monitoring\MvcWatcher;
use Application\Services\ArticleManager;
use Zend\Log\Logger;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ServiceManager\ServiceManager;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        
        /** @var ServiceManager $serviceManager */
        $serviceManager = $e->getApplication()->getServiceManager();
        
//        $serviceManager->setAllowOverride(true);
//        $serviceManager->setService('my-invokable', 'toto');
        /** @var Logger $logger */
        $logger = $serviceManager->get('my-logger');
        $logger->info('foo', ['user' => 'toto']);
        
        /** @var ArticleManager $articleManager */
//        $articleManager = $serviceManager->get('article-manager');
//        var_dump($articleManager->getServiceLocator());die;
        
//        $eventManager->attach(
//            MvcEvent::EVENT_ROUTE,
//                function(MvcEvent $e) {
//                    var_dump($e);die;
//                });
        
        $sharedManager = $eventManager->getSharedManager();
        
        /** @var MvcWatcher $mvcWatcher */
        $mvcWatcher = $serviceManager->get('mvc-watcher');
        $mvcWatcher->attach($eventManager);
    }
    
    public function __invoke(MvcEvent $e) {
        echo '<pre'; var_dump($e);
    }

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
