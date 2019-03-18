<?php
namespace Saiks24\Rpc\Builders;

use Psr\Http\Message\RequestInterface;
use Saiks24\Rpc\Request\Request;
use Saiks24\Rpc\Request\RpcRequestInterface;

class RPCRequestBuilder
{
    public const RPC_PROTOCOL_VERSION_2_0 = 'rpc2.0';
    public const RPC_PROTOCOL_VERSION_1_0 = 'rpc1.0';

    private $protocolVersion;

    /**
     * RPCRequestBuilder constructor.
     *
     * @param String $protocolVersion - Version of json-rpc protocol
     */
    public function __construct(String $protocolVersion)
    {
        $this->protocolVersion = $protocolVersion;
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
