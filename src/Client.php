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
        try{
            $this->result = QueryList::get(...$args);
            return $this;
        }catch(TransferException $e){
            $this->error = $e;
            return $this;
        }
    }
    
    
    /**
     * Check wether previous request was success
     * @param void
     * @return bool
     */
    public function success()
    {
        return empty($this->error);
    }
    
    
    /**
     * Check wether previous request was error
     * @param void
     * @return bool
     */
    public function error()
    {
        return (! $this->success());
    }
    
    
    /**
     * Get QueryList instance
     * @param void
     * @return QL\QueryList
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