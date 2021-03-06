<?php

namespace MailLight\Models;

use Illuminate\Database\Eloquent\Model;
use MailLight\Models\Traits\UuidForKey;

class DomainSetting extends Model
{
    use UuidForKey;
    protected $table = 'domainsettings';
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
