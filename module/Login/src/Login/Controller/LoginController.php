<?php
/**
 * @link      https://bayounorth.com
 * @copyright Copyright (c) 2005-2017 Mirliton Media, LLC
 * @license   http://framework.laminas.com/license/new-bsd New BSD License
 */

namespace Login\Controller;

use Application\Configuration;
use Application\Users;
use Courses\Courses;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\Session\Container;
use Laminas\Authentication\Adapter\AbstractAdapter;


class LoginController extends AbstractActionController
{
    protected $params;

    public function __construct(AbstractAdapter $configurations = null)
    {
//        $configuration = new Configuration();
//        $configurations = $configuration->getConfigs();
//        $container = new Container($configurations['SESSION_NAME']);
//        $container->config = $configurations;
     //  return $configurations;
    }

    public function onDispatch(\Laminas\Mvc\MvcEvent $e)
    {
//        $session = new Container('Session_Name');
//
//        if(!isset($session['User'])) {
//            return $this->redirect()->toRoute('login');
//        }

        return parent::onDispatch($e);
    }
    public function indexAction(): ViewModel
    {
//        if ($_POST) {
//            $user = new Users;
//            $validate = $user->validate($_POST);
//            if(!empty($validate)){
//                $configuration = new Configuration();
//                $_SESSION[$configuration->getCode('SESSION_NAME')] = array();
//                $_SESSION[$configuration->getCode('SESSION_NAME')]['Message']['MessageContent'] = 'You Are Logged In';
//                $_SESSION[$configuration->getCode('SESSION_NAME')]['User'] = $validate;
//                $this->redirect()->toRoute('home');
//            }
//        }
        return new ViewModel(array());
    }
}