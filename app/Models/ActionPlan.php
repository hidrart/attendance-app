<?php

namespace App\Models;

use App\Http\Traits\ReadableCreateUpdateDate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ActionPlan extends Model
{
    use HasFactory;
    use ReadableCreateUpdateDate;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'work_id',
        'photo',
        'plan',
        'analysis',
        'recommendation',
        'status',
    ];

    /**
     * Override delete method to delete image from storage.
     * 
     * @return void
     */
    public function delete()
    {
        if ($this->attributes['photo'] !== null) {
            Storage::disk('public')->exists($this->attributes['photo'])
                ? Storage::disk('public')->delete($this->attributes['photo'])
                : null;
        }
        parent::delete();
    }

    /**
     * Override update method to delete old image from storage.
     *
     * @param array $attributes
     * @param array $options
     * @return bool
     */
    public function update(array $attributes = [], array $options = []): bool
    {
        if ($this->attributes['photo'] !== null) {
            Storage::disk('public')->exists($this->attributes['photo'])
                ? Storage::disk('public')->delete($this->attributes['photo'])
                : null;
        }
        return parent::update($attributes, $options);
    }

    /**
     * Override get photo attribute to return url.
     * 
     * @return string|null
     */
    public function getPhotoAttribute(): ?string
    {
        return $this->attributes['photo'] !== null
            ? Storage::url($this->attributes['photo'])
            : null;
    }

    /**
     * Get the work that owns the ActionPlan
     *  
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function work(): BelongsTo
    {
        return $this->belongsTo(Work::class);
    }

    /**
     * Get the user that owns the ActionPlan
     *  
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
