<?php

namespace app\helpers;

use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;


/**
 *
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Xolmat Ravshanov
 *
 * @github https://github.com/xolmatravshanov
 *
 */

class Swift
{
    /**
     * @var Swift_SmtpTransport
     */
    private $transport;

    /**
     * @var int
     */
    public $timeout = 999;
    /**
     * @var Swift_Mailer
     */
    private $mailer;

    /**
     * @var Swift_Message
     */
    private $message;

    private $username = [
        'hostland' => 'hostland@gmail.com',
    ];

    private $password = [
        'hostland' => 'passwordHostland',
    ];

    private $hostname = [
        'hostland' => 'mail.hostland.ru',
        'yandex' => 'smtp.yandex.ru',
        'google' => 'smtp.google.com',
    ];

    private $ports = [
        'yandex' => 465, // yandex ssl
        'default' => 25,
        'google' => 587, // tls / 465
        'client' => 587, // tls / 465
    ];
    /**
     * @var result of send email
     */
    public $result;
    /**
     * @var string[] by whom send email
     */
    public $from = ['admin@company.group' => 'Info company'];
    /**
     * @var array recivers array
     */
    public $recivers = [
        'xolmatrw@gmail.com',
        'realkino.uz@gmail.com',
    ];
    /**
     * @var string mail subject
     */
    public $subject = 'test from default';
    /**
     * @var string mail body
     */
    public $body = 'Test body from default';





    public function __construct()
    {
        /**
         * connectiong to smtp server
         */

        $this->connector();
    }

    private function connector()
    {


        var_dump($this->timeout);

        $this->transport = (new Swift_SmtpTransport($this->hostname['hostland'], $this->ports['default']))
            ->setUsername($this->username['hostland'])
            ->setPassword($this->password['hostland']);

        $this->transport->setTimeout($this->timeout);

        $this->mailer = new Swift_Mailer($this->transport);

    }

    public function setMessage()
    {
        $this->message = (new Swift_Message($this->subject))
            ->setFrom($this->from)
            ->setTo($this->recivers)
            ->setBody($this->body);
    }

    public function sender()
    {

        $this->setMessage();

        try {

            $this->result = $this->mailer->send($this->message);

        } catch (\Swift_TransportException $exception) {

            $message = $exception->getMessage();

        }

    }


    public function close()
    {
        $this->transport->stop();
    }



}
