<?php

namespace PhpMvc\Request;

abstract class Http {
    
    private $params;

    protected function getRequest() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $this->setParams($_GET);
                break;
            case 'POST':
                $this->setParams($_POST);
            default:
                break;
        }
        
        return $this;
    }
    
    protected function getParams() {
        return $this->params;
    }
    
    protected function getParam($param = null, $default = null) {
        return isset($this->params[$param]) ? $this->params[$param] : $default;
    }
    
    protected function setParam($param, $value) {
        $this->params[$param] = $value;
    }
    
    protected function setParams($params) {
        $this->params = $params;
    }
    
}