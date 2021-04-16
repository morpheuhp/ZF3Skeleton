<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;

class Module implements BootstrapListenerInterface {

    const VERSION = '3.1.4dev';

    public function getConfig() {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function onBootstrap(EventInterface $e) {
        $serviceManager = $e->getApplication()->getServiceManager();
        $adapter = $serviceManager->get(Adapter::class);

        $statement = $adapter->createStatement('SELECT * FROM users');
        $statement->prepare();
        $result = $statement->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet = new ResultSet;
            $resultSet->initialize($result);

            foreach ($resultSet as $row) {
                echo $row->name . PHP_EOL;
            }
        }
    }

}
