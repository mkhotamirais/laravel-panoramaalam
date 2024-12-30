<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Tourpackagecat;
use Illuminate\Http\Request;

class TourpackagecatController extends Controller
{
    public function index()
    {
        $tourpackagecats = Tourpackagecat::latest()->get();
        return view('dashboard.tour-package.tour-package-cat', compact('tourpackagecats'));
    }
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|max:255|unique:tourpackagecats',
        ]);

        $slug = Str::slug($request->name);

        Tourpackagecat::create([...$fields, 'slug' => $slug]);

        return back()->with('success', 'Tour Package category created successfully');
    }
    public function update(Request $request, Tourpackagecat $tourpackagecat)
    {
        $fields = $request->validate([
            'name' => 'required|max:255|unique:tourpackagecats',
        ]);

        $slug = Str::slug($request->name);

        $tourpackagecat->update([...$fields, 'slug' => $slug]);

        return back()->with('success', 'Tour Package category updated successfully');
    }

    public function destroy(Tourpackagecat $tourpackagecat)
    {
        if ($tourpackagecat->id === 1) {
            return back()->with('error', 'Default category cannot be deleted.');
        }
        $tourpackagecat->delete();
        return back()->with('success', 'Tour Package category deleted successfully');
    }
}
