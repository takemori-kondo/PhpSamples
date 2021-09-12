<?php
// PHP Version 8.1

namespace Php01\Classes;

class DbMysql
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
            $dbServer = 'mysql';
            $dbHost = '127.0.0.1';
            $dbCharset = 'utf8mb4';
            $dsn = $dbServer.':host='.$dbHost.';charset='.$dbCharset;
            $dbUser = 'root';
            $dbPass = 'foo';
            $driverOption = array(\PDO::ATTR_EMULATE_PREPARES => false);

            $created = new \PDO($dsn, $dbUser, $dbPass, $driverOption);
            $created->setAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
            return $created;
        } catch (\Exception $e) {
        	throw new \ErrorException('DB Error が発生しました。');
        }
    }
}
