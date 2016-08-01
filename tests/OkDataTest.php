<?php

use Yadakhov\OkData;

class OkDataTest extends BootstrapTest
{
    public function testSimpleObject()
    {
        $json = new OkData();

        $this->assertTrue($json->isOk());
        $this->assertFalse($json->isError());
        $this->assertEquals(true, $json->getOk());
        $this->assertEquals('{"ok":true,"data":null}', $json->toString());
        $this->assertEquals(['ok' => true, 'data' => null], $json->toArray());
    }

    public function testGetInstance()
    {
        $json = OkData::getInstance();

        $this->assertTrue($json->isOk());
        $this->assertFalse($json->isError());
        $this->assertEquals(true, $json->getOk());
        $this->assertEquals('{"ok":true,"data":null}', $json->toString());
        $this->assertEquals(['ok' => true, 'data' => null], $json->toArray());
    }

    public function testGetErrorInstance()
    {
        $json = OkData::getErrorInstance()->setError('An error occurred');

        $this->assertFalse($json->isOk());
        $this->assertTrue($json->isError());
        $this->assertEquals(false, $json->getOk());
        $this->assertEquals('{"ok":false,"error":"An error occurred"}', $json->toString());
        $this->assertEquals(['ok' => false, 'error' => 'An error occurred'], $json->toArray());
    }

    public function testAutoToString()
    {
        $json = OkData::getInstance()->setData(['id' => 1]);

        // object gets __toString() called.
        $this->assertEquals('{"ok":true,"data":{"id":1}}', $json);
    }

    /**
     * {
     *   "ok" : true,
     *   "data" : {
     *     "post" : { "id" : 1, "title" : "A blog post", "body" : "Some useful content" }
     *   }
     */
    public function testBasicJsendCompliantResponse()
    {
        $data = [
            'post' => [
                'id' => 1,
                'title' => 'A blog post',
                'body' => 'Some useful content',
            ]
        ];

        $json = OkData::getInstance()->setData($data);

        $this->assertEquals(true, $json->getOk());
        $this->assertEquals('{"ok":true,"data":{"post":{"id":1,"title":"A blog post","body":"Some useful content"}}}', $json->toJson());
    }

    public function testErrorWithMessageAndData()
    {
        $data = [
            'id' => 100,
            'message' => 'Message',
        ];

        $json = (new OkData(false, $data, 'Unable to communicate with database.'));

        $this->assertEquals('{"ok":false,"error":"Unable to communicate with database.","data":{"id":100,"message":"Message"}}', $json->toString());
    }

    public function testSetOkNotUsingBoolean()
    {
        $this->expectException('InvalidArgumentException');

        // should throw an exception
        OkData::getInstance()->setOk('success');
    }
}
