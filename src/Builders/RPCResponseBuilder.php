<?php
namespace Saiks24\Rpc\Builders;

use Saiks24\Rpc\Response\RpcResponse;

class RPCResponseBuilder
{

    /** @var  */
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

    public function withErrorCode(String $errorCode)
    {
        $this->response->setErrorCode($errorCode);
        return $this;
    }

    public function withErrorMessage(String $errorMessage)
    {
        $this->response->setErrorMessage($errorMessage);
        return $this;
    }

    public function withResult(String $result)
    {
        $this->response->setResult($result);
        return $this;
    }

    public function withProtocol(String $protocol)
    {
        $this->response->setProtocol($protocol);
        return $this;
    }

    public function build()
    {
        return $this->response;
    }
}