<?php
    function loadClass($className) {
        global $CONFIG;

		$fileName = getFileName($className);
		require(getFullPath($fileName));
    }

	function getFullPath($fileName) {
		global $CONFIG;

		$localPath = str_replace('/', DIRECTORY_SEPARATOR, $CONFIG['LOCAL_PATH']);
		$localFileName = $localPath.'lib'.DIRECTORY_SEPARATOR . $fileName;
		if(file_exists($localFileName)) return $localFileName;

		$centralPath = str_replace('/', DIRECTORY_SEPARATOR, $CONFIG['CENTRAL_PATH']);
		$centralFileName = $centralPath.'lib'.DIRECTORY_SEPARATOR . $fileName;
		if(file_exists($centralFileName)) return $centralFileName;

		$localVendorPath = str_replace('/', DIRECTORY_SEPARATOR, $CONFIG['LOCAL_PATH']);
		$localVendorFileName = $localVendorPath.'vendor'.DIRECTORY_SEPARATOR . $fileName;
		if(file_exists($localVendorFileName)) return $localVendorFileName;

		$centralVendorPath = str_replace('/', DIRECTORY_SEPARATOR, $CONFIG['CENTRAL_PATH']);
		$centralVendorFileName = $centralVendorPath.'vendor'.DIRECTORY_SEPARATOR . $fileName;
		if(file_exists($centralVendorFileName)) return $centralVendorFileName;

		echo "Cannot load used package! <br />";
		echo "List of searched places: <br />";
		echo $localFileName . "<br />";
		echo $centralFileName . "<br />";
		echo $localVendorFileName . "<br />";
		echo $centralVendorFileName . "<br />";
		die;
	}

	function getFileName($className) {
		$fileName = '';
		if (false !== ($lastNsPos = strripos($className, '\\'))) {
			$namespace = substr($className, 0, $lastNsPos);
			$className = substr($className, $lastNsPos + 1);
			$fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
		}
		$fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
		return $fileName;
	}

    function include_php_file_once($fileName) {
        global $CONFIG;

        $localPath = str_replace('/', DIRECTORY_SEPARATOR, $CONFIG['LOCAL_PATH']);
        $centralPath = str_replace('/', DIRECTORY_SEPARATOR, $CONFIG['CENTRAL_PATH']);
        $localFileName = $localPath . $fileName;
        $centralFileName = $centralPath . $fileName;
        if (file_exists($localFileName))
            include_once($localFileName);
        else
            include_once($centralFileName);
    }

    spl_autoload_register('loadClass'); // Registers the autoloader
?>