<?php

namespace MailLight\Models;

use Illuminate\Database\Eloquent\Model;
use MailLight\Models\Traits\UuidForKey;

class MTALogEntry extends Model
{
	use UuidForKey;
    protected $table = 'mtalog';
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
