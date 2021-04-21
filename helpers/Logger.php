<?php

namespace app\helpers;

use Monolog\Logger as MonologLogger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
use yii\helpers\FileHelper;

class Logger
{

    public $logger;
    public $message;
    public $channelName = 'email_logging';
    public $logFile = "/var/www/ntl/backend/runtime/logs/";

    public function __construct()
    {

        $this->logger = new MonologLogger($this->channelName);

        $this->logFile .= "$this->channelName" . ".log";

        if (!file_exists($this->logFile)) {
            $open = fopen($this->logFile, 'w+');
            fclose($open);
        }

        $this->logger->pushHandler(new StreamHandler($this->logFile, MonologLogger::DEBUG));

        $this->logger->pushHandler(new FirePHPHandler());

    }

    public function setMessage()
    {
        $this->logger->debug($this->message);
    }


}
