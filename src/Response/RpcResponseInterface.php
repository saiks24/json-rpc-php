<?php
namespace Saiks24\Rpc\Response;


interface RpcResponseInterface
{
    public function getProtocolVersion() : string ;

    public function getError() : Error ;

    public function getStatus() : string ;

    public function getResult() : Result ;
}