<?php

namespace Queliwrap\Tests;

use PHPUnit\Framework\TestCase;
use QL\QueryList;
use Queliwrap\Client;

class ClientTest extends TestCase
{
    public function testClient()
    {
        $queryList = Client::get('http://localhost:24623')->execute();
        //throw new Exception("Please execute \"php -S localhost:24623 -t tests\" before running tests.");

        self::assertInstanceOf(QueryList::class, $queryList);
    }
}