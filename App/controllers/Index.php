<?php

namespace App\Controllers;
use PhpMvc\Controller\Action;
use PhpMvc\Di\Container;

class Index extends Action
{
    public function index() {
        
        $artigo = Container::getClass('Artigo');
        $artigos = $artigo->fetchAll();
        
        $this->view->artigos = $artigos;
        $this->render('index');
    }
    
    public function empresa() {
        $nomes = array(
            'Marcio',
            'Satin',
        );
        
        $this->view->nomes = $nomes;
        $this->render('empresa');
    }
}

