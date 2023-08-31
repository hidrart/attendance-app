<?php


namespace App\Http\Traits;

use Illuminate\Support\Carbon;

trait ReadableCreateUpdateDate
{
    /**
     * Get the updated_at attribute to human readable format.
     * 
     * @param string $value
     */
    public function getCreatedAtAttribute($value): string
    {
        return Carbon::parse($value)->timezone('Asia/Jakarta')->isoFormat('dddd, DD MMMM YYYY', 'id');
    }

    /**
     * Get the updated_at attribute to human readable format.
     * 
     * @param string $value
     */
    public function getUpdatedAtAttribute($value): string
    {
        return Carbon::parse($value)->timezone('Asia/Jakarta')->isoFormat('dddd, DD MMMM YYYY', 'id');
    }
}
