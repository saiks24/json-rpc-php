<?php

namespace Saiks24\Rpc\Client;


use Saiks24\Rpc\Request\Request;
use Saiks24\Rpc\Response\RpcResponse;
use Saiks24\Rpc\Senders\SenderInterface;

class Client implements RpcClientInterface
{
    /** @var String $serverAddress */
    private $serverAddress;

    /** @var Request */
    private $request;

    public function setRequestAddress(String $address)
    {
        $this->serverAddress = $address;
    }

    public function setRequestBody(Request $request)
    {
        $this->request = $request;
    }

    public function sendRequest(SenderInterface $sender): RpcResponse
    {
        $response = $sender->send($this->request);
        return $response;
    }

}