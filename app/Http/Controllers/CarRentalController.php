<?php

namespace App\Http\Controllers;

use App\Models\CarRental;
use App\Models\CarRentalCategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use function Pest\Laravel\post;

class CarRentalController extends Controller implements HasMiddleware
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
        $carRentals = CarRental::latest()->paginate(6);
        $myCarRentals = CarRental::where('user_id', Auth::id())->latest()->paginate(3);

        return view('dashboard.sewa-mobil.index', compact('carRentals', 'myCarRentals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $carRentalCategories = CarRentalCategory::all();
        return view('dashboard.sewa-mobil.create', compact('carRentalCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate
        $fields = $request->validate([
            'brandName' => 'required|max:255',
            'licensePlate' => 'required|max:255',
            'totalPrice' => 'required|max:255',
            'color' => 'required|max:255',
            'banner' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'carRentalCategory' => 'requiredinteger|exists:car_rental_categories,id'
        ]);

        $slug = Str::slug($fields['brandName']);

        // Upload image if file exist
        $path = null;
        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->put('car_rentals_images', $request->image);
        }

        // Create carRental
        // $carRental = CarRental::create([...$fields, 'user_id' => Auth::id()]);
        // Auth::user()->carRentals()->create($fields);
        Auth::user()->carRentals()->create([
            'brand_name' => $request->brandName,
            'slug' => $slug,
            'license_plate' => $request->licensePlate,
            'total_price' => $request->totalPrice,
            'color' => $request->color,
            'banner' => $path,
            'car_rental_category' => $request->carRentalCategory
        ]);

        // Redirect
        // return back()->with('success', 'CarRental created successfully');
        return redirect('/sewas')->with('success', 'Car Rental created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(CarRental $carRental)
    {
        $latestThreeCarRentals = CarRental::latest()->where('id', '!=', $carRental->id)->take(3)->get();
        return view('dashboard.sewa-mobil.show', compact('carRental', 'latestThreeCarRentals'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CarRental $carRental)
    {
        // authorize
        Gate::authorize('modify', $carRental);
        return view('dashboard.sewa-mobil.edit', compact('carRental'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CarRental $carRental)
    {
        // authorize
        Gate::authorize('modify', $carRental);

        // Validate
        $fields = $request->validate([
            'brandName' => 'required|max:255',
            'licensePlate' => 'required|max:255',
            'totalPrice' => 'required|max:255',
            'color' => 'required|max:255',
            'banner' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'carRentalCategory' => 'required|integer|exists:car_rental_categories,id'
        ]);

        $slug = Str::slug($fields['brandName']);

        // Upload image if file exist
        $path = $carRental->image ?? null;
        if ($request->hasFile('image')) {
            if ($carRental->image) {
                Storage::disk('public')->delete($carRental->image);
            }
            $path = Storage::disk('public')->put('car_rentals_images', $request->image);
        }
        // Update the carRental
        $carRental->update([
            'brand_name' => $request->brandName,
            'slug' => $slug,
            'license_plate' => $request->licensePlate,
            'total_price' => $request->totalPrice,
            'color' => $request->color,
            'banner' => $path,
            'car_rental_category' => $request->carRentalCategory
        ]);

        // Redirect
        // return back()->with('success', 'CarRental updated successfully');
        return redirect('/sewas')->with('success', 'Car Rental updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarRental $carRental)
    {
        // authorize
        Gate::authorize('modify', $carRental);

        if ($carRental->image) {
            Storage::disk('public')->delete($carRental->image);
        }

        $carRental->delete();

        return back()->with('delete', 'Car Rental deleted successfully');
    }
}
