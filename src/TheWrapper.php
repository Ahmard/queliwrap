<?php
namespace Queliwrap;

use Guzwrap\Request;
use QL\QueryList;
use SimplePromise\Deferred;
use SimplePromise\Promise;
use GuzzleHttp\Exception\TransferException;

class TheWrapper
{
    protected $queryList;

    public function __construct()
    {
        $this->queryList = QueryList::getInstance();
    }

    /**
     * Define your request logic here
     * @param callable $closure
     * @return Promise
     */
    public function request(callable $closure): Promise
    {
        $request = Request::getInstance();
        $deferred = new Deferred();

        try{
            $closure($request);
            $response = $request->exec();


            $this->queryList->bind('qwHandler', function () use($response){
                // $this is the current QueryList object
                $html = $response->getBody()->getContents();
                $this->setHtml($html);
                return $this;
            });

            $this->queryList->qwHandler();

            $deferred->resolve($this->queryList);
        }catch(Throwable|TransferException $e){
            $deferred->reject($e);
        }

        //return $this;
        return $deferred->promise();
    }

    /**
     * Get the instance of querylist
     * @param void
     * @return QueryList
     */
    public function getQueryList(): QueryList
    {
        return $this->queryList;
    }
}
