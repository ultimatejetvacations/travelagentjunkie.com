<?php namespace App\Entities\Contracts;

interface IQuoteOption extends IBaseEntity {

    function airlines();
    function rooms();
    function photos();
    function quote();

}