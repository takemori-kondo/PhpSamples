<?php

namespace Php02;

/**
 * Todo data source.
 *
 * PHP Version 7.2
 *
 * @category Foo
 * @package  None
 * @author   takemori <foo@bar.baz>
 * @license  https://bar.baz/ MIT License
 * @link     None
 */
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
        // Connect DB server.
        $pdo = DBMysql::getPdo();

        // Open or create DB.
        if ($pdo->query("SHOW DATABASES LIKE '$dbName'")->rowCount() <= 0) {
            $pdo->exec("CREATE DATABASE ".$dbName);
        }
        $pdo->exec("USE ".$dbName);

        // Open or create table.
        $tableName = 'todos';
        if ($pdo->query("SHOW TABLES LIKE '$tableName'")->rowCount() <= 0) {
            // This sql requires mysql5.6/mariadb10.1 or more.
            $sql1 = "CREATE TABLE ".$tableName
                ."( id       INT AUTO_INCREMENT"
                .", name     VARCHAR(255)"
                .", content  VARCHAR(255)"
                .", created  DATETIME DEFAULT CURRENT_TIMESTAMP"
                .", modified DATETIME DEFAULT CURRENT_TIMESTAMP"
                ."                    ON UPDATE CURRENT_TIMESTAMP"
                .", PRIMARY KEY(id))";
            $pdo->exec($sql1);

            $sql2 = "INSERT INTO ".$tableName
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
     * @param \PDO   $pdo pdo instance.
     *
     * @return \PDOStatement
     */
    public static function addTodo($pdo)
    {
        $pdo->query("INSERT INTO todos(name, content) values('新しいTODO', '内容を入力してください')");
    }

    /**
     * Update all todos.
     *
     * @param \PDO  $pdo    pdo instance.
     * @param array $todos  ["<id>" => ["name" => "<name>", "content" => "<content>"]];.
     *
     * @return \PDOStatement
     */
    public static function updateAllTodos($pdo, $todos)
    {
        $stmt = $pdo->prepare("UPDATE todos SET name=:name, content=:content WHERE id=:id");
        foreach ($todos as $id => $assoc) {
            $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
            $stmt->bindParam(':name', $assoc['name'], \PDO::PARAM_STR);
            $stmt->bindParam(':content', $assoc['content'], \PDO::PARAM_STR);
            $stmt->execute();
        }
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
