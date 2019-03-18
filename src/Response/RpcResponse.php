<?php
namespace Saiks24\Rpc\Response;



class RpcResponse implements RpcResponseInterface
{
    private $protocol;
    private $status;
    private $id;
    private $errorCode;
    private $errorMessage;
    private $result;

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
                $response['result'] = $this->result;
                break;
            case 'error':
                $response['error'] = ['code'=>$this->errorCode,'message'=>$this->errorMessage];
                break;
        }
        if(!empty($this->id)) {
            $response['id'] = $this->id;
        }
        return json_encode($response);
    }

    /**
     * @return mixed
     */
    public function getProtocol()
    {
        return $this->protocol;
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
    public function getStatus()
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
     * @return mixed
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @param mixed $errorCode
     */
    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;
    }

    /**
     * @return mixed
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @param mixed $errorMessage
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

    /**
     * @return mixed
     */
    public function getResult()
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