<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Destinationblog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DestinationblogController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            // new Middleware('auth', only: ['store']),
            new Middleware('auth', except: ['show']),
            // new Middleware('auth'),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $destinationblogs = Destinationblog::latest()->paginate(6);
        return view('dashboard.destinationblog.index', compact('destinationblogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.destinationblog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate
        $fields = $request->validate([
            'title' => 'required|max:255|unique:destinationblogs',
            'content' => 'required',
            'banner' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        $slug = Str::slug($fields['title']);

        // Upload image if file exist
        $path = null;
        if ($request->hasFile('banner')) {
            $path = Storage::disk('public')->put('destinationblogs-images', $request->banner);
        }

        Auth::user()->destinationblogs()->create([...$fields, 'slug' => $slug, 'banner' => $path]);

        return redirect('/destinationblogs')->with('success', 'Destinationblog created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Destinationblog $destinationblog)
    {
        return view('pages.show-destinationblog', compact('destinationblog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Destinationblog $destinationblog)
    {
        // authorize
        Gate::authorize('modify', $destinationblog);
        return view('dashboard.destinationblog.edit', compact('destinationblog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Destinationblog $destinationblog)
    {
        // authorize
        Gate::authorize('modify', $destinationblog);

        // Validate
        $fields = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'banner' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        $slug = Str::slug($fields['title']);

        // Upload image if file exist
        $path = $destinationblog->banner ?? null;
        if ($request->hasFile('banner')) {
            if ($destinationblog->banner) {
                Storage::disk('public')->delete($destinationblog->banner);
            }
            $path = Storage::disk('public')->put('destinationblogs-images', $request->banner);
        }
        // Update the destinationblog
        $destinationblog->update([...$fields, 'slug' => $slug, 'banner' => $path]);

        return redirect('/destinationblogs')->with('success', 'Destinationblog updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destinationblog $destinationblog)
    {
        // authorize
        Gate::authorize('modify', $destinationblog);

        if ($destinationblog->banner) {
            Storage::disk('public')->delete($destinationblog->banner);
        }

        $destinationblog->delete();

        return back()->with('delete', 'Destinationblog deleted successfully');
    }
}
