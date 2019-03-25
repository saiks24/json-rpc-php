<?php
namespace Saiks24\Rpc\Builders;

use Psr\Http\Message\RequestInterface;
use Saiks24\Rpc\Exceptions\WrongJsonRpcRequestException;
use Saiks24\Rpc\Request\Request;
use Saiks24\Rpc\Response\Error;
use Saiks24\Rpc\Response\RpcResponse;
use Saiks24\Rpc\Rpc;

class RPCRequestBuilder
{
    private $protocolVersion;
    /** @var Request */
    private $request;
    /**
     * RPCRequestBuilder constructor.
     *
     * @param String $protocolVersion - Version of json-rpc protocol
     */
    public function __construct(String $protocolVersion)
    {
        $this->protocolVersion = $protocolVersion;
        $this->request = new Request($protocolVersion);
    }

    public function withProtocol(String $protocol)
    {
        $this->request->setProtocolType($protocol);
        return $this;
    }

    public function withMethod(String $methodName)
    {
        $this->request->setMethod($methodName);
        return $this;
    }

    public function withArgs(array $args)
    {
        $this->request->setArgs($args);
        return $this;
    }

    public function withId(String $id)
    {
        $this->request->setId($id);
        return $this;
    }

    public function build()
    {
        $request = $this->request;
        $this->request = null;
        return $request;
    }

    public static function getBuilder(String $protocolVersion): self
    {
        return new RPCRequestBuilder($protocolVersion);
    }

    public function createFromString(String $requestBody) : self
    {
        Rpc::validateRequest($requestBody);
        $requestBody = json_decode($requestBody,true);
        $request = new Request($requestBody['jsonrpc']);
        $request->setArgs($requestBody['params']);
        $request->setMethod($requestBody['method']);
        if(isset($requestBody['id'])) {
            $request->setId($requestBody['id']);
        }
        $this->request = $request;
        return $this;
    }


    public function createFromPsrRequest(RequestInterface $request)
    {
        if($request->getMethod()!=='post') {
            throw new \InvalidArgumentException();
        }
        $rpcRequest = $request->getBody()->getContents();
        return $this->createFromString($rpcRequest);
    }

}
