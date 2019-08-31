<?php

class Router {

    static function loadController() {
        if (isset($_GET["rt"])) {
            $location = $_GET["rt"];
            $location = explode("/", $location);
            if (count($location) == 1) {
                $action = "index";
            } else {
                $action = $location[1];
            }
            $controller = $location[0];
            $controller = new $controller;
            $action.='Action';
            $controller->$action();
        } else {
            $HOME_CONTROLLER = HOME_PAGE;
            $controller = new $HOME_CONTROLLER;
            $action = 'indexAction';
            $controller->$action();
        }
    }

}
