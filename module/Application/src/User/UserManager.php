<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 24/05/2017
 * Time: 17:43
 */

namespace Application\User;


use Doctrine\ORM\EntityManager;

class UserManager
{
    /** @var  EntityManager */
    protected $entityManager;

    /**
     * @return EntityManager
     */
    protected function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * @param EntityManager $entityManager
     * @return UserManager
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
        return $this;
    }
    
    public function persist(User $user)
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        
        return $this;
    }
}