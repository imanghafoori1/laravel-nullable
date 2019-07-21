<?php

namespace Imanghafoori\Helpers;

use App;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class Nullable
{
    private $result;

    /**
     * Nullable constructor.
     *
     * @param $value
     */
    public function __construct($value)
    {
        $this->result = $value;
    }

    /**
     * @param $default
     *
     * @return mixed
     */
    public function getOr($default)
    {
        if (! is_null($this->result)) {
            return $this->result;
        }

        if (is_callable($default)) {
            return call_user_func($default);
        }

        return $default;
    }

    /**
     * @param  $callable
     *
     * @return mixed
     */
    public function getOrSend($callable, $params = [])
    {
        if (! is_null($this->result)) {
            return $this->result;
        }

        if (is_callable($callable)) {
            $response = call_user_func_array($callable, $params);
        }

        if (is_a($callable, Response::class)) {
            $response = $callable;
        }

        if(isset($response)) {
            throw new HttpResponseException($response);
        }

        throw new \InvalidArgumentException('You should provide a response.');
    }
}