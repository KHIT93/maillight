<?php

namespace MailLight\Models;

use Illuminate\Database\Eloquent\Model;

class SARule extends Model
{
    protected $table = 'sa_rules';
    protected $primaryKey = 'rule';
    protected $guarded = [];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
