<?php

namespace App\Modules\Control\Controllers;
use PhpMvc\Controller\Action;
use PhpMvc\Di\Container;

class Index extends Action
{
    public function index() {
        
//        die('<pre>' . print_r($this->getRequest()->getParam('y'), true) . __FILE__ . " Linha: " . __LINE__ . '</pre>');
        
        $artigo = Container::getClass('Artigo');
        $artigos = $artigo->fetchAll();
        
        $this->view->artigos = $artigos;
        $this->render('index', 'control');
    }
    
    public function empresa() {
        $nomes = array(
            'Marcio',
            'Satin',
        );
        
        $this->view->nomes = $nomes;
        $this->render('empresa', 'control');
    }
}

