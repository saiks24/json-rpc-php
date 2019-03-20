<?php
namespace Saiks24\Rpc\Request;


class Request implements RpcRequestInterface
{
    private $protocolType;
    private $method;
    private $args;
    private $id;

    /**
     * Request constructor.
     *
     * @param $protocolType
     */
    public function __construct($protocolType)
    {
        $this->protocolType = $protocolType;
    }

    /**
     * @param mixed $protocolType
     */
    public function setProtocolType($protocolType)
    {
        $this->protocolType = $protocolType;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param mixed $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    public function getProtocolVersion(): string
    {
        return $this->protocolType;
    }

    public function getMethodName(): string
    {
        return $this->method;
    }

    /**
     * @return array
     */
    public function getArgs() : array
    {
        return $this->args;
    }

    /**
     * @param mixed $args
     */
    public function setArgs($args)
    {
        $this->args = $args;
    }

    /**
     * @return string
     */
    public function getId() : string
    {
        return $this->id??'';
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    public function serialize()
    {
        return $this->__toString();
    }

    public function __toString()
    {
        $request = [
          'jsonrpc' => $this->protocolType,
          'method' => $this->method,
          'params' => $this->args
        ];
        return json_encode($request);
    }
}