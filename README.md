# JSON-RPC php
JSON-RPC protocol implementation in PHP. 

Ability to create requests and responses, regardless of the protocol of the data transfer level (currently implemented only for HTTP).
 
 Implemented classes for server and client.
 
 ## Install
 
 ```composer require Saiks24/json-rpc-php```
 
 ## Examples
 
 ### Build Request
 
  #### From string
  ```
  $rpcRequest = '{"jsonrpc":"2.0","method":"task.create","params":{"arg1":"val1"}}';
  
  $request = RPCRequestBuilder::getBuilder(
    Rpc::RPC_PROTOCOL_VERSION_2_0
  )->createFromString($rpcRequest)
    ->build();
  ```
  #### From PSR-7 Request  
  ```
  $psrRequest = new \GuzzleHttp\Psr7\ServerRequest('POST','0.0.0.0');
  
  
  $request = RPCRequestBuilder::getBuilder(
    Rpc::RPC_PROTOCOL_VERSION_2_0
  )->createFromPsrRequest($psrRequest);
  ```
 #### Build custom
 ```
 $request = RPCRequestBuilder::getBuilder(Rpc::RPC_PROTOCOL_VERSION_2_0)
   ->withMethod('task.create')
   ->withArgs(['arg1'=>'val1'])
   ->build();
 ```
 
 ### Build Response
 
 #### From PSR-7 Response
 
 ```
 $psrResponse = new \GuzzleHttp\Psr7\Response();
 
 $response = RPCResponseBuilder::getBuilder(
   Rpc::RPC_PROTOCOL_VERSION_2_0
 )->createFromPsrResponse($psrResponse);
 ```
 
 #### Build custom success
 ```
 $response = RPCResponseBuilder::getBuilder(Rpc::RPC_PROTOCOL_VERSION_2_0)
   ->withResult('task created')->build();
 ```
 
 #### Build custom error
 
 ```
 $errorResponse = RPCResponseBuilder::getBuilder(
   Rpc::RPC_PROTOCOL_VERSION_2_0
 )->withError(
   new \Saiks24\Rpc\Response\Error(-32600,'Invalid JSON-RPC')
 )->build();
 ```
 
 ### Client
 
 ```
 $client = new \Saiks24\Rpc\Client\Client('0.0.0.0',null,new HttpSender());
 $client->setRequestBody($request);
 $client->sendRequest();
 ```
 
 ### Server
 
 ```
 $server = new \Saiks24\Rpc\Server\Server();
 $server->setResponse($response);
 $server->sendResponse(new \GuzzleHttp\Psr7\BufferStream());
 ```
 
 
 
  