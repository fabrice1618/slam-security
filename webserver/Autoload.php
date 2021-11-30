<?php
require_once 'Settings.php';

spl_autoload_register(/**
 * @throws Exception
 */ function ($className) {
    $basePath = ".";

    if (!isset($basePath)) {
        throw new \Exception("Autoload Exception : Basepath not defined", 1);
    }

    $dirList = ['view', 'model', 'controller'];

    $classLoaded = false;

    foreach ($dirList as $dirName) {
        $file = $basePath . '/' . $dirName . '/' . $className . '.php';
        if (!$classLoaded && file_exists($file)) {
            $classLoaded = true;
            echo $file;
            require_once($file);
            break;
        }
    }
    if (!$classLoaded) {
        throw new Exception("Autoload Exception : class `" . $className . "` is not load", 1);
    }


});