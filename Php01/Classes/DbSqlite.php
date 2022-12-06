<?php
// PHP Version 8.1
declare(strict_types=1);
namespace Php01\Classes;

class DbSqlite
{
    protected static $pdo;

    public static function getPdo()
    {
        if (static::$pdo == null) {
            static::$pdo = static::newPdo();
        }
        return static::$pdo;
    }

    protected static function newPdo()
    {
        try {
            $dbServer = 'sqlite';
            $filePath = __DIR__.'/php_sample.db';
            $dsn = $dbServer.':'.$filePath;
            $dbUser = '';
            $dbPass = '';
            $driverOption = array(\PDO::ATTR_EMULATE_PREPARES => false);

            $created = new \PDO($dsn, $dbUser, $dbPass, $driverOption);
            return $created;
        } catch (\Exception $e) {
        	throw new \ErrorException('DB Error が発生しました。');
        }
    }
}
