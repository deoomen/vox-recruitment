<?php

namespace VOXApi\Helpers;

class Logger
{
    public const FILENAME_DATABASE = "db_errors";
    public const FILENAME_ERRORS = "errors";

    /**
     * Write log to file
     *
     * @param string $message log text message
     * @param string $filename log name
     *
     * @return void
     */
    public static function log(string $message, string $filename): void
    {
        \error_log(\date("c") . " - " . $message . "\n", 3, "logs/" . \date("Ymd") . "_{$filename}.log");
    }
}
