<?php
// PHP Version 8.1
declare(strict_types=1);

namespace Php01\Classes;

abstract class Db
{
    /**
     * get pdo.
     * 
     * @return \Pdo
     */
    public abstract function getPdo();

    /**
     * get db version
     * 
     * @return string
     */
    public abstract function getDbVersion();

    /**
     * create db and schema if not exists.
     * 
     * @return void
     */
    public abstract function initSchema();

    /**
     * get all rows of sample_values.
     * 
     * @return \PDOStatement
     */
    public function getSampleValues()
    {
        $pdo = $this->getPdo();
        $result = $pdo->query("SELECT * FROM sample_values ORDER BY id");
        return $result;
    }
}
