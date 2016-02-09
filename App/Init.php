<?php

namespace App;
use PhpMvc\Init\Bootstrap;

class Init extends Bootstrap {
    
    public function initRoutes() {
        $arr = array(
            'home' => array('route' => '/index/index', 'controller' => 'index', 'action' => 'index'),
            'empresa' => array('route' => '/empresa/index', 'controller' => 'index', 'action' => 'empresa'),
            'control/index/index' => array(
                'route' => '/control/index/index', 
                'module' => 'control', 
                'controller' => 'index',
                'action' => 'index'
            ),
            'site/index/index' => array(
                'route' => '/site/index/index', 
                'module' => 'site', 
                'controller' => 'index',
                'action' => 'index'
            )
        );
        $this->setRoutes($arr);
    }
    
    public static function getDb() {
        $db = new \PDO("mysql:host=localhost;dbname=mvc", "root", "7891");
        return $db;
    }
    
}
