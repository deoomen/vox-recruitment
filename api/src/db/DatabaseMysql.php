<?php

namespace VOXApi\Db;

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
    private ?\PDO $connection;

    /**
     * Loads database config
     */
    public function __construct()
    {
        if (!($config = \parse_ini_file("config/config.ini", true))) {
            $message = "Unable to load config file.";
            $this->log($message);
            throw new \Exception($message);
        }

        $this->host = $config["database"]["host"];
        $this->port = $config["database"]["port"];
        $this->username = $config["database"]["username"];
        $this->password = $config["database"]["password"];
        $this->dbname = $config["database"]["dbname"];
        $this->connection = null;
    }

    /**
     * Write log to file
     *
     * @param string $message log text message
     *
     * @return void
     */
    private function log(string $message): void
    {
        \error_log(\date("c") . " - " . $message . "\n", 3, "logs/" . \date("Ymd") . "_db_errors.log");
    }

    /**
     * Try to connect to database and return result
     *
     * @return \PDO|null
     */
    public function connection(): ?\PDO
    {
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
                $this->log(\implode(" - ", [
                    "Code: {$ex->getCode()}",
                    "Line: {$ex->getLine()}",
                    "Message: {$ex->getMessage()}"
                ]));
            }
        }

        return $this->connection;
    }
}
