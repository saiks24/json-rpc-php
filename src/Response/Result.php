<?php
namespace Saiks24\Rpc\Response;


class Result
{
    private $result;

    /**
     * Result constructor.
     *
     * @param array $result
     */
    public function __construct(array $result)
    {
        $this->result = json_encode($result);
    }

    /**
     * @return string
     */
    public function getResult()
    {
        return $this->result;
    }

}