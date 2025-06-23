<?php

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return [
    'view_manager' => [
        'display_exceptions' => true,
    ],
    'db' => array(
        'driver'         => 'Pdo',
        'dsn'            => 'mysql:dbname=assignment-software;host=localhost',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES "UTF8"'
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Laminas\Db\Adapter\Adapter' => function ($serviceManager) {
                $adapterFactory = new Laminas\Db\Adapter\AdapterServiceFactory();
                $adapter = $adapterFactory->createService($serviceManager);
                // set static adapter
                \Laminas\Db\TableGateway\Feature\GlobalAdapterFeature::setStaticAdapter($adapter);
                return $adapter;
            }
        ),
    ),
];
