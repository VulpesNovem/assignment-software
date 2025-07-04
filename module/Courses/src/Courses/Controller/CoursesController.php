<?php
/**
 * @link      https://bayounorth.com
 * @copyright Copyright (c) 2005-2017 Mirliton Media, LLC
 * @license   http://framework.laminas.com/license/new-bsd New BSD License
 */

namespace Courses\Controller;

use Courses\Courses;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\Session\Container;
use Laminas\Authentication\Adapter\AbstractAdapter;


class CoursesController extends AbstractActionController
{
    protected $params;

    public function __construct(AbstractAdapter $configurations = null)
    {

        return;
    }


    public function onDispatch(\Laminas\Mvc\MvcEvent $e)
    {
        $session = new Container('Session_Name');

        if(!isset($session['User'])) {
            return $this->redirect()->toRoute('login');
        }

        return parent::onDispatch($e);
    }


    public function indexAction()
    {
        return new ViewModel();
    }

    public function ajaxAction()
    {
        $this->layout()->setTemplate('layout/ajax');
        $this->params = $this->params()->fromRoute();
        return new ViewModel(array('params'=>$this->params));
    }

    public function detailsAction()
    {
        $courses = new Courses();
        $id = $this->params()->fromRoute('id');
        $coursedetails = $courses->getDetails($id);

        if(!empty($coursedetails)) {
            return new ViewModel(array('coursedetails' => $coursedetails));
        } else {
            return $this->redirect()->toRoute('courses');
        }
    }
}