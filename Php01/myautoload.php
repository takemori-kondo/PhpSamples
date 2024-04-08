<?php
// PHP Version 8.1
declare(strict_types=1);

/*
この例では、以下のルールが前提になっている
1. Linux系を前提に名前空間「\\」を「/」に変換する（XamppなどによるWindows上での実行では動かないので注意）
2. プロジェクトのルートディレクトリ直下にこのファイルが置かれている（$basePathが直下パスの1つ上）
3. プロジェクトのディレクトリ構造と名前空間が一致している
4．クラスファイルは、クラス名.phpである（クラス名.class.phpではない）
*/
spl_autoload_register(function ($fqcn) {
    $basePath = __Dir__ . '/../';
    $namespacePos = strripos($fqcn, "\\");
    $namespace = substr($fqcn, 0, $namespacePos);
    $className = substr($fqcn, $namespacePos + 1);
    $path = $basePath . str_replace("\\", '/', $namespace) . '/' . $className . '.php';
    if (is_file($path)) {
        require_once $path;
    }
});
