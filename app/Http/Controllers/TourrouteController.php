<?php

namespace App\Http\Controllers;

use App\Models\Tourroute;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TourrouteController extends Controller
{
    public function index()
    {
        $tourroutes = Tourroute::latest()->get();
        return view('dashboard.tour-package.tour-route', compact('tourroutes'));
    }
    public function store(Request $request)
    {
        // dd($request);
        $fields = $request->validate([
            'name' => 'required|max:255|unique:tourroutes',
        ]);

        $slug = Str::slug($request->name);
        Tourroute::create([...$fields, 'slug' => $slug]);
        return back();
    }

    public function destroy(Tourroute $tourroute)
    {
        $tourroute->delete();
        return back();
    }
    public function update(Request $request, Tourroute $tourroute)
    {
        $fields = $request->validate([
            'name' => 'required|max:255|unique:tourroutes',
        ]);
        $slug = Str::slug($request->name);

        $tourroute->update([...$fields, 'slug' => $slug]);
        return back();
    }
}
