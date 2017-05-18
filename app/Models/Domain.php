<?php

namespace MailLight\Models;

use Illuminate\Database\Eloquent\Model;
use MailLight\Models\Traits\UuidForKey;

class Domain extends Model
{
    use UuidForKey;
    protected $table = 'domaintable';
    protected $primaryKey = 'uuid';
    protected $guarded = [];
    public $incrementing = false;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
