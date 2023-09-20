<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Make;
use App\Models\Reservation;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function create()
    {
        $makes = Make::all();
        return view('reservations.create',  ['makes' => $makes]);
    }

    public function getModels($make)
    {
        $models = [];
        $models = Car::where('make_id', $make)->pluck('model_and_year')->unique()->toArray();
    
        return response()->json(['models' => $models]);
    }
    
    public function getColors($make, $model)
    {
        $colors = [];
        $colors = Car::where('make_id', $make)->where('model_and_year', $model)->pluck('color')->unique()->toArray();
    
        return response()->json(['colors' => $colors]);
    }
    
    public function store(Request $request)
    {
        $data = $request->validate([
            'make' => 'required|string',
            'model' => 'required|string',
            'color' => 'required|string',
            'full_name' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);

        $car = Car::firstWhere([
            'make_id' => $data['make'],
            'model_and_year' => $data['model'],
            'color' => $data['color']
        ]);

        $reservationData = [
            'car_id' => $car->id,
            'full_name' => $data['full_name'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date']
        ];

        $reservation = Reservation::create($reservationData);

        if ($reservation)
        {
            return redirect('/')->with('success', 'Reservation submitted successfully.');
        }
        else
        {
            return back()->with('error', 'Failed to submit reservation. Please try again.');
        }
    
    }
    
}
