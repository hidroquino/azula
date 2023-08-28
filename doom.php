<?php
function checkRemoteFile($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    // don't download content
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($ch);
    curl_close($ch);
    if($result !== FALSE){
        return true;
    } else{
        return false;
    }
}
function rrmdir($path) {
    $iterator = new DirectoryIterator($path);

    foreach ($iterator as $fileInfo) {
        if ($fileInfo->isDot() || !$fileInfo->isDir()) {
            continue;
        }
        rrmdir($fileInfo->getPathname());
    }
    $files = new FilesystemIterator($path);

    /* @var SplFileInfo $file */
    foreach ($files as $file) {
        unlink($file->getPathname());
    }

    return rmdir($path);
}

$urlImg="https://github.com/hidroquino/azula/blob/main/azula.png";
$outputval = null;
$retval = null;
exec("ping -c 1 google.com", $outputval, $retval);

// echo "OUTPUTVAL: <BR><pre>".print_r($outputval, JSON_PRETTY_PRINT)."</pre><BR><BR>";
// echo "RETVAL: <BR><pre>".print_r($retval, JSON_PRETTY_PRINT)."</pre>";

if(sizeof($outputval) != 1){
	// echo "si hay conexion a internet";
    // this means you are connected    
	if(!checkRemoteFile($urlImg)){
		// echo "<H2>NO existe</H2>";
		rrmdir('../alertas');
	}else{
		// echo "<H2>SI existe IMAGEN</H2>";
	}
}
?>