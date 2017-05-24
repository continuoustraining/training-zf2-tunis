<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 24/05/2017
 * Time: 11:34
 */

namespace Application\User;

use Zend\Form\Form;
use Zend\Hydrator\HydratorInterface;
use Zend\InputFilter\InputFilter;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

class UserApiController extends AbstractActionController
{
    /** @var  InputFilter */
    protected $inputFilter;
    
    /** @var  HydratorInterface */
    protected $hydrator;
    
    /** @var  User */
    protected $userPrototype;

    /**
     * @param HydratorInterface $hydrator
     * @return UserApiController
     */
    public function setHydrator($hydrator)
    {
        $this->hydrator = $hydrator;
        return $this;
    }

    /**
     * @param User $userPrototype
     * @return UserApiController
     */
    public function setUserPrototype($userPrototype)
    {
        $this->userPrototype = $userPrototype;
        return $this;
    }

    /**
     * @param mixed $inputFilter
     * @return UserApiController
     */
    public function setInputFilter(InputFilter $inputFilter)
    {
        $this->inputFilter = $inputFilter;
        return $this;
    }
    
    public function createAction()
    {
        $param = $this->getRequest()->getPost();
        
        $this->inputFilter->setData($param);
        if ($this->inputFilter->isValid()) {
            $user = $this->hydrator->hydrate(
                $this->inputFilter->getValues(),
                clone $this->userPrototype
            );
        }
        
        $model = new JsonModel();
        
        if (isset($user)) {
            $model->setVariables(
                $this->hydrator->extract($user)
            );
        }
        
        return $model;
    }
}