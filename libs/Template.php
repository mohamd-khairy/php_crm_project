<?php

class Template {

    protected $template_folder = Template_FOLDER;
    protected $view_folder = Views_FOLDER;
    public $attributes = array();
    public $template_parts = array('header', 'left', 'right', 'footer');

    public function __set($name, $value) {
        $this->attributes[$name] = $value;
    }

    function render($view) {
        foreach ($this->attributes as $key => $value) {
            $$key = $value;
        }
        foreach ($this->template_parts as $part) {
            require_once $this->template_folder . DS . $part . '.tpl';
        }
    }

}
