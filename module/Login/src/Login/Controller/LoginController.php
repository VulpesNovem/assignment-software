<?php

namespace Login\Controller;

use Application\Users;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\Session\Container;
use Laminas\Authentication\Adapter\AbstractAdapter;


class LoginController extends AbstractActionController
{
    protected $params;

    public function __construct(AbstractAdapter $configurations = null)
    {
    }

    public function onDispatch(\Laminas\Mvc\MvcEvent $e)
    {
        $session = new Container('AssignmentSession');
        $this->layout()->setTemplate('layout/login');

        return parent::onDispatch($e);
    }
    public function indexAction(): ViewModel
    {
        if ($_POST) {
            $user = new Users;
            $validate = $user->validate($_POST);
            if(!empty($validate)){
                $_SESSION['AssignmentSession'] = array();
                $_SESSION['AssignmentSession']['User'] = $validate;
                $this->redirect()->toRoute('home');
            }
        }
        return new ViewModel(array());
    }

    public function logoutAction(){

        session_destroy();

        $this->redirect()->toRoute('login');
    }
}