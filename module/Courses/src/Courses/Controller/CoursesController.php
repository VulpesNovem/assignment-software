<?php
/**
 * @link      https://bayounorth.com
 * @copyright Copyright (c) 2005-2017 Mirliton Media, LLC
 * @license   http://framework.laminas.com/license/new-bsd New BSD License
 */

namespace Courses\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\Session\Container;
use Laminas\Authentication\Adapter\AbstractAdapter;


class CoursesController extends AbstractActionController
{


    public function __construct(AbstractAdapter $configurations = null)
    {

        return;
    }


    public function onDispatch(\Laminas\Mvc\MvcEvent $e)
    {


        return parent::onDispatch($e);
    }


    public function indexAction()
    {
        return new ViewModel();
    }

}