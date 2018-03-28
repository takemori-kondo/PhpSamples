<?php
/**
 * PDO for MySQL.
 *
 * PHP Version 7.2
 *
 * @category Foo
 * @package  None
 * @author   takemori <foo@bar.baz>
 * @license  https://bar.baz/ MIT License
 * @link     None
 */

/**
 * DB Class.
 *
 * PHP Version 7.2
 *
 * @category Foo
 * @package  None
 * @author   takemori <foo@bar.baz>
 * @license  https://bar.baz/ MIT License
 * @link     None
 */
class DBMysql
{
    /**
     * Inner variable.
     * 
     * @var PDO $pdo
     */
    protected static $pdo;

    /**
     * Singleton getter.
     * 
     * @return PDO
     */
    public static function getPdo()
    {
        if (static::$pdo == null) {
            static::$pdo = static::newPdo();
        }
        return static::$pdo;
    }

    /**
     * New PDO instance.
     * 
     * @return PDO;
     */
    protected static function newPdo()
    {
        try {
            $dbServer = 'mysql';
            $dbHost = '127.0.0.1';
            $dbCharset = 'utf8mb4';
            $dsn = $dbServer.':host='.$dbHost.';charset='.$dbCharset;
            $dbUser = 'root';
            $dbPass = 'foo';
            $driverOption = array(PDO::ATTR_EMULATE_PREPARES => false);

            $created = new PDO($dsn, $dbUser, $dbPass, $driverOption);
            $created->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
            return $created;
        }
        catch (Exception $e) {

        }
    }
}