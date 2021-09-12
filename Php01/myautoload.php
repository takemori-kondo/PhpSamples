<?php
// PHP Version 8.1

// 名前空間は\\
// ファイルパスは/なので変換する必要あり
spl_autoload_register(function($fqcn) {
    $basePath = __Dir__.'/../';
    $namespacePos = strripos($fqcn, "\\");
    $namespace = substr($fqcn, 0, $namespacePos);
    $className = substr($fqcn, $namespacePos + 1);
    $path = $basePath.str_replace("\\", '/', $namespace).'/'.$className.'.php';
    if(is_file($path)) {
        require_once $path;
    }
});