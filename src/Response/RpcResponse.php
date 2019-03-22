<?php
namespace Saiks24\Rpc\Response;



class RpcResponse implements RpcResponseInterface
{
    private $protocol;
    /** @var bool */
    private $isError = false;
    private $id;
    /** @var string */
    private $result;

    /** @var \Saiks24\Rpc\Response\Error  */
    private $error;

    public function serialize()
    {
        return $this->__toString();
    }

    public function __toString()
    {
        $response = [
          'jsonrpc'=>$this->protocol,
        ];
        if($this->isError) {
            $response['error'] = [
              'code'=>$this->error->getCode(),
              'message'=>$this->error->getMessage()
            ];
        } else {
            $response['result'] = $this->result;
        }
        if(!empty($this->id)) {
            $response['id'] = $this->id;
        }
        return json_encode($response);
    }

    public function getProtocolVersion(): string
    {
        return $this->protocol;
    }

    public function getError(): Error
    {
        // TODO: Implement getError() method.
    }

    public function setError(Error $error)
    {
        $this->isError = true;
        $this->error = $error;
    }

    /**
     * @param mixed $protocol
     */
    public function setProtocol($protocol)
    {
        $this->protocol = $protocol;
    }

    /**
     * @return mixed
     */
    public function getStatus() : string
    {
        return $this->status;
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
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return \Saiks24\Rpc\Response\Result
     */
    public function getResult() : string
    {
        return $this->result;
    }

    /**
     * @param string $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }

}