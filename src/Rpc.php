<?php
namespace Saiks24\Rpc;


use Saiks24\Rpc\Exceptions\WrongJsonRpcRequestException;
use Saiks24\Rpc\Exceptions\WrongJsonRpcResponseException;

class Rpc
{
    const RPC_PROTOCOL_VERSION_1_0 = '1.0';
    const RPC_PROTOCOL_VERSION_2_0 = '2.0';
    const RPC_RESPONSE_STATUS_SUCCESS = 'success';
    const RPC_RESPONSE_STATUS_ERROR = 'error';

    /** Validate that input string - is correct JSON-RPC Request
     * @param string $request
     *
     * @return bool
     * @throws \Saiks24\Rpc\Exceptions\WrongJsonRpcRequestException
     */
    public static function validateRequest(string $request) : bool
    {
        $request = json_decode($request,true);
        if(empty($request)) {
            throw new WrongJsonRpcRequestException();
        }
        if(!isset($request['jsonrpc'])) {
            throw new WrongJsonRpcRequestException();
        }
        if(!isset($request['method'])) {
            throw new WrongJsonRpcRequestException();
        }
        if(!isset($request['params'])) {
            throw new WrongJsonRpcRequestException();
        }
        return true;
    }

    /** Validate that input string is - correct JSON-RPC response
     * @param string $response
     *
     * @return bool
     * @throws \Saiks24\Rpc\Exceptions\WrongJsonRpcResponseException
     */
    public static function validateResponse(string $response) : bool
    {
        $response = json_decode($response,true);
        if(empty($response)) {
            throw new WrongJsonRpcResponseException();
        }
        if(!isset($response['jsonrpc'])) {
            throw new WrongJsonRpcResponseException();
        }
        if(!isset($response['error']) && !isset($response['result'])) {
            throw new WrongJsonRpcResponseException();
        }
        if(isset($response['error']) && gettype($response['error']) !== 'array') {
            throw new WrongJsonRpcResponseException();
        }
        return true;
    }
}