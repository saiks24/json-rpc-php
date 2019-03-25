<?php
namespace Saiks24\Rpc\Builders;

use Psr\Http\Message\ResponseInterface;
use Saiks24\Rpc\Exceptions\WrongJsonRpcRequestException;
use Saiks24\Rpc\Response\Error;
use Saiks24\Rpc\Response\Result;
use Saiks24\Rpc\Response\RpcResponse;
use Saiks24\Rpc\Response\RpcResponseInterface;
use Saiks24\Rpc\Rpc;

/**
 * Class RPCResponseBuilder
 *
 * Factory class to create instances of the class RpcResponse
 * @package Saiks24\Rpc\Builders
 */
class RPCResponseBuilder
{

    /** @var  RpcResponse */
    private $response;

    /**
     * @var String Version of RPC-JSON Protocol
     */
    private $protocolVersion;

    /**
     * RPCRequestBuilder constructor.
     *
     * @param String $protocolVersion - Version of json-rpc protocol
     */
    public function __construct(String $protocolVersion)
    {
        $this->protocolVersion = $protocolVersion;
        $response = new RpcResponse();
        $response->setProtocol($protocolVersion);
        $this->response = $response;
    }

    public static function getBuilder(String $protocolVersion)
    {
        return new RPCResponseBuilder($protocolVersion);
    }

    public function withId(String $id)
    {
        $this->response->setId($id);
        return $this;
    }

    public function withError(Error $error)
    {
        $this->response->setError($error);
        return $this;
    }

    public function withResult(string $result)
    {
        $this->response->setResult($result);
        return $this;
    }

    public function withProtocol(String $protocol)
    {
        $this->response->setProtocol($protocol);
        return $this;
    }

    public function build() : RpcResponse
    {
        $response = $this->response;
        $this->response = null;
        return $response;
    }

    public function createFromString(String $responseBody)
    {
        $response = new RpcResponse();
        $responseBody = json_decode($responseBody,true);
        $response->setProtocol($responseBody['jsonrpc']);
        if(isset($responseBody['error'])) {
            $response->setError(
              new Error($responseBody['error']['code'],$responseBody['error']['message'])
            );
        } else {
            $response->setResult($responseBody['result']);
        }
        if(isset($responseBody['id'])) {
            $response->setId($responseBody['id']);
        }
        $this->response = $response;
        return $this;
    }

    public function createFromPsrResponse(ResponseInterface $response)
    {
        $body = $response->getBody()->getContents();
        return $this->createFromString($body)->response;
    }
}