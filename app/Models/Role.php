<?php

namespace MailLight\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use UuidForKey;
    protected $fillable = ['name', 'label'];
    protected $primaryKey = 'uuid';
    public $incrementing = false;

    public function permissions()
    {
        return $this->belongsToMany(\MailLight\Models\Permission::class, 'permission_role');
    }

    public function hasPermission($permission)
    {
        return $this->permissions->contains($permission);
    }
}