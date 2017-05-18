<?php

namespace MailLight\Models;

use Illuminate\Database\Eloquent\Model;
use MailLight\Models\Traits\UuidForKey;

class WhitelistEntry extends Model
{
	use UuidForKey;
    protected $table = 'whitelist';
    protected $primaryKey = 'uuid';
    protected $fillable= ['to_address', 'to_domain', 'from_address'];
    public $incrementing = false;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
