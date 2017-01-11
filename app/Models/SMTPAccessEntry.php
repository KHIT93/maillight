<?php

namespace MailLight\Models;

use Illuminate\Database\Eloquent\Model;

class SMTPAccessEntry extends Model
{
	use UuidForKey;
    protected $table = 'smtpaccess';
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
