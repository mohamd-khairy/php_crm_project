<?php

// Setting information
define("SERVER_IP", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "crm_company_ar");
define("DS", DIRECTORY_SEPARATOR);
define("PS", PATH_SEPARATOR);
define("HostName", "http://localhost/crm_company_ar/");

define("PER_PAGE_COUNT",20);

define("Controller_FOLDER", __DIR__ . DS . 'controller');
define("Upload_FOLDER", __DIR__ . DS . 'img');
define("Attach_FOLDER", __DIR__ . DS . 'attachment');
define("MODELS_FOLDER", __DIR__ . DS . 'models');
define("Views_FOLDER", __DIR__ . DS . 'views');
define("LIBS_FOLDER", __DIR__ . DS . 'libs');
define("Template_FOLDER", __DIR__ . DS . 'template');

define("ADMIN_FOLDER", __DIR__ . DS . 'admin');
define("ADMIN_Template", ADMIN_FOLDER . DS . 'Templates');
define("ADMIN_Views", ADMIN_FOLDER . DS . 'Views');
define("ADMIN_Models", ADMIN_FOLDER . DS . 'Models');
define("ADMIN_Controllers", ADMIN_FOLDER . DS . 'Controllers');


set_include_path(get_include_path() . PS . ADMIN_Controllers . PS . ADMIN_Models . PS . Controller_FOLDER . PS . Views_FOLDER . PS . LIBS_FOLDER . PS . MODELS_FOLDER);

// autoload ..
function autoload($className) {
    require_once $className . '.php';
}
spl_autoload_register('autoload');



