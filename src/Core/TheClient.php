<?php


namespace Queliwrap\Core;


use Guzwrap\Core\GuzzleWrapper;
use QL\QueryList;
use Throwable;

class TheClient extends GuzzleWrapper
{
    protected ?QueryList $queryList;

    public function __construct()
    {
        $this->queryList = QueryList::getInstance();
    }

    /**
     * Execute request
     * @return QueryList|null
     * @throws Throwable
     */
    public function exec(): ?QueryList
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
        $this->queryList->qwHandler();

        return $this->queryList;
    }
}