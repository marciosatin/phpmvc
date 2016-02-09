<?php

namespace PhpMvc\Controller;
use PhpMvc\Request\Http;

class Action  extends Http{

    protected $view;
    protected $action;
    protected $module;

    public function __construct() {
        $this->view = new \stdClass();
    }

    public function render($action, $module = '', $layout = true) {
        $this->action = $action;
        $this->module = $module;
        $layoutPath = '../App/views/layout.phtml';
        if ($this->module != '') {
            $layoutPath = '../App/Modules/' . $this->module . '/views/layout.phtml';
        }
        if (($layout) && (file_exists($layoutPath))) {
            include_once $layoutPath;
        } else {
            $this->content(); 
        }
    }

    public function content() {
        $atual = get_class($this);
        $replace = "App\\Controllers\\";
        $includePath = '../App/views/';
        if ($this->module != '') {
            $replace = "App\\Modules\\" . ucfirst($this->module) . "\\Controllers\\";
            $includePath = '../App/modules/' . $this->module . '/views/';
        }
//        echo('<pre>' . print_r($replace, true) . __FILE__ . " Linha: " . __LINE__ . '</pre>');
//        die('<pre>' . print_r($atual, true) . __FILE__ . " Linha: " . __LINE__ . '</pre>');
        $singleClassName = strtolower(str_replace($replace, "", $atual));
        include_once $includePath . $singleClassName . '/' . $this->action . '.phtml';
    }
    
}
