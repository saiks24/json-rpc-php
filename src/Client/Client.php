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

    /** Set server to request address
     * @param String $address
     *
     * @return mixed|void
     */
    public function setRequestAddress(String $address)
    {
        $this->serverAddress = $address;
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
     * @param \Saiks24\Rpc\Senders\SenderInterface $sender
     *
     * @return \Saiks24\Rpc\Response\RpcResponse
     */
    public function sendRequest(SenderInterface $sender): RpcResponse
    {
        $response = $sender->send($this->request,$this->serverAddress);
        return $response;
    }

}