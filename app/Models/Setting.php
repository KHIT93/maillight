<?php

namespace MailLight;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use UuidForKey;
    protected $primaryKey = 'uuid';
    protected $guarded = ['uuid'];
    public $incrementing = false;

    public static function get($key)
    {
    	return static::findByName($key);
    }
}
