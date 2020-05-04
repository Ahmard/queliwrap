<?php
namespace Queliwrap;

use QL\QueryList;
use GuzzleHttp\Exception\TransferException;

class Client
{
   
    protected $result = null;
    
    protected $error = null;
    
    
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
    
    
    public function success()
    {
        return empty($this->error);
    }
    
    
    public function error()
    {
        return (! $this->success());
    }
    
    
    public function getQL()
    {
        $this->result;
    }
    
    
    public function getError()
    {
        return $this->error;
    }
}