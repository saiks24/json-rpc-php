<?php
namespace Saiks24\Rpc\Request;

/**
 * Interface RpcRequestInterface
 *
 * @package Saiks24\Rpc\Request
 */
interface RpcRequestInterface
{

    /** Get version of JSON RPC Protocol (1.0 - 2.0)
     * @return string
     */
    public function getProtocolVersion() : string ;

    /** Get method name
     * @return string
     */
    public function getMethodName() : string ;

    /** Get params to method call
     * @return array
     */
    public function getArgs() : array ;

    /** Get identity for request
     * @return string
     */
    public function getId() : string ;
}