<?php

namespace MailLight\Models;

use Illuminate\Database\Eloquent\Model;
use MailLight\Models\Traits\UuidForKey;

class Permission extends Model
{
    use UuidForKey;
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $fillable = [
        'name',
        'label',
        'description'
    ];
    public function roles()
    {
        return $this->belongsToMany(\MailLight\Models\Role::class, 'permission_role');
    }
}
