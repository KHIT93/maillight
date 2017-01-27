<?php

namespace MailLight\Models;

use Illuminate\Database\Eloquent\Model;

class BlacklistEntry extends Model
{
	use UuidForKey;
    protected $table = 'blacklist';
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
