<?php


namespace Queliwrap\Wrapper;


use Exception;
use Guzwrap\Wrapper\Guzzle;
use Psr\Http\Message\ResponseInterface;
use QL\QueryList;
use Throwable;

class Queliwrap extends Guzzle
{
    protected QueryList $queryList;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $queryList = QueryList::getInstance();

        if (null == $queryList) {
            throw new Exception('Failed to create QueryList instance');
        }

        $this->queryList = $queryList;
    }

    /**
     * Execute http request and returns psr-7 compliant object
     * @return ResponseInterface
     * @throws Throwable
     */
    public function exec(): ResponseInterface
    {
        return parent::exec();
    }

    /**
     * Execute http request and returns QueryList object or null
     * @return QueryList
     * @throws Throwable
     */
    public function execute(): QueryList
    {
        $response = parent::exec();

        //Register extension
        $this->queryList->bind('qwHandler', function () use ($response) {
            /**
             * $this - refers to current QueryList object
             * @link https://github.com/jae-jae/QueryList#bind-function-extension
             * @var QueryList $this
             */
            return $this->setHtml($response->getBody()->getContents());
        });

        //Call our extension
        call_user_func([$this->queryList, 'qwHandler']);

        return $this->queryList;
    }
}