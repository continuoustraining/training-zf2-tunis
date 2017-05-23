<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 22/05/2017
 * Time: 16:00
 */

namespace Application\Services;


use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class ArticleManager implements ServiceLocatorAwareInterface /** DEPRECATED */
{
    
    use ServiceLocatorAwareTrait;
    
    protected $translator;

    /**
     * @return mixed
     */
    public function getTranslator()
    {
        return $this->translator;
    }

    /**
     * @param mixed $translator
     * @return ArticleManager
     */
    public function setTranslator($translator)
    {
        $this->translator = $translator;
        return $this;
    }
}