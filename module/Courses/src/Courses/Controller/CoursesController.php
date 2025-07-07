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


class CoursesController extends AbstractActionController
{
    protected $params;

    //When the controller loads
    public function onDispatch(\Laminas\Mvc\MvcEvent $e)
    {
        //Create a container in session
        $container = new Container('AssignmentSession');

        //If a container in session is not tied to a user, redirect login
        if(!isset($_SESSION['AssignmentSession']['User'])) {
            return $this->redirect()->toRoute('login');
        }

        return parent::onDispatch($e);
    }

    //Index page action
    public function indexAction()
    {
        return new ViewModel();
    }

    //Ajax file action
    public function ajaxAction()
    {
        $this->layout()->setTemplate('layout/ajax');
        $this->params = $this->params()->fromRoute();
        return new ViewModel(array('params'=>$this->params));
    }

    //Detail page actions
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