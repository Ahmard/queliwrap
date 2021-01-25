<?php


namespace Queliwrap;


use Guzwrap\RequestInterface;
use Guzwrap\Wrapper\Form;
use Queliwrap\Wrapper\Queliwrap;

/**
 * Client - Bridge between Guzwrap(GuzzleHttp) and QueryList
 * @package Queliwrap
 */
class Client
{
    /**
     * Create an instance of Queliwrap\Wrapper\Queliwrap
     * @return Queliwrap
     */
    public static function create(): Queliwrap
    {
        return new Queliwrap();
    }

    /**
     * Send GET request
     * @param string $url
     * @return Queliwrap
     */
    public static function get(string $url): Queliwrap
    {
        return static::request('GET', $url);
    }

    /**
     * Send HEAD request
     * @param string $url
     * @return Queliwrap
     */
    public static function head(string $url): Queliwrap
    {
        return static::request('HEAD', $url);
    }

    /**
     * Send POST request
     * @param callable|Form $callableOrForm
     * @return Queliwrap|RequestInterface
     */
    public static function form($callableOrForm)
    {
        return static::create()->form($callableOrForm);
    }

    /**
     * Send POST request
     * @param string|callable $urlOrClosure
     * @return Queliwrap
     */
    public static function post($urlOrClosure): Queliwrap
    {
        return static::request('POST', $urlOrClosure);
    }

    /**
     * Send http put request
     * @param string $url
     * @return Queliwrap
     */
    public static function put(string $url): Queliwrap
    {
        return static::request('PUT', $url);
    }

    /**
     * Send http delete request
     * @param string $url
     * @return Queliwrap
     */
    public static function delete(string $url): Queliwrap
    {
        return static::request('DELETE', $url);
    }

    /**
     * Send http connect request
     * @param string $url
     * @return Queliwrap
     */
    public static function connect(string $url): Queliwrap
    {
        return static::request('CONNECT', $url);
    }

    /**
     * Send http options request
     * @param string $url
     * @return Queliwrap
     */
    public static function options(string $url): Queliwrap
    {
        return static::request('OPTIONS', $url);
    }

    /**
     * Send http trace request
     * @param string $url
     * @return Queliwrap
     */
    public static function trace(string $url): Queliwrap
    {
        return static::request('TRACE', $url);
    }

    /**
     * Send http patch request
     * @param string $url
     * @return Queliwrap
     */
    public static function patch(string $url): Queliwrap
    {
        return static::request('PATCH', $url);
    }

    /**
     * @param string $type
     * @param mixed ...$arguments
     * @return Queliwrap
     */
    protected static function request(string $type, ...$arguments): Queliwrap
    {
        $parameters = [$type, ...$arguments];
        return (new Queliwrap())->request(...$parameters);
    }
}