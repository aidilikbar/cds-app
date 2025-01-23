<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DecisionSupport extends Model
{
    use HasFactory;

    protected $table = 'cds_decision_support';

    protected $fillable = [
        'patient_id',
        'analysis_data',
        'recommendation',
    ];

    protected $casts = [
        'analysis_data' => 'array', // Cast the JSON column to an array
    ];

    /**
     * Relationship: A decision support entry belongs to a patient.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
