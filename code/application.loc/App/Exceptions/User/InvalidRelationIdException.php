<?php

namespace App\Exceptions\User;

use App\Exceptions\ILogged;
use App\Exceptions\IOutable;
use App\Logger\ApplicationLogger;
use Exception;
use Monolog\Logger;

class InvalidRelationIdException extends Exception implements ILogged, IOutable
{
    /**
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct(string $message = "", int $code = 0, Exception $previous = null)
    {
        $message = "User Relation Id error: " . $message;
        ApplicationLogger::addLog(Logger::ERROR, $message);
        parent::__construct($message, $code, $previous);
    }
}