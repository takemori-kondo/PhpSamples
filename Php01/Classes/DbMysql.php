<?php
// PHP Version 8.1
declare(strict_types=1);

namespace Php01\Classes;

class DbMysql extends Db
{
    protected static $pdo;

    protected static function newPdo()
    {
        try {
            $dbServer = 'mysql';
            $dbHost = '127.0.0.1';
            $dbCharset = 'utf8mb4';
            $dsn = $dbServer . ':host=' . $dbHost . ';charset=' . $dbCharset;
            $dbUser = 'root';
            $dbPass = 'foo';
            $driverOption = array(\PDO::ATTR_EMULATE_PREPARES => false);

            $created = new \PDO($dsn, $dbUser, $dbPass, $driverOption);
            $created->setAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
            return $created;
        } catch (\Exception $e) {
            throw new \ErrorException('DB Error が発生しました。' . $e->getMessage());
        }
    }

    // static
    ///////////
    // instance

    /**
     * get pdo.
     * 
     * @return \Pdo
     */
    public function getPdo()
    {
        if (static::$pdo == null) {
            static::$pdo = static::newPdo();
        }
        return static::$pdo;
    }

    /**
     * get db version
     * 
     * @return string
     */
    public function getDbVersion()
    {
        // get pdo
        $pdo = $this->getPdo();
        $result = $pdo->query("SELECT version()");
        $array = $result->fetch(\PDO::FETCH_NUM);
        return 'MySQL : ' . $array[0];
    }

    /**
     * create db and schema if not exists.
     * 
     * @return void
     */
    public function initSchema()
    {
        // get pdo
        $pdo = $this->getPdo();

        // create db
        $result = $pdo->query("SHOW DATABASES LIKE 'php_sample'")->fetchAll(\PDO::FETCH_ASSOC);
        if (count($result) <= 0) {
            $pdo->exec("CREATE DATABASE php_sample");
        }
        $pdo->exec("USE php_sample");

        // create schema & insert initial data
        $result = $pdo->query("SHOW TABLES LIKE 'sample_values'")->fetchAll(\PDO::FETCH_ASSOC);
        if (count($result) <= 0) {
            $pdo->exec("CREATE TABLE sample_values(id BIGINT AUTO_INCREMENT, name VARCHAR(255), PRIMARY KEY(id))");
            $names = ['Alice', 'Bob', 'Carol', 'Dave'];
            $stmt = $pdo->prepare("INSERT INTO sample_values(name) values(:name)");
            foreach ($names as $name) {
                $stmt->bindParam(':name', $name, \PDO::PARAM_STR);
                $stmt->execute();
            }
        }
    }

    /**
     * get all rows of sample_values.
     * 
     * @return \PDOStatement
     */
    public function getSampleValues()
    {
        return parent::getSampleValues();
    }
}
