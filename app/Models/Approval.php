<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Approval
 *
 * This model represents an approval in the system, typically associated with an application.
 * It tracks the status of the approval, who approved it, and any remarks.
 */
class Approval extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'approvals';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'application_id',  // The ID of the associated application
        'approver_id',     // The ID of the user who made the approval
        'status',          // The status of the approval (e.g., approved, rejected)
        'remarks'          // Any additional comments or notes about the approval
    ];

    /**
     * Get the application associated with this approval.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    /**
     * Get the user who made this approval.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }
}