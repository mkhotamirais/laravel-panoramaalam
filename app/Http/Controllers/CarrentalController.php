<?php

namespace App\Http\Controllers;

use App\Models\Carrental;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Str;
use App\Models\Carrentalcat;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class CarrentalController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            // new Middleware('auth', only: ['show']),
            new Middleware('auth', except: ['show']),
            // new Middleware('auth'),
        ];
    }
    public function index()
    {
        $carrentals = Carrental::latest()->paginate(6);
        $myCarrentals = Carrental::where('user_id', Auth::id())->latest()->paginate(3);

        return view('dashboard.car-rental.index', compact('carrentals', 'myCarrentals'));
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
            'license_plate' => 'nullable',
            'rental_price' => 'required|integer',
            'color' => 'required',
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

        // Create carrental
        // $carrental = Carrental::create([...$fields, 'user_id' => Auth::id()]);
        // Auth::user()->carrentals()->create($fields);
        Auth::user()->carrentals()->create([...$fields, 'slug' => $slug, 'banner' => $path]);

        // Redirect
        // return back()->with('success', 'Carrental created successfully');
        return redirect('/carrentals')->with('success', 'Carrental created successfully');
    }
    public function show(Carrental $carrental)
    {
        $latestThreeCarrentals = Carrental::latest()->where('id', '!=', $carrental->id)->take(3)->get();
        return view('pages.car-rental.show', compact('carrental', 'latestThreeCarrentals'));
    }

    public function edit(Carrental $carrental)
    {
        // authorize
        Gate::authorize('modify', $carrental);
        $carrentalCategories = Carrentalcat::all();
        return view('dashboard.car-rental.edit', compact('carrental', 'carrentalCategories'));
    }

    public function update(Request $request, Carrental $carrental)
    {
        // authorize
        Gate::authorize('modify', $carrental);
        // Validate
        $fields = $request->validate([
            'brand_name' => 'required|max:255',
            'license_plate' => 'nullable',
            'rental_price' => 'required|integer',
            'color' => 'required',
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

        // Redirect
        // return back()->with('success', 'Carrental updated successfully');
        return redirect('/carrentals')->with('success', 'Carrental updated successfully');
    }

    public function destroy(Carrental $carrental)
    {
        // authorize
        Gate::authorize('modify', $carrental);

        if ($carrental->banner) {
            Storage::disk('public')->delete($carrental->banner);
        }

        $carrental->delete();

        return back()->with('delete', 'Car Rental deleted successfully');
    }
}
