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

    public function withStatus(String $status)
    {
        $this->status = $status;
        return $this;
    }

    public function withId(String $id)
    {
        $this->id = $id;
        return $this;
    }

    public function withErrorCode(String $errorCode)
    {
        $this->errorCode = $errorCode;
        return $this;
    }

    public function withErrorMessage(String $errorMessage)
    {
        $this->errorMessage = $errorMessage;
        return $this;
    }

    public function withResult(String $result)
    {
        $this->result = $result;
        return $this;
    }

    public function withProtocol(String $protocol)
    {
        $this->protocol = $protocol;
        return $this;
    }

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


}