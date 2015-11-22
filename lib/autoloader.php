<?php
    function loadClass($className) {
        global $CONFIG;
        $fileName = '';
        $namespace = '';

/*        // Sets the include path as the "src" directory
        $includePath = dirname(__FILE__).DIRECTORY_SEPARATOR;*/
        // $includePath = '\lib';

        if (false !== ($lastNsPos = strripos($className, '\\'))) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }
        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
        /*$fullFileName = $includePath . DIRECTORY_SEPARATOR . $fileName;*/
        
        $localPath = str_replace('/', DIRECTORY_SEPARATOR, $CONFIG['LOCAL_PATH']);
        $centralPath = str_replace('/', DIRECTORY_SEPARATOR, $CONFIG['CENTRAL_PATH']);
        
        $localFileName = $localPath.'lib'.DIRECTORY_SEPARATOR . $fileName;
        $centralFileName = $centralPath.'lib'.DIRECTORY_SEPARATOR . $fileName;
        
        if (file_exists($localFileName)) {
            require $localFileName;
        } 
        else if (file_exists($centralFileName)) {
            require $centralFileName;
        }
        else {
            echo 'Class "'.$className.'" does not exist.';
        }
    }
    spl_autoload_register('loadClass'); // Registers the autoloader
?>