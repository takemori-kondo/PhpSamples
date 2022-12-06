<?php
// PHP Version 8.1
declare(strict_types=1);
namespace Php02\Classes;

use \Php02\Classes\DbSqlite;

class DataSource
{
    /**
     * Connect DB.
     *
     * @param string $dbName DB name.
     *
     * @return \PDO
     */
    public static function openOrInitializeDB($dbName = 'todo_list')
    {
        // $pdo = DbMysql::getPdo();
        $pdo = DBSqlite::getPdo();

        // If DB does not exist, creating it.
        /*
        if ($pdo->query("SHOW DATABASES LIKE '$dbName'")->rowCount() <= 0) {
            $pdo->exec("CREATE DATABASE ".$dbName);
        }
        $pdo->exec("USE ".$dbName);
        */

        // If table does not exist, creating it.
        
        // $selectTableName = "SHOW TABLES LIKE '$tableName'";
        $selectTableName = "SELECT name FROM sqlite_master WHERE type='table' AND name='todos'";
        $data = $pdo->query($selectTableName)->fetchAll();
        if (count($data) <= 0) {
            /*
            // This sql requires mysql5.6/mariadb10.1 or more.
            $sql1 = "CREATE TABLE todos"
                ."( id       INT AUTO_INCREMENT"
                .", name     VARCHAR(255)"
                .", content  VARCHAR(255)"
                .", created  DATETIME DEFAULT CURRENT_TIMESTAMP"
                .", modified DATETIME DEFAULT CURRENT_TIMESTAMP"
                ."                    ON UPDATE CURRENT_TIMESTAMP"
                .", PRIMARY KEY(id))";
            */
            $sql1 = "CREATE TABLE todos"
                ."( id INTEGER PRIMARY KEY"
                .", name"
                .", content"
                .", created"
                .", modified)";
            $pdo->exec($sql1);

            $sql2 = "INSERT INTO todos"
                ."       ( name,  content)"
                ." values(:name, :content)";
            $stmt = $pdo->prepare($sql2);
            $data = (
                ['TODOサンプル1' => '〇〇を××する'
                ,'TODOサンプル2' => '〇〇を△△する'
                ,'TODOサンプル3' => '〇〇を□□する']
            );
            foreach ($data as $name => $content) {
                $stmt->bindParam(':name', $name, \PDO::PARAM_STR);
                $stmt->bindParam(':content', $content, \PDO::PARAM_STR);
                $stmt->execute();
            }
        }
        return $pdo;
    }

    /**
     * Get all todos.
     *
     * @param \PDO $pdo pdo instance.
     *
     * @return \PDOStatement
     */
    public static function getAllTodos($pdo)
    {
        return $pdo->query("SELECT * FROM todos ORDER BY id");
    }

    /**
     * Add todo.
     *
     * @param \PDO $pdo pdo instance.
     *
     * @return \PDOStatement
     */
    public static function addTodo($pdo)
    {
        // return $pdo->query("INSERT INTO todos(name, content) values('新しいTODO', '内容を入力してください')");
        return $pdo->query("INSERT INTO todos(name, content, created, modified) values('新しいTODO', '内容を入力してください', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
    }

    /**
     * Update all todos.
     *
     * @param \PDO  $pdo   pdo instance.
     * @param array $todos ["<id>" => ["name" => "<name>", "content" => "<content>"]];.
     *
     * @return \PDOStatement
     */
    public static function updateAllTodos($pdo, $todos)
    {
        // $stmt = $pdo->prepare("UPDATE todos SET name=:name, content=:content WHERE id=:id");
        $stmt = $pdo->prepare("UPDATE todos SET name=:name, content=:content, modified=CURRENT_TIMESTAMP WHERE id=:id");
        foreach ($todos as $id => $assoc) {
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->bindParam(':name', $assoc['name'], \PDO::PARAM_STR);
            $stmt->bindParam(':content', $assoc['content'], \PDO::PARAM_STR);
            $stmt->execute();
        }
        return $stmt;
    }

    /**
     * Delete todo.
     *
     * @param \PDO   $pdo pdo instance.
     * @param string $id  id.
     *
     * @return \PDOStatement
     */
    public static function deleteTodo($pdo, $id)
    {
        $stmt = $pdo->prepare("DELETE FROM todos WHERE id=:id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;
    }
}
