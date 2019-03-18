<?php
namespace Saiks24\Rpc\Builders;

use Psr\Http\Message\RequestInterface;
use Saiks24\Rpc\Request\Request;
use Saiks24\Rpc\Request\RpcRequestInterface;

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
        return $this->request;
    }

    public static function getBuilder(String $protocolVersion): self
    {
        return new RPCRequestBuilder($protocolVersion);
    }

    public function createFromString(String $requestBody) : RpcRequestInterface
    {
        if(!$this->validateRequest($requestBody)) {
            throw new \Exception();
        }

        $requestBody = json_encode($requestBody,true);
        $request = new Request($this->protocolVersion);
        $request->withMethod($requestBody['method'])
            ->withArgs($requestBody['args']);

        if(isset($requestBody['id'])) {
            $request->withId($requestBody['id']);
        }
        return $request;
    }

    public function createFromPsrRequest(RequestInterface $request)
    {
        //TODO Realize
    }

    private function validateRequest(String $requestBody) : bool
    {
        return json_encode($requestBody) === null;
    }

}
