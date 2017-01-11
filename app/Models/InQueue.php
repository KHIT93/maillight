<?php

namespace MailLight\Models;

use Illuminate\Database\Eloquent\Model;

class InQueue extends Model
{
	use UuidForKey;
    protected $table = 'inq';
    protected $primaryKey = 'uuid';
    protected $guarded = ['uuid'];
    public $incrementing = false;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
