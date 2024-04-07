<?php
// PHP Version 8.1
declare(strict_types=1);

namespace Php02\Classes;

class DbSqlite
{
    protected static $pdo;

    protected static function newPdo()
    {
        try {
            $dbServer = 'sqlite';
            $filePath = __DIR__ . '/php_sample.db';
            $dsn = $dbServer . ':' . $filePath;
            $dbUser = '';
            $dbPass = '';
            $driverOption = array(\PDO::ATTR_EMULATE_PREPARES => false);



            $created = new \PDO($dsn, $dbUser, $dbPass, $driverOption);
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
        $result = $pdo->query("SELECT sqlite_version()");
        $array = $result->fetch(\PDO::FETCH_NUM);
        return 'SQLite : ' . $array[0];
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
        // Sqliteはdbを明示的に作る必要がない（1つしかサポートしないためなければ勝手に作られる）





        // create schema & insert initial data
        $result = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='todos'")->fetchAll((\PDO::FETCH_ASSOC));
        if (count($result) <= 0) {

            $sql1 = <<<'HEREDOC'
            CREATE TABLE todos( 
                id INTEGER PRIMARY KEY
                , name
                , content
                , created
                , modified
            )
            HEREDOC;
            $pdo->exec($sql1);


            $sql2 = <<<'HEREDOC'
            INSERT INTO todos(name, content) VALUES (:name, :content)
            HEREDOC;
            $stmt = $pdo->prepare($sql2);
            $data = [
                'TODOサンプル1' => '〇〇を××する',
                'TODOサンプル2' => '〇〇を△△する',
                'TODOサンプル3' => '〇〇を□□する'
            ];
            foreach ($data as $name => $content) {
                $stmt->bindParam(':name', $name, \PDO::PARAM_STR);
                $stmt->bindParam(':content', $content, \PDO::PARAM_STR);
                $stmt->execute();
            }
        }
    }
}
