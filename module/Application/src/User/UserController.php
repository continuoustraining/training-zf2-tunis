<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 24/05/2017
 * Time: 11:34
 */

namespace Application\User;

use Zend\Form\Form;
use Zend\Mvc\Controller\AbstractActionController;

class UserController extends AbstractActionController
{
    /** @var  Form */
    protected $userForm;

    /**
     * @param Form $userForm
     * @return UserController
     */
    public function setUserForm(Form $userForm)
    {
        $this->userForm = $userForm;
        return $this;
    }
    
    public function createAction()
    {
        $form = $this->userForm;
        
        return compact('form');
    }
}