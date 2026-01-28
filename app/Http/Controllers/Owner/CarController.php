<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::where('owner_id', Auth::id())->latest()->get();
        return view('owner.cars.index', compact('cars'));
    }

    public function create()
    {
        $brands = CarBrand::where('status', true)->get();
        $categories = CarCategory::where('status', true)->get();

        return view('owner.cars.create', compact('brands', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'car_brand_id' => 'required|exists:car_brands,id',
            'car_category_id' => 'required|exists:car_categories,id',
            'title' => 'required',
            'model' => 'required',
            'year' => 'required|digits:4',
            'registration_number' => 'required|unique:cars',
            'price_per_day' => 'required|numeric',
            'seats' => 'required|integer',
            'fuel_type' => 'required'
        ]);

        Car::create([
            'owner_id' => Auth::id(),
            ...$request->all()
        ]);

        return redirect()->route('owner.cars.index')
            ->with('success', 'Car added successfully, waiting for approval');
    }
}
