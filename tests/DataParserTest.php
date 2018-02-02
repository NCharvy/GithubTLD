<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Service\DataParser;

class DataParserTest extends TestCase
{
    public function testParsing()
    {
        $parser = new DataParser();
        $body = array(
            "firstCommit",
            "secondCommit",
            "thirdCommit"
        );
        $result = $parser->formatBody($body, time());
        $this->assertEquals($body, $result["commits"]);
    }
}
