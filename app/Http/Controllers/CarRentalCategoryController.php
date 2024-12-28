<?php

namespace App\Http\Controllers;

use App\Models\CarRentalCategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class CarRentalCategoryController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            // new Middleware('auth', only: ['store']),
            // new Middleware('auth', except: ['index', 'store']),
            new Middleware('auth'),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carRentalCategories = CarRentalCategory::latest()->get();
        return view('dashboard.sewa-mobil-categories.index', compact('carRentalCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $slug = Str::slug($fields['name']);

        Auth::user()->carRentalCategories()->create([
            'name' => $fields['name'],
            'slug' => $slug
        ]);

        // return redirect()->route('blog-categories.index')->with('success', 'Blog Category created successfully');
        return back()->with('success', 'Car Rental Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(CarRentalCategory $carRentalCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CarRentalCategory $carRentalCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CarRentalCategory $carRentalCategory)
    {
        Gate::authorize('modify', $carRentalCategory);

        $fields = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $slug = Str::slug($fields['name']);

        $carRentalCategory->update([
            'name' => $fields['name'],
            'slug' => $slug
        ]);

        return back()->with('success', 'Car Rental Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarRentalCategory $carRentalCategory)
    {
        Gate::authorize('modify', $carRentalCategory);

        $carRentalCategory->delete();

        return back()->with('delete', 'Car Rental Category deleted successfully');
    }
}
