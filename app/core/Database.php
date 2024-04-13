<?php

namespace app\core;

trait Database
{
    // Establish database connection using PDO
    private function connect()
    {
        $dsn = "mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8mb4";
        $options = [
            \PDO::ATTR_EMULATE_PREPARES   => false, // Turn off emulation mode for "real" prepared statements
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION, // Turn on errors in the form of exceptions
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC, // Makes database results easier to handle
        ];
        try {
            $pdo = new \PDO($dsn, DBUSER, DBPASS, $options);
            return $pdo;
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    // General purpose query function
    public function query($sql, $params = [])
    {
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(); // Default fetch mode set to FETCH_ASSOC
    }
}
