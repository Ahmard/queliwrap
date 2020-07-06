<?php
namespace Queliwrap;

use Queliwrap\TheWrapper;

class Client
{
    public static function __callStatic($method, $args)
    {
        if(method_exists(TheWrapper::class, $method)){
            return (new TheWrapper())->$method(...$args);
        }
        
        throw new Exception("Method TheWrapper::{$method} not found.");
    }
}