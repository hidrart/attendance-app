<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show presence page.
     *  
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function presence()
    {
        $attendance = Attendance::where([
            'user_id' => Auth::user()->id,
        ])
            ->whereDate('created_at', today())
            ->firstOr(function () {
                return Attendance::create([
                    'date' => today(),
                    'user_id' => Auth::user()->id,
                    'checkin_id' => null,
                    'checkout_id' => null,
                ]);
            })->load('checkin', 'checkout');

        return view('presence', compact('attendance'));
    }
}
