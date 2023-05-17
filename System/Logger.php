<?php
namespace System;

use DateTime;

class Logger
{
    private $file_path;

    public function __construct(string $file_path)
    {
        $this->file_path = $file_path;
    }

    public function log(string $message): void
    {
        $date_time = new DateTime();
        $log_message = $date_time->format('Y-m-d H:i:s') . ' - ' . $message . PHP_EOL;
        file_put_contents($this->file_path, $log_message, FILE_APPEND);
    }
}
