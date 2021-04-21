<?php

namespace app\helpers;


use GuzzleHttp\Client;


/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Xolmat Ravshanov
 * @github https://github.com/xolmatravshanov
 */



class SmsHelper {

    /**
     * methods
     */
    const METHOD_POST = 'POST';
    const METHOD_GET = 'GET';

    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @var responseBody
     */
    public $responseBody;

    /**
     * @var api token
     */
    private $token;

    /**
     * @var $baseUrl
     */
    public $baseUrl = 'http://91.204.239.44';

    /**
     * @var int
     */
    public $timeout  = 2;

    /**
     * @var string
     */
    private $login = 'loginPlaymobile';

    /**
     * @var string
     */
    private $password = 'paswordPlayMobile';

    /**
     * @var string
     */
    public $reciverNumber = '998934631525';

    /**
     * @var string
     */
    public $messageId = '12';

    /**
     * @var string 3700
     */
    public $text = 'company group support';

    /**
     * @var string
     */
    private $originator = '3700';

    /**
     * @var
     */
    private $response;

    /**
     * @var int
     */
    public $responseCode;


    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
        ]);



    }

    public function sendRequest(){

        $this->response = $this->client->request(self::METHOD_POST, '/broker-api/send', [
            'auth' => [$this->login, $this->password],
            'json' => [
                "messages" => [
                    [
                        "recipient" => $this->reciverNumber,
                        "message-id" => $this->messageId,
                        "sms" => [
                            "originator" => $this->originator,
                            "content" =>  [
                                "text" => $this->text
                             ]
                        ],
                    ]
                ]
            ]
        ]);

        $this->responseCode =  $this->response->getStatusCode();


    }


}
