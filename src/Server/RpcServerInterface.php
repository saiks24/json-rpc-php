<?php

namespace Saiks24\Rpc\Server;

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
     * @return bool
     */
    public function sendResponse() : bool;

}