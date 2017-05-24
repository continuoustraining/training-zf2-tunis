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
        $hydrator = $container->getServiceLocator()
            ->get('hydratorManager')
            ->get('classmethods');
        
        /** @var FormElementManagerV2Polyfill $container */
        /** @var Form $form */
        $form = $container->get('form');
        $form->setObject(new User());
        
        $form->setHydrator($hydrator);
        
        $form->add([
            'name' => 'firstname',
            'options' => [
                'label' => 'Firstname'
            ],
            'attributes' => [
//                'required' => true
            ],
            'type' => 'text'
        ]);
        
        $form->add([
            'name' => 'lastname',
            'options' => [
                'label' => 'Lastname'
            ],
            'type' => 'text'
        ]);
        
        $form->add([
            'name' => 'save',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Save'
            ]
        ]);
        
        $inputFilter = $container->getServiceLocator()
            ->get('user-filter');
        
        $form->setInputFilter($inputFilter);
        
        return $form;
    }

}