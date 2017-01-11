<?php

namespace MailLight\Models;

use Illuminate\Database\Eloquent\Model;

class ReleaseLogEntry extends Model
{
	use UuidForKey;
    protected $table = 'releaselog';
    protected $primaryKey = 'uuid';
    protected $guarded ['uuid'];
    public $incrementing = false;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
