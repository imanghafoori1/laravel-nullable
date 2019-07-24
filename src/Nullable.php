<?php

namespace Imanghafoori\Helpers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

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
        $p = $this->getPredicate();

        if (!$p($this->result)) {
            return $this->result;
        }

        if (is_callable($default)) {
            return call_user_func($default);
        }

        return $default;
    }

    public function getOrAbort($code, $message = '', array $headers = [])
    {
        if (!is_null($this->result)) {
            return $this->result;
        }

        abort($code, $message, $headers);
    }

    /**
     * @param       $callable
     * @param array $params
     *
     * @return mixed
     */
    public function getOrSend($callable, $params = [])
    {
        if (!is_null($this->result)) {
            return $this->result;
        }

        if (is_callable($callable)) {
            $callable = call_user_func_array($callable, $params);
        }

        if (is_a($callable, Response::class)) {
            $response = $callable;
        }

        if (isset($response)) {
            throw new HttpResponseException($response);
        }

        throw new \InvalidArgumentException('You should provide a valid http response.');
    }

    /**
     * @return callable|\Closure|null
     */
    private function getPredicate()
    {
        if (is_callable($this->predicate)) {
            $p = $this->predicate;
        } else {
            $p = function ($r) {
                return is_null($r);
            };
        }

        return $p;
    }
}
