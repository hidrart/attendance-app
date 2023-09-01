<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class Work extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'pic',
        'plant',
        'registration',
        'classification',
        'parameter',
        'wo',
        'jpp',
        'notification',
        'equipment',
        'frequency',
        'value',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Override the default date accessor.
     *
     * @return string
     */
    // public function getDateAttribute($value): string
    // {
    //     return Carbon::parse($value)->timezone('Asia/Jakarta')->isoFormat('dddd, D MMMM Y');
    // }

    /**
     * Get all of the actionPlans for the Work
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function actions(): HasMany
    {
        return $this->hasMany(ActionPlan::class);
    }
}
