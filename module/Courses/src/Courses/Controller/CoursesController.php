<?php

namespace Courses\Controller {

    use Laminas\Mvc\Controller\AbstractActionController;
    use Laminas\View\Model\ViewModel;

    class CoursesController extends AbstractActionController
    {
        public function indexAction()
        {
            return new ViewModel();
        }
    }
}
