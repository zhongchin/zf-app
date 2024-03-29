<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

// return array(
//     // ...
// );
return array(
		'db' => array(
				'driver' => 'Pdo',
				'dsn' => 'mysql:dbname=zf_app;host=localhost',
				'username' => 'root',
				'password' => 'root',
				'driver_options' => array(
						PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
				),
		),
		'service_manager' => array(
				'factories' => array(
						'Zend\Db\Adapter\Adapter'
						=> 'Zend\Db\Adapter\AdapterServiceFactory',
                    'log'=>function(){
                        $log=new Zend\Log\Logger();
                       //     $log->addWriter(new Zend\Log\Writer\Stream(getcwd()."/data/application.log"));
                            $log->addWriter(new \Zend\Log\Writer\FirePhp());
                            return $log;
                    }
				),
		),
);