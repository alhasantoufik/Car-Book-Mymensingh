<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarCategory;
use Illuminate\Http\Request;

class CarCategoryController extends Controller
{
    public function index()
    {
        $categories = CarCategory::latest()->get();
        return view('admin.pages.car_categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:car_categories'
        ]);

        CarCategory::create($request->only('name'));

        return back()->with('success', 'Category added successfully');
    }
}
