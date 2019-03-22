<?php

namespace Saiks24\Rpc\Server;

use Psr\Http\Message\StreamInterface;
use Saiks24\Rpc\Response\RpcResponseInterface;

/**
 * Class Server
 *
 * @package Saiks24\Rpc\Server
 */
class Server implements RpcServerInterface
{
    /** @var \Saiks24\Rpc\Response\RpcResponse */
    private $response;

    public function setResponse(RpcResponseInterface $response)
    {
        $this->response = $response;
    }

    public function sendResponse(StreamInterface $stream): bool
    {
        $stream->write($this->response->serialize());
    }

}