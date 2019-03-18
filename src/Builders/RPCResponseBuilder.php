<?php
namespace Saiks24\Rpc\Builders;

use Saiks24\Rpc\Response\Error;
use Saiks24\Rpc\Response\Result;
use Saiks24\Rpc\Response\RpcResponse;

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

    public function withStatus(String $status)
    {
        $this->response->setStatus($status);
        return $this;
    }

    public function withId(String $id)
    {
        $this->response->setId($id);
        return $this;
    }

    public function withError(Error $error)
    {
        $this->response->setError($error);
    }

    public function withResult(Result $result)
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
        return $this->response;
    }
}