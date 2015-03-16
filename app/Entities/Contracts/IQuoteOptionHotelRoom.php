<?php namespace App\Entities\Contracts;

interface IQuoteOptionHotelRoom extends IBaseEntity {

    function extraPersons();
    function photos();
    function promotion();
    function room();

}