<?php

namespace App\Exceptions\User;

use App\Exceptions\ILogged;
use App\Logger\ApplicationLogger;
use Exception;
use Monolog\Logger;

class InvalidUserRoleException extends Exception implements ILogged
{
    /**
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct(string $message = "", int $code = 0, Exception $previous = null)
    {
        $this->message = "User role error: ";
        ApplicationLogger::addLog(Logger::ERROR, $this->message . $message);
        parent::__construct($this->message, $code, $previous);
    }
}