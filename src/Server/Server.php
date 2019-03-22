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

    /** Set response body
     * @param \Saiks24\Rpc\Response\RpcResponseInterface $response
     *
     * @return mixed|void
     */
    public function setResponse(RpcResponseInterface $response)
    {
        $this->response = $response;
    }

    /** Write Response in stream
     * @param \Psr\Http\Message\StreamInterface $stream
     *
     * @return bool
     */
    public function sendResponse(StreamInterface $stream): bool
    {
        $stream->write($this->response->serialize());
    }

}