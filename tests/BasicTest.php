<?php

namespace Imanghafoori\HelpersTests;

use Illuminate\Http\Exceptions\HttpResponseException;

class BasicTest extends TestCase
{
    public function testSample()
    {
        $value = nullable(null)->getOr('hello');
        $this->assertEquals('hello', $value);

        $value = nullable('not null')->getOr('hello');
        $this->assertEquals('not null', $value);

        $value = nullable(false)->getOrSend(function(){
            return redirect()->to('/');
        });
        $this->assertEquals(false, $value);
    }

    public function testSendsResponse()
    {
        $this->expectException(HttpResponseException::class);
        $value = nullable(null)->getOrSend(function(){
            return redirect()->to('/');
        });
    }

    public function testSendsResponseAsArray()
    {
        $this->expectException(HttpResponseException::class);
        $value = nullable(null)->getOrSend([new Responses, 'error']);
    }

    public function testSendsResponseAsArray23()
    {
        $this->expectException(HttpResponseException::class);
        $value = nullable(null)->getOrSend(redirect()->to('/'));
    }

    public function testSendsResponseAsArray213()
    {
        $this->expectException(\InvalidArgumentException::class);
        $value = nullable(null)->getOrSend('ada');
    }
}

class Responses
{
    public function error()
    {
        return redirect()->to('/');
    }

    public function error2()
    {
        return 'ascasc';
    }
}