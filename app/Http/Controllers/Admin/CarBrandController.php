<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarBrand;
use Illuminate\Http\Request;

class CarBrandController extends Controller
{
    public function index()
    {
        $brands = CarBrand::latest()->get();
        return view('admin.pages.car_brands.index', compact('brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:car_brands'
        ]);

        CarBrand::create($request->only('name'));

        return back()->with('success', 'Brand added successfully');
    }
}
