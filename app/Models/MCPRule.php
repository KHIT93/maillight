<?php

namespace MailLight\Models;

use Illuminate\Database\Eloquent\Model;

class MCPRule extends Model
{
    protected $table = 'mcp_rules';
    protected $primaryKey = 'rule';
    protected $guarded = [];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
