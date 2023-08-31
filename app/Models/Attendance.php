<?php

namespace App\Models;

use App\Http\Traits\ReadableCreateUpdateDate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

class Attendance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = [
        'user_id',
        'checkin_id',
        'checkout_id',
    ];

    /**
     * Override the default created_at accessor.
     */
    public function getCreatedAtAttribute($value): string
    {
        return Carbon::parse($value)
            ->timezone('Asia/Jakarta')
            ->isoFormat('dddd, DD MMMM YYYY', 'id');
    }

    /**
     * Override the default updated_at accessor.
     */
    public function getUpdatedAtAttribute($value): string
    {
        return Carbon::parse($value)
            ->timezone('Asia/Jakarta')
            ->isoFormat('dddd, DD MMMM YYYY', 'id');
    }

    /**
     * Get the user that owns the attendance.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the checkin record associated with the attendance.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function checkin(): BelongsTo
    {
        return $this->belongsTo(Record::class, 'checkin_id');
    }

    /**
     * Get the checkout record associated with the attendance.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function checkout(): BelongsTo
    {
        return $this->belongsTo(Record::class, 'checkout_id');
    }
}
