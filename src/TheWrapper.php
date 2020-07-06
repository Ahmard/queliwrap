<?php
namespace Queliwrap;

use Guzwrap\Request;
use QL\QueryList;
use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Exception\TransferException;

class TheWrapper
{
    protected $queryList;
    
    public function __construct()
    {
        $this->queryList = QueryList::getInstance();
    }
    
    public function request(callable $closure): Promise
    {
        $request = Request::getInstance();
        $promise = new Promise();
        
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
            
            $promise->resolve($this->queryList);
        }catch(Throwable|TransferException $e){
            $promise->reject($e);
        }
        
        return $promise;
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