<?php

namespace Saiks24\Rpc\Client;


use Saiks24\Rpc\Request\Request;
use Saiks24\Rpc\Response\RpcResponse;
use Saiks24\Rpc\Senders\SenderInterface;

/** JSON-RPC Client
 * Class Client
 *
 * @package Saiks24\Rpc\Client
 */
class Client implements RpcClientInterface
{
    /** @var String $serverAddress */
    private $serverAddress;

    /** @var Request */
    private $request;

    /** @var \Saiks24\Rpc\Senders\SenderInterface  */
    private $sender;

    /**
     * Client constructor.
     *
     * @param String $serverAddress
     * @param Request $request
     */
    public function __construct(String $serverAddress, Request $request=null,SenderInterface $sender)
    {
        $this->serverAddress = $serverAddress;
        $this->request = $request;
        $this->sender = $sender;
    }

    /** Set JSON-RPC request body
     * @param \Saiks24\Rpc\Request\Request $request
     *
     * @return mixed|void
     */
    public function setRequestBody(Request $request)
    {
        $this->request = $request;
    }

    /** Send request to server
     *
     * @return \Saiks24\Rpc\Response\RpcResponse
     */
    public function sendRequest(): RpcResponse
    {
        $response = $this->sender->send($this->request,$this->serverAddress);
        return $response;
    }

}