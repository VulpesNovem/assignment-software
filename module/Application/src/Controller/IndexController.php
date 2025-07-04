<?php

declare(strict_types=1);

namespace Application\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Session\Container;
use Laminas\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    public function onDispatch(\Laminas\Mvc\MvcEvent $e)
    {
        $session = new Container('Session_Name');

        if(!isset($session['User'])) {
        //    return $this->redirect()->toRoute('login');
        }

        return parent::onDispatch($e);
    }
    public function indexAction()
    {
        return new ViewModel();
    }
}
