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
     * @return mixed
     */
    public function getProtocolType()
    {
        return $this->protocolType;
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
    public function withMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getArgs()
    {
        return $this->args;
    }

    /**
     * @param mixed $args
     */
    public function withArgs($args)
    {
        $this->args = $args;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function withId($id)
    {
        $this->id = $id;
        return $this;
    }

}