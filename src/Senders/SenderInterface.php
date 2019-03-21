<?php
namespace Saiks24\Rpc\Senders;

use Saiks24\Rpc\Request\Request;
use Saiks24\Rpc\Response\RpcResponse;

/** Basic sender interface.
 *  The implementation must implement a send method that takes a Saiks24\Rpc\Request
 *  object as a parameter and sends a response to the client.
 *  Required to support different protocols
 *
 * Interface SenderInterface
 *
 * @package Saiks24\Rpc\Senders
 */
interface SenderInterface
{

    /** Send request to server
     * @param \Saiks24\Rpc\Request\Request $request
     * @param String $requestAddress
     *
     * @return RpcResponse
     */
    public function send(Request $request, String $requestAddress) : RpcResponse;
}