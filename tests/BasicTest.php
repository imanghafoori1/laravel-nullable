<?php

namespace Imanghafoori\HelpersTests;

use InvalidArgumentException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BasicTest extends TestCase
{
    public function testSample()
    {
        $value = nullable(null)->getOr('hello');
        $this->assertEquals('hello', $value);

        $value = nullable(null, ['fgbfgb'], function ($v) {
            $this->assertNull(null);
            return is_null($v);
        })->getOr('hello');
        $this->assertEquals('hello', $value);

        $value = nullable(null)->getOr('hello');
        $this->assertEquals('hello', $value);

        $value = nullable([], ['sdf'], function ($v) {

            return empty($v);
        })->getOr('hello');
        $this->assertEquals('hello', $value);

        $value = nullable([], 'sdfv', function ($v) {
            return [] === $v;
        })->getOr('hello');
        $this->assertEquals('hello', $value);

        $value = nullable([], 'oh no','is_array')->getOr('hello');
        $this->assertEquals('hello', $value);

        $value = nullable('not null')->getOr('hello');
        $this->assertEquals('not null', $value);

        $value = nullable(false, [123])->getOrSend(function ($value) {
            $this->assertEquals(123, $value);
            return redirect()->to('/');
        });
        $this->assertEquals(false, $value);
    }

    public function testSendsResponse()
    {
        $this->expectException(HttpResponseException::class);

        nullable(null)->getOrSend(function () {
            return redirect()->to('/');
        });
    }

    public function testSendsResponseAsArray()
    {
        $this->expectException(HttpResponseException::class);

        nullable(null)->getOrSend([new Responses(), 'error']);
    }

    public function testSendsResponseAsArray23()
    {
        $this->expectException(HttpResponseException::class);

        nullable(null)->getOrSend(redirect()->to('/'));
    }

    public function testSendsResponseAsArray213()
    {
        $this->expectException(\InvalidArgumentException::class);

        nullable(null)->getOrSend('ada');
    }

    public function testSendsResponseAsArray2113()
    {
        $this->expectException(\InvalidArgumentException::class);

        nullable(null)->getOrSend(function () {
            return 'sdcsd';
        });
    }

    public function testSendsResponseAsArray2413()
    {
        $this->expectException(NotFoundHttpException::class);

        nullable(null)->getOrAbort(404);
    }

    public function testSendsResponseAsArray2416()
    {
        $val = nullable(false)->getOrAbort(404);

        $this->assertEquals(false, $val);
    }

    public function testThrowException()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('hi');
        $this->expectExceptionCode(11);

        nullable(null)->getOrThrow(InvalidArgumentException::class, 'hi', 11);
    }

    public function testThrowException2()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('hi');
        $this->expectExceptionCode(11);

        nullable(null)->getOrThrow(new InvalidArgumentException('hi', 11));
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
