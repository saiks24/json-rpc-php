<?php

namespace Saiks24\Rpc\Exceptions;

class WrongJsonRpcRequestException extends RequestException
{

    public function __construct(
      string $message = "",
      int $code = 0,
      \Throwable $previous = null
    ) {
        $message = '{"jsonrpc": "2.0", "error": {"code": -32600, "message": "Invalid JSON-RPC."}, "id": null}';
        parent::__construct($message, $code, $previous);
    }

}