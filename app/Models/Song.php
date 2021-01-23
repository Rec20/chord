<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    /**
     *  @var string table name
     */
    protected $table = 'song';

    /**
     *  @var string primary keys
     */
    protected $primaryKey = 'id';
}
