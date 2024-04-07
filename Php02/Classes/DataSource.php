<?php
// PHP Version 8.1
declare(strict_types=1);

namespace Php02\Classes;

use \Php02\Classes\DbSqlite;

class DataSource
{
    /**
     * Connect db.
     * 
     * @return void
     */
    public static function openOrInitializeDB()
    {
        $db = new DBSqlite();
        $db->initSchema();
    }

    /**
     * get db version
     * 
     * @return string
     */
    public static function getDbVersion()
    {
        $db = new DBSqlite();
        return $db->getDbVersion();
    }

    /**
     * Get all todos.
     *
     * @return \PDOStatement
     */
    public static function getAllTodos()
    {
        $db = new DBSqlite();
        $pdo = $db->getPdo();
        return $pdo->query("SELECT * FROM todos ORDER BY id");
    }

    /**
     * Add todo.
     *
     * @return \PDOStatement
     */
    public static function addTodo()
    {
        $db = new DBSqlite();
        $pdo = $db->getPdo();
        return $pdo->query("INSERT INTO todos(name, content, created, modified) values('新しいTODO', '内容を入力してください', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
    }

    /**
     * Update all todos.
     *
     * @param array $todos ["<id>" => ["name" => "<name>", "content" => "<content>"]];.
     *
     * @return \PDOStatement
     */
    public static function updateAllTodos($todos)
    {
        $db = new DBSqlite();
        $pdo = $db->getPdo();
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
     * @param string $id  id.
     *
     * @return \PDOStatement
     */
    public static function deleteTodo($id)
    {
        $db = new DBSqlite();
        $pdo = $db->getPdo();
        $stmt = $pdo->prepare("DELETE FROM todos WHERE id=:id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;
    }
}
