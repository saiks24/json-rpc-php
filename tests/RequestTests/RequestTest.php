<?php

namespace RequestTests;


use PHPUnit\Framework\TestCase;
use Saiks24\Rpc\Request\Request;
use Saiks24\Rpc\Rpc;

class RequestTest extends TestCase
{
    public function testThatInstanceCreated()
    {
        $request = new Request(Rpc::RPC_PROTOCOL_VERSION_2_0);
        self::assertEquals(Request::class,get_class($request));
    }

    public function testThatProtocolVersionAddedInConstrucor()
    {
        $request = new Request(Rpc::RPC_PROTOCOL_VERSION_2_0);
        self::assertEquals(
          Rpc::RPC_PROTOCOL_VERSION_2_0,
          $request->getProtocolVersion()
        );
    }

    public function testThatIdSetterWorked()
    {
        $request = new Request(Rpc::RPC_PROTOCOL_VERSION_2_0);
        $request->setId('1');
        self::assertEquals('1',$request->getId());
    }

    public function testThatMethodSetterWorked()
    {
        $request = new Request(Rpc::RPC_PROTOCOL_VERSION_2_0);
        $request->setMethod('task.create');
        self::assertEquals('task.create',$request->getMethod());
    }

    public function testThatArgsSetterWorked()
    {
        $request = new Request(Rpc::RPC_PROTOCOL_VERSION_2_0);
        $request->setArgs(['arg1'=>'val1']);
        self::assertEquals(['arg1'=>'val1'],$request->getArgs());
    }

    public function testThatProtocolTypeSetterWorked()
    {
        $request = new Request(Rpc::RPC_PROTOCOL_VERSION_2_0);
        $request->setProtocolType(Rpc::RPC_PROTOCOL_VERSION_2_0);
        self::assertEquals(Rpc::RPC_PROTOCOL_VERSION_2_0,$request->getProtocolVersion());
    }

    public function testThatSerializeMethodReturnValidJsonString()
    {
        $request = new Request(Rpc::RPC_PROTOCOL_VERSION_2_0);
        $request->setMethod('task.create');
        $request->setArgs(['arg1'=>'val1']);
        $request->setId('1');
        $requestString = json_encode($request->serialize(),true);
        self::assertNotEquals(null,$requestString);
    }

    public function testThatSerializeMethodWorked()
    {
        $request = new Request(Rpc::RPC_PROTOCOL_VERSION_2_0);
        $request->setMethod('task.create');
        $request->setArgs(['arg1'=>'val1']);
        $request->setId('1');
        $expected = '{"jsonrpc":"2.0","method":"task.create","params":{"arg1":"val1"},"id":"1"}';
        self::assertEquals($expected,$request->serialize());
    }
}