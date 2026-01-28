<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Car;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request, $carId)
    {
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date'   => 'required|date|after:start_date',
        ]);

        $car = Car::findOrFail($carId);

        // Check availability
        $exists = Booking::where('car_id', $carId)
            ->where('status', '!=', 'cancelled')
            ->where(function ($q) use ($request) {
                $q->whereBetween('start_date', [$request->start_date, $request->end_date])
                  ->orWhereBetween('end_date', [$request->start_date, $request->end_date]);
            })->exists();

        if ($exists) {
            return back()->with('error', 'Car already booked for selected dates');
        }

        $start = Carbon::parse($request->start_date);
        $end   = Carbon::parse($request->end_date);

        $days = $start->diffInDays($end) + 1;

        Booking::create([
            'car_id'        => $car->id,
            'user_id'       => Auth::id(),
            'owner_id'      => $car->owner_id,
            'start_date'    => $start,
            'end_date'      => $end,
            'total_days'    => $days,
            'price_per_day' => $car->price_per_day,
            'total_price'   => $days * $car->price_per_day,
        ]);

        return redirect()->back()->with('success', 'Booking request sent successfully');
    }
}
