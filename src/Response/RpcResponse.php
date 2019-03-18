<?php
namespace Saiks24\Rpc\Response;



class RpcResponse implements RpcResponseInterface
{
    private $protocol;
    private $status;
    private $id;
    /** @var \Saiks24\Rpc\Response\Result */
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
        switch ($this->status) {
            case 'success':
                $response['result'] = $this->result->getResult();
                break;
            case 'error':
                $response['error'] = [
                  'code'=>$this->error->getCode(),
                  'message'=>$this->error->getMessage()
                ];
                break;
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
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
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
    public function getResult() : Result
    {
        return $this->result;
    }

    /**
     * @param mixed $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }

}