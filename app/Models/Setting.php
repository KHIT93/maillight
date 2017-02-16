<?php

namespace MailLight;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use UuidForKey;
    protected $primaryKey = 'uuid';
    protected $guarded = ['uuid'];
    public $incrementing = false;

    public static function get($key, $default = null)
    {
        $record = static::getFromDB($key);
    	return (is_null($record)) ? config($key, $default) : $record->value;
    }

    protected static function getFromDB($key)
    {
        $record = static::findByName($key);
    	return (is_object($record)) ? $record: null;
    }

    public static function set($key, $value)
    {
        //Check if we have a record with the given key
        $record = static::findByName($key);
        //If the key exists, update the value
        if(is_object($record))
        {
            $record->value = $value;
            $record->save();
        }
        //If the key does not exist, create a new instance
        //and save it to the database
        else
        {
            $record = static::create(['name' => $key, 'value' => $value]);
        }
        //Return the object
        return $record;
    }
}
