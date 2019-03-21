<?php

namespace Saiks24\Rpc\Senders;


use GuzzleHttp\Client;
use Saiks24\Rpc\Builders\RPCResponseBuilder;
use Saiks24\Rpc\Request\Request;
use Saiks24\Rpc\Response\RpcResponse;
use Saiks24\Rpc\Rpc;

class HttpSender implements SenderInterface
{

    public function send(Request $request, String $requestAddress): RpcResponse
    {
        $headers  = ['Content-Type' => 'application/json'];
        $client = new Client(['base_uri' => $requestAddress]);

        $httpRequest = new \GuzzleHttp\Psr7\Request(
          'POST',$requestAddress,$headers,$request->serialize()
        );

        $response = $client->send($httpRequest);

        $rpcResponse = RPCResponseBuilder::getBuilder(
          Rpc::RPC_PROTOCOL_VERSION_2_0
        )->createFromPsrResponse($response);

        return $rpcResponse;
    }

}