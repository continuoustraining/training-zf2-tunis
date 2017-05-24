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
    
    /** @var  UserManager */
    protected $userManager;

    /**
     * @param Form $userForm
     * @return UserController
     */
    public function setUserForm(Form $userForm)
    {
        $this->userForm = $userForm;
        return $this;
    }

    /**
     * @param UserManager $userManager
     * @return UserController
     */
    public function setUserManager($userManager)
    {
        $this->userManager = $userManager;
        return $this;
    }
    
    public function createAction()
    {
        $form = $this->userForm;
        
        // POST case
        if ($this->getRequest()->isPost()) {
            $params = $this->getRequest()->getPost();
            
            $form->setData($params);
            if ($form->isValid()) {
                /** @var User $user */
                $user = $form->getData();
                $this->userManager->persist($user);
            }
        }
        
        return compact('form');
    }
}