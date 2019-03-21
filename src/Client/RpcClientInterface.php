<?php

namespace Saiks24\Rpc\Client;


use Saiks24\Rpc\Request\Request;
use Saiks24\Rpc\Response\RpcResponse;
use Saiks24\Rpc\Senders\SenderInterface;

/** Base JSON RPC Client Interface
 * Interface RpcClientInterface
 *
 * @package Saiks24\Rpc\Client
 */
interface RpcClientInterface
{

    /** Set target to request
     * @param String $address (Example: 0.0.0.0 http://sitename.com )
     *
     * @return mixed
     */
    public function setRequestAddress(String $address);

    /** Set Body for request
     * @param \Saiks24\Rpc\Request\Request $request
     *
     * @return mixed
     */
    public function setRequestBody(Request $request);

    /** Send request and get RpcResponse
     * @param \Saiks24\Rpc\Senders\SenderInterface $sender
     *
     * @return \Saiks24\Rpc\Response\RpcResponse
     */
    public function sendRequest(SenderInterface $sender) : RpcResponse;
}