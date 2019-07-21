<?php

namespace Imanghafoori\Helpers;

use App;
use function foo\func;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class Nullable
{
    private $result;

    private $predicate = null;

    /**
     * Nullable constructor.
     *
     * @param $value
     * @param $predicate
     */
    public function __construct($value, $predicate = null)
    {
        $this->result = $value;
        $this->predicate = $predicate;
    }

    /**
     * @param $default
     *
     * @return mixed
     */
    public function getOr($default)
    {
        if (is_callable($this->predicate)) {
            $p = $this->predicate;
        } else {
            $p = function ($r) {
                return is_null($r);
            };
        }

        if (! $p($this->result)) {
            return $this->result;
        }

        if (is_callable($default)) {
            return call_user_func($default);
        }

        return $default;
    }

    /**
     * @param       $callable
     * @param array $params
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