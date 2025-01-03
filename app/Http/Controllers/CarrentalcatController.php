<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Carrentalcat;
use Illuminate\Http\Request;

class CarrentalcatController extends Controller
{
    public function index()
    {
        $carrentalcats = Carrentalcat::latest()->get();
        return view('dashboard.car-rental.car-rental-cat', compact('carrentalcats'));
    }
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|max:255|unique:carrentalcats',
        ]);

        $slug = Str::slug($request->name);

        Carrentalcat::create([...$fields, 'slug' => $slug]);

        return back()->with('success', 'Car Rental category created successfully');
    }
    public function update(Request $request, Carrentalcat $carrentalcat)
    {
        $fields = $request->validate([
            'name' => 'required|max:255|unique:carrentalcats',
        ]);

        $slug = Str::slug($request->name);

        $carrentalcat->update([...$fields, 'slug' => $slug]);

        return back()->with('success', 'Car Rental category updated successfully');
    }

    public function destroy(Carrentalcat $carrentalcat)
    {
        if ($carrentalcat->id === 1) {
            return back()->with('error', 'Default category cannot be deleted.');
        }
        $carrentalcat->delete();
        return back()->with('success', 'Car Rental category deleted successfully');
    }
}
