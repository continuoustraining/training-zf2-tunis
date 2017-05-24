<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 23/05/2017
 * Time: 15:00
 */

namespace Application\Billing;

class Bill
{
    const EVENT_PRINT = 'bill.printed';
    
    protected $url;

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     * @return Bill
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }
}
