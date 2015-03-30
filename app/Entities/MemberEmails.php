<?php namespace App\Entities;

class MemberEmails extends BaseEntity {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'member_emails';

    /**
     * The table's primary key
     *
     * @var string
     */
    protected $primaryKey = 'email_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

}
