<?php
namespace Queliwrap;

use QL\QueryList;
use GuzzleHttp\Exception\TransferException;

class Client
{
   /**
    * store request response
    * @var QL\QueryList
    */
    protected $result = null;
    
    /**
     * store request error
     * @var GuzzleHttp\Exception\TransferException
     */
    protected $error = null;
    
    
    /**
     * if an Exception can be thrown
     * @var bool
     */
    protected $willThrowException = false;
    
    
    /**
     * handle first static call
     * @return Queliwrap\Client
     */
    public static function __callStatic($method, $args)
    {
        return (new self())->$method(...$args);
    }
    
    
    /**
     * This will handle all calls to this object
     * get(), post(), postJson()
     */
    public function __call($method, $args)
    {
        return $this->request(...$args);
    }
    
    
    /**
     * Send request using GuzzleHttp
     * @param $args
     * @return Queliwrap\Client
     */
    public function request(...$args)
    {
        //if user wants throw an Exception
        if($this->willThrowException){
            $this->result = QueryList::get(...$args);
            return $this;
        }
        
        //if user don't want Exception to be thrown
        try{
            $this->result = QueryList::get(...$args);
            return $this;
        }catch(TransferException $e){
            $this->error = $e;
            return $this;
        }
    }
    
    
    /**
     * If you want to throw an Exception
     * @param void
     * @return Queliwrap\Client
     */
    public function canThrowException()
    {
        $this->willThrowException = true;
    }
    
    
    /**
     * Check wether previous request was success
     * @param void
     * @return bool
     */
    public function success($callback=null)
    {
        if($callback && !$this->error()){
            return $callback($this->getQL());
        }
        return empty($this->error);
    }
    
    
    /**
     * Check wether previous request was error
     * @param void
     * @return bool
     */
    public function error($callback=null)
    {
        if($callback && !$this->success()){
            return $callback($this->getError());
        }
        return (! $this->success());
    }
    
    
    /**
     * Get QueryList instance
     * @param void
     * @return QL\QueryListHome
     */
    public function getQL()
    {
        return $this->result;
    }
    
    
    /**
     * Get thrown error
     * @param void
     * @return GuzzleHttp\Exception\TransferException
     */
    public function getError()
    {
        return $this->error;
    }
}