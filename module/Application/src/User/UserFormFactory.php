<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 24/05/2017
 * Time: 11:39
 */

namespace Application\User;


use Interop\Container\ContainerInterface;
use Zend\Form\Form;
use Zend\Form\FormElementManager\FormElementManagerV2Polyfill;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserFormFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, 'user-form');
    }
    
    public function __invoke(ContainerInterface $container, $requestedName)
    {
        /** @var FormElementManagerV2Polyfill $container */
        /** @var Form $form */
        $form = $container->get('form');
        
        return $form;
    }

}