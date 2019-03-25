<?php

namespace BuildersTests;

use PHPUnit\Framework\TestCase;
use Saiks24\Rpc\Builders\RPCRequestBuilder;
use Saiks24\Rpc\Request\Request;
use Saiks24\Rpc\Rpc;

require_once __DIR__.'/../../vendor/autoload.php';

class RequestBuilderTest extends TestCase
{
    public function testSuccessfulCreateInstanceOfBuilder()
    {
        $builder = RPCRequestBuilder::getBuilder(
          Rpc::RPC_PROTOCOL_VERSION_2_0
        );
        self::assertEquals(RPCRequestBuilder::class,get_class($builder));
    }

    /**
     * @depends testSuccessfulCreateInstanceOfBuilder
     */
    public function testThatRequestCreated()
    {
        $request = RPCRequestBuilder::getBuilder(
          Rpc::RPC_PROTOCOL_VERSION_2_0
        )->withMethod('task.create')
          ->withArgs(['arg1'=>'val1'])
          ->build();

        self::assertEquals(Request::class,get_class($request));
    }

    /**
     * @depends testThatRequestCreated
     * @expectedException  \Saiks24\Rpc\Exceptions\WrongJsonRpcRequestException
     */
    public function testThatRequestBuilderThrowExceptionWereRequestBodyIsInvalid()
    {
        RPCRequestBuilder::getBuilder(Rpc::RPC_PROTOCOL_VERSION_2_0)
            ->createFromString('wrong json')
            ->build();
    }

    /**
     * @depends testThatRequestBuilderThrowExceptionWereRequestBodyIsInvalid
     */
    public function testThatRequestBuilderSuccessfulCreateRequestFromString()
    {
        $request = RPCRequestBuilder::getBuilder(Rpc::RPC_PROTOCOL_VERSION_2_0)
          ->createFromString('{"jsonrpc":"2.0","method":"task.create","params":{"arg1":"val1"}}')
          ->build();
        self::assertEquals('2.0',$request->getProtocolVersion());
        self::assertEquals('task.create',$request->getMethodName());
        self::assertEquals(['arg1'=>'val1'],$request->getArgs());
    }
}