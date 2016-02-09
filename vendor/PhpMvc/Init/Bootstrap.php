<?php

namespace PhpMvc\Init;
use Exception;

abstract class Bootstrap {

    private $routes;

    public function __construct() {
        $this->initRoutes();
        $this->run($this->getUrl());
    }

    abstract protected function initRoutes();

    protected function run($url) {
        $urlReplace = trim(strtr($this->getUrlReplace($url), array(
            '//' => '/'
        )));
        echo('<pre>' . print_r($urlReplace, true) . " File: " . __FILE__ . " Linha: " . __LINE__ . '</pre>');
        $this->setParams($url, $urlReplace);
        $x = false;
        array_walk($this->routes, function($route) use($urlReplace, &$x) {
            if ($urlReplace == $route['route']) {
                $x = true;
                $module = (isset($route['module'])) ? $route['module'] : DEFAULT_MODULE;
                if ($module == "") {
                    $class = "App\\controllers\\" . ucfirst($route['controller']);
                } else {
                    $class = "App\\modules\\" . $module . "\\controllers\\" . ucfirst($route['controller']);
                }
                $controller = new $class;
                $controller->$route['action']();
            } 
        });
        
        if (!$x) {
            echo 'OOOPSSS!!';
            throw new Exception;
        }
    }

    private function setParams($url, $urlReplace) {
        $url = str_replace($urlReplace, "", $url);
        preg_match_all('/([a-zA-Z0-9_-]+)\/([a-zA-Z0-9,_-]+)/', $url, $matches);
        $_GET = array_merge(array_combine($matches[1], $matches[2]), $_GET);
    }

    protected function setRoutes(array $routes) {
        $this->routes = $routes;
    }

    protected function getUrl() {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    private function isValidModule($module = '') {
        if ($module == '') {
            return false;
        }
        return is_dir("../App/modules/{$module}/");
    }

    private function getUrlReplace($url) {

        $exUrl = explode('/', $url);
        if ($this->isValidModule($exUrl[1])) {
            $module = $exUrl[1];
            $controller = (isset($exUrl[2]) && ($exUrl[2] != '')) ? $exUrl[2] : 'index';
            $action = (isset($exUrl[3]) && ($exUrl[3] != '')) ? $exUrl[3] : 'index';
            $urlReplace = '/' . $module . '/' . $controller . '/' . $action;
        } else {
            $module = DEFAULT_MODULE;
            $controller = (isset($exUrl[1]) && ($exUrl[1] != '')) ? $exUrl[1] : 'index';
            $action = (isset($exUrl[2]) && ($exUrl[2] != '')) ? $exUrl[2] : 'index';
            $urlReplace = '/' . $module . '/' . $controller . '/' . $action;
        }
        
        return $urlReplace;
    }

}
