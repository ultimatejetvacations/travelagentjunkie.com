<?php namespace App\Exceptions\CustomExceptions;

class InternalErrorException extends CustomException {

    /**
     * @param \Exception $e
     */
    public function __construct($e)
    {
        parent::__construct($e);
    }

    /**
     * @return string
     */
    public function getCustomMessage()
    {
        return $this->exception->getMessage();
    }

    /**
     * @return int|mixed
     */
    public function getCustomCode()
    {
        return $this->exception->getCode();
    }

    /**
     * @return array
     */
    public function getCustomTrace()
    {
        return $this->exception->getTrace();
    }

    /**
     * @return int
     */
    public function getHttpStatusCode()
    {
        return 505;
    }

    /**
     * @return mixed
     */
    public function handle()
    {
        return \Response::view( 'errors.'.$this->getHttpStatusCode(), ['message' => $this->getCustomMessage()] );
    }
}