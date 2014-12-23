<?php
namespace Core\Application;


use \Core\Application\Module\model as module;
use \Core\Application\Router\model\parseUrl as getRequest;

class Application
{        
    static $view;
    static $config; 
    static $controller;
    static $action;
    static $method;
    static $params;
    
    public static function setConfig($config)
    {
        self::$config = module\moduleManager::getConfig($config);
        $request = getRequest::parseURL();
       
        self::$method = $request['method'];
        self::$controller = $request['controller'];
        self::$action = $request['action'];
        self::$params = $request['params'];
    }

    public static function getConfig()
    {
        return self::$config;
    }

    public static function dispatch()
    {
        $controllerNameClass = '\\Application\\controllers\\' . self::$controller;
    
        $controller = new $controllerNameClass();
        $actionName = self::$action != '' ? self::$action : 'index';
        ob_start();
            echo $controller->$actionName();            
        self::$view=ob_get_contents();
        ob_end_clean();

        self::twoStep(self::$view, $controller->layout);
    }

    public static function twoStep($view, $layout)
    {
		
        if($layout)
        {
            include __DIR__ .'/../../../../'.'Application/src/Application/layouts'.DIRECTORY_SEPARATOR.$layout ;
        }
        else
            echo $view;
        
        
        
    }    
  
}
