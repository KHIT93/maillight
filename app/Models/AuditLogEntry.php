<?php

namespace MailLight\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLogEntry extends Model
{
	use UuidForKey;
    protected $table = 'audit_log';
    protected $primaryKey = 'uuid';
    protected $fillable = ['user', 'ip_address', 'action'];
    public $incrementing = false;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

}
