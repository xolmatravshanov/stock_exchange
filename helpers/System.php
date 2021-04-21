<?php

namespace app\helpers;


/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Xolmat Ravshanov
 * @github https://github.com/xolmatravshanov
 */

use app\helpers\Logger;
use yii\console\ExitCode;

class System
{
    const root = "";
    public $rootApp = '/var/www/';
    public $php = "/usr/bin/php";
    public $cmdUser = null;
    public $cmdOrder = null;
    public $args = null;


    public function __construct()
    {

    }

    public function user()
    {

        $line = "{php} {root}/yii {cmd} {args}";

        $cmd = strtr($line, [
            '{php}' => $this->php,
            '{root}' => $this->rootApp,
            '{cmd}' => $this->cmdUser,
            '{args}' => $this->args
        ]);

        $this->exec($cmd);

    }

    public function order()
    {

        $line = "{php} {root}/yii {cmd}";

        $cmd = strtr($line, [
            '{php}' => $this->php,
            '{root}' => $this->rootApp,
            '{cmd}' => $this->cmdOrder,
        ]);

        var_dump($line);

        $this->exec($cmd);

    }


    public function exec($cmd)
    {

        if (!$this->isLinux()) {
            pclose(popen("start /B {$cmd}", "w"));
            return ExitCode::OK;
        }

        exec($cmd . " > /dev/null &");

    }

    public function isLinux()
    {
        if (substr(php_uname(), 0, 7) == "Windows") {
            return false;
        } else {
            return true;
        }
    }

}

