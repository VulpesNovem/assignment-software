<?php

namespace Login\Controller;

use Account\Users;
use Application\Logs;
use Laminas\Authentication\Adapter\AbstractAdapter;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Session\Container;
use Laminas\View\Model\ViewModel;


class LoginController extends AbstractActionController
{
    protected $params;
    protected $_log;

    public function __construct(AbstractAdapter $configurations = null) {
        $this->_log = new Logs;
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

                $this->_log->logLogin($validate[0]['UserID'], $validate[0]);

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