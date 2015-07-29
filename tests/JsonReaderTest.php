<?php
namespace Test;

use TestApp\Components\JsonReader;

class JsonReaderTest extends \UnitTestCase
{
    public function testFetchData()
    {
        $json = new JsonReader('http://rexxars.com/playground/testfeed/');
        $json->fetchData();

        $data = $json->getData();

        $this->assertInternalType('array', $data);
        $this->assertNotEmpty($data);
    }

    public function testGetData()
    {
        $json = new JsonReader('http://rexxars.com/playground/testfeed/');
        $json->fetchData();

        $data = $json->getData();

        $this->assertArrayHasKey('title', $data[0]);
    }

    public function testSortDataByDate()
    {
        $json = new JsonReader('http://rexxars.com/playground/testfeed/');
        $json->fetchData();
        $json->sortDataByDate();
        $data = $json->getData();

        $this->assertEquals('Rune Øygard er tiltalt', $data[0]['title']);
    }
}
