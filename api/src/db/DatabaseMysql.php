<?php

namespace VOXApi\Db;

use VOXApi\Helpers\Logger;

/**
 * MySQL database connection class
 *
 * @category Database
 * @author deoomen <deoomen@pm.me>
 */
class DatabaseMysql
{
    private string $host;
    private int $port;
    private string $username;
    private string $password;
    private string $dbname;
    private static ?self $instance = null;
    private ?\PDO $connection = null;

    /**
     * Loads database config
     */
    public function __construct()
    {
        if (!($config = \parse_ini_file("config/config.ini", true))) {
            $message = "Unable to load config file.";
            Logger::log($message, Logger::FILENAME_DATABASE);
            throw new \Exception($message);
        }

        $this->host = $config["database"]["host"];
        $this->port = $config["database"]["port"];
        $this->username = $config["database"]["username"];
        $this->password = $config["database"]["password"];
        $this->dbname = $config["database"]["dbname"];

        if ($this->connection === null) {
            try {
                $this->connection = new \PDO(
                    "mysql:host={$this->host};port={$this->port};dbname={$this->dbname}",
                    $this->username,
                    $this->password,
                    [
                        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
                        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
                    ]
                );
            } catch (\Exception $ex) {
                Logger::log(\implode(" - ", [
                    "Code: {$ex->getCode()}",
                    "Line: {$ex->getLine()}",
                    "Message: {$ex->getMessage()}"
                ]), Logger::FILENAME_DATABASE);
            }
        }
    }

    /**
     * Try to connect to database and return result
     *
     * @return \PDO
     */
    public static function connection(): \PDO
    {
        if (self::$instance === null) {
            self::$instance = new DatabaseMysql();
        }

        return self::$instance->connection;
    }
}
