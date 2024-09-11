<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    protected $table = 'approvals';

    protected $fillable = [
        'application_id',
        'approver_id',
        'status',
        'remarks'
    ];

    // Relationships
    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }
}
