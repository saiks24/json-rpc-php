<?php
namespace Saiks24\Rpc\Response;


class Result
{
    private $result;

    /**
     * Result constructor.
     *
     * @param String $result
     */
    public function __construct(String $result)
    {
        $this->result = $result;
    }

    /**
     * @return string
     */
    public function getResult()
    {
        return $this->result;
    }

}