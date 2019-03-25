<?php
namespace Senders;


use PHPUnit\Framework\TestCase;
use Saiks24\Rpc\Request\Request;
use Saiks24\Rpc\Senders\HttpSender;

class HttpSenderTest extends TestCase
{

    /**
     * @expectedException \Saiks24\Rpc\Exceptions\WrongJsonRpcResponseException
     */
    public function testThatSendMethodCorrectlyWorked()
    {
        $requestMock = self::getMockBuilder(Request::class)
          ->disableOriginalConstructor();
        $requestMock->method('serialize')->willReturn('{"test":"json"}');
        $requestMock->expects(self::once())->method('serialize');

        $sender = new HttpSender();
        $sender->send($requestMock,'0.0.0.0');
    }
}