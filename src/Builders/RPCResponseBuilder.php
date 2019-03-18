<?php
namespace Saiks24\Rpc\Builders;

use Saiks24\Rpc\Response\RpcResponse;

class RPCResponseBuilder
{

    /** @var \Saiks24\Rpc\Response\RpcResponseInterface */
    private $response;

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
        $this->response = $response->withProtocol($protocolVersion);
    }

    public static function getBuilder(String $protocolVersion)
    {
        return new RPCResponseBuilder($protocolVersion);
    }

    public function getResponseObject()
    {
        return $this->response;
    }

}