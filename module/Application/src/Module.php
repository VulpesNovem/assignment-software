<?php
/**
 * @link      http://github.com/laminasframework/LaminasSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Laminas Technologies USA Inc. (http://www.laminas.com)
 * @license   http://framework.laminas.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Configuration;
use Laminas\Mvc\MvcEvent;

class Module
{
    const VERSION = '3.0.2dev';


    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
    public function getAutoloaderConfig()
    {
        return array(
            'Laminas\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),

            'Laminas\Loader\ClassMapAutoloader' => array(
                array(
                    __NAMESPACE__ => '/models/' .'/autoload_classmap.php'
                )
            ),


        );
    }


    public function onBootstrap(MvcEvent $e)
    {
        $sm = $e->getApplication()->getServiceManager();
        $adapter = $sm->get('Laminas\Db\Adapter\Adapter');
        \Laminas\Db\TableGateway\Feature\GlobalAdapterFeature::setStaticAdapter($adapter);
    }


}
