<?php

namespace App\Http\Controllers;

use App\Models\Carrental;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Str;
use App\Models\Carrentalcat;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CarrentalController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['show']),
        ];
    }

    public function index()
    {
        $carrentals = Carrental::latest()->paginate(6);

        return view('dashboard.car-rental.index', compact('carrentals'));
    }

    public function create()
    {
        $carrentalCategories = Carrentalcat::all();
        return view('dashboard.car-rental.create', compact('carrentalCategories'));
    }

    public function store(Request $request)
    {
        // Validate
        $fields = $request->validate([
            'brand_name' => 'required|max:255|unique:carrentals',
            'rental_price' => 'required|integer',
            'banner' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'policy' => 'required',
            'information' => 'nullable',
            'carrentalcat_id' => 'nullable|integer|exists:carrentalcats,id',
        ]);

        $slug = Str::slug($fields['brand_name']);

        // Upload image if file exist
        $path = null;
        if ($request->hasFile('banner')) {
            $path = Storage::disk('public')->put('carrentals-images', $request->banner);
        }

        Auth::user()->carrentals()->create([...$fields, 'slug' => $slug, 'banner' => $path]);

        return redirect('/carrentals')->with('success', 'Carrental created successfully');
    }
    public function show(Carrental $carrental)
    {
        $latestThreeCarrentals = Carrental::latest()->where('id', '!=', $carrental->id)->take(4)->get();
        return view('pages.car-rental.show', compact('carrental', 'latestThreeCarrentals'));
    }

    public function edit(Carrental $carrental)
    {
        $carrentalCategories = Carrentalcat::all();
        return view('dashboard.car-rental.edit', compact('carrental', 'carrentalCategories'));
    }

    public function update(Request $request, Carrental $carrental)
    {
        // Validate
        $fields = $request->validate([
            'brand_name' => "required|max:255|unique:carrentals,brand_name,$carrental->id",
            'rental_price' => 'required|integer',
            'banner' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'policy' => 'required',
            'information' => 'nullable',
            'carrentalcat_id' => 'nullable|integer|exists:carrentalcats,id',
        ]);

        $slug = Str::slug($fields['brand_name']);

        // Upload image if file exist
        $path = $carrental->banner ?? null;
        if ($request->hasFile('banner')) {
            if ($carrental->banner) {
                Storage::disk('public')->delete($carrental->banner);
            }
            $path = Storage::disk('public')->put('carrentals-images', $request->banner);
        }

        // Update the carrental
        $carrental->update([...$fields, 'slug' => $slug, 'banner' => $path]);

        return redirect('/carrentals')->with('success', 'Carrental updated successfully');
    }

    public function destroy(Carrental $carrental)
    {
        if ($carrental->banner) {
            Storage::disk('public')->delete($carrental->banner);
        }

        $carrental->delete();

        return back()->with('delete', 'Car Rental deleted successfully');
    }
}
