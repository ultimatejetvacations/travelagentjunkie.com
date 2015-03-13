<?php namespace App\Exceptions\CustomExceptions;

abstract class CustomException extends \Exception {

    /**
     * @var \Exception
     */
    protected $exception;

    /**
     * @param \Exception $e
     */
    public function __construct($e)
    {
        $this->exception = $e;
    }

    abstract function getCustomMessage();
    abstract function getCustomCode();
    abstract function getCustomTrace();
    abstract function getHttpStatusCode();
    abstract function handle();
}