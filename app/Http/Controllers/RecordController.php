<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Http\Requests\StoreRecordRequest;
use App\Models\Attendance;
use Illuminate\Support\Facades\Storage;

class RecordController extends Controller
{
    /**
     * Process user presence checkin.
     */
    public function checkin(StoreRecordRequest $request)
    {
        $attendance = Attendance::where('user_id', $request->user()->id)
            ->whereDate('created_at', today())
            ->whereNull('checkin_id')
            ->firstOrFail();

        $filename = sprintf('%s.jpg', time());
        Storage::disk('public')->put('photos/' . $filename, base64_decode($request->photo));

        $attendance->update([
            'checkin_id' => Record::create([
                'type' => 'checkin',
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'accuracy' => $request->accuracy,
                'photo' => $filename,
                'user_id' => $request->user()->id,
            ])->id,
        ]);

        return redirect()->route('presence')->with('success', 'Checkin recorded successfully.');
    }

    /**
     * Process user presence checkout.
     */
    public function checkout(StoreRecordRequest $request)
    {
        $attendance = Attendance::where('user_id', $request->user()->id)
            ->whereDate('created_at', today())
            ->whereNotNull('checkin_id')
            ->whereNull('checkout_id')
            ->firstOrFail();

        $filename = sprintf('%s.jpg', time());
        Storage::disk('public')->put('photos/' . $filename, base64_decode($request->photo));

        $attendance->update([
            'checkout_id' => Record::create([
                'type' => 'checkout',
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'accuracy' => $request->accuracy,
                'photo' => $filename,
                'user_id' => $request->user()->id,
            ])->id,
        ]);

        return redirect()->route('presence')->with('success', 'Checkout recorded successfully.');
    }
}
