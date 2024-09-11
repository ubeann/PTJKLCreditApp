<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Application extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'applications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'consumer_name',
        'nik',
        'birthdate',
        'marital_status',
        'spouse_data',
        'dealer',
        'vehicle_brand',
        'vehicle_model',
        'vehicle_type',
        'vehicle_color',
        'vehicle_price',
        'loan_insurance',
        'down_payment',
        'loan_term_months',
        'monthly_installment'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'birthdate' => 'date',
        'vehicle_price' => 'decimal:2',
        'down_payment' => 'decimal:2',
        'monthly_installment' => 'decimal:2'
    ];

    /**
     * Get the approval for the application.
     */
    public function approval(): HasOne
    {
        return $this->hasOne(Approval::class);
    }
}