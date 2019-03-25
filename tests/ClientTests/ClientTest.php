<?php

namespace ClientTests;


use PHPUnit\Framework\TestCase;
use Saiks24\Rpc\Client\Client;
use Saiks24\Rpc\Request\Request;
use Saiks24\Rpc\Senders\HttpSender;

class ClientTest extends TestCase
{
    public function testCreateClient()
    {
        $senderStab = self::getMockBuilder(HttpSender::class)
          ->disableOriginalConstructor()
          ->getMock();
        $senderStab->method('send')->willReturn('true');
        $client = new Client('0.0.0.0',null,$senderStab);
        self::assertEquals(Client::class,get_class($client));
    }

    public function testThatMethodSendCalledInClientOnce()
    {
        $senderMock = self::getMockBuilder(HttpSender::class)
          ->disableOriginalConstructor()
          ->getMock();
        $senderMock->expects(self::once())->method('send');
        $requestMock = self::getMockBuilder(Request::class)
          ->disableOriginalConstructor()
          ->getMock();
        $requestMock->method('serialize')->willReturn('{"test"}');

        $client = new Client('0.0.0.0',$requestMock,$senderMock);
        $client->sendRequest();
    }
}