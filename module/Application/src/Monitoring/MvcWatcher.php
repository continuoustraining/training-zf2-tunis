<?php
/**
 * Created by PhpStorm.
 * User: fred
 * Date: 23/05/2017
 * Time: 09:57
 */

namespace Application\Monitoring;


use Ramsey\Uuid\Uuid;
use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\Log\LoggerAwareTrait;
use Zend\Mvc\MvcEvent;

class MvcWatcher extends AbstractListenerAggregate
{
    use LoggerAwareTrait;
    
    /** @var string */
    protected $requestId;
    
    protected $startTime;
    
    public function __construct()
    {
        $this->requestId = (string)Uuid::uuid4();
        $this->startTime = round(microtime(true) * 10000);
    }

    /**
     * @param EventManagerInterface $events
     * @return mixed
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_ROUTE,
            [$this, 'onRoute']
        );
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_DISPATCH_ERROR,
            [$this, 'onDispatchError']
        );
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_DISPATCH,
            [$this, 'onDispatch']
        );
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_RENDER,
            [$this, 'onRender']
        );
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_RENDER_ERROR,
            [$this, 'onRenderError']
        );
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_FINISH,
            [$this, 'onFinish']
        );
    }
    
    protected function getDuration()
    {
        return round(microtime(true) * 10000) - $this->startTime;
    }
    
    
    public function onRoute(MvcEvent $event)
    {
        $this->logger->info(
            'Route started',
            [
                'id' => $this->requestId,
                'duration' => $this->getDuration()
            ]
        );
    }
    
    public function onDispatch(MvcEvent $event)
    {
        $this->logger->info(
            'Dispatch started',
            [
                'id' => $this->requestId,
                'duration' => $this->getDuration()
            ]
        );
    }
    
    public function onDispatchError(MvcEvent $event)
    {
        $this->logger->info(
            'Dispatch triggered an error',
            [
                'id' => $this->requestId,
                'duration' => $this->getDuration(),
                'error' => $event->getError()
            ]
        );
    }
    
    public function onRender(MvcEvent $event)
    {
        $this->logger->info(
            'Response rendered',
            [
                'id' => $this->requestId,
                'duration' => $this->getDuration()
            ]
        );
    }

    public function onRenderError(MvcEvent $event)
    {
        $this->logger->info(
            'Rendering triggered an error',
            [
                'id' => $this->requestId,
                'duration' => $this->getDuration(),
                'error' => $event->getError()
            ]
        );
    }
    
    public function onFinish(MvcEvent $event)
    {
        $this->logger->info(
            'Response finished',
            [
                'id' => $this->requestId,
                'duration' => $this->getDuration()
            ]
        );
    }

}