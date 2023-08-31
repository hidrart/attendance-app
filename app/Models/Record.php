<?php

namespace App\Models;

use App\Http\Traits\ReadableCreateUpdateDate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Record extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = [
        'type',
        'latitude',
        'longitude',
        'accuracy',
        'photo',
        'user_id',
    ];

    /**
     * Override the default photo accessor.
     */
    public function getPhotoAttribute($value)
    {
        if (Storage::disk('public')->exists('photos/' . $value)) {
            return Storage::url('photos/' . $value);
        }
        return $value;
    }

    /**
     * Get the user that owns the record.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the attendance that owns the record.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attendance(): BelongsTo
    {
        return $this->belongsTo(Attendance::class);
    }

    /**
     * When deleted, delete the photo from storage.
     */
    public function delete()
    {
        Storage::disk('public')->delete('photos/' . $this->photo);
        parent::delete();
    }
}
