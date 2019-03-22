<?php

namespace Saiks24\Rpc\Server;

use Psr\Http\Message\StreamInterface;
use Saiks24\Rpc\Response\RpcResponseInterface;

/** Base Server interface
 * Interface RpcServerInterface
 *
 * @package Saiks24\Rpc\Server
 */
interface RpcServerInterface
{

    /** Set Response body
     * @param \Saiks24\Rpc\Response\RpcResponseInterface $response
     *
     * @return mixed
     */
    public function setResponse(RpcResponseInterface $response);

    /** Send response to client
     * @param \Psr\Http\Message\StreamInterface $stream
     *
     * @return bool
     */
    public function sendResponse(StreamInterface $stream) : bool;

}