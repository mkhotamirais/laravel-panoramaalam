<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Tourpackage;
use Illuminate\Support\Str;
use App\Models\Tourpackagecat;
use App\Models\Tourimage;
use App\Models\Tourroute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class TourpackageController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            // new Middleware('auth', only: ['store']),
            new Middleware('auth', except: ['show']),
            // new Middleware('auth'),
        ];
    }

    public function index()
    {
        $tourpackages = Tourpackage::latest()->paginate(6);
        $myTourpackages = Tourpackage::where('user_id', Auth::id())->latest()->paginate(3);
        return view('dashboard.tour-package.index', compact('tourpackages', 'myTourpackages'));
    }

    public function create()
    {
        $tourpackagecats = Tourpackagecat::all();
        $tourroutes = Tourroute::all();
        return view('dashboard.tour-package.create', compact('tourpackagecats', 'tourroutes'));
    }

    public function store(Request $request)
    {
        // Validate
        $fields = $request->validate([
            'name' => 'required|max:255|unique:tourpackages',
            'detail' => 'nullable',
            'price' => 'required|integer',
            'price_detail' => 'nullable',
            'status' => 'required|in:active,inactive',
            'itenary_description' => 'required',
            'itenary_detail' => 'nullable',
            'policy_description' => 'required',
            'policy_detail' => 'nullable',
            'info_description' => 'required',
            'info_detail' => 'nullable',
            'tourroutes' => 'required|array|min:1',
            'tourroutes.*' => 'exists:tourroutes,id',
            'banner' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'tourpackagecat_id' => 'nullable|integer|exists:tourpackagecats,id',
        ]);

        $slug = Str::slug($fields['name']);

        // Upload image if file exist
        $path = null;
        if ($request->hasFile('banner')) {
            $path = Storage::disk('public')->put('tourpackages-images', $request->banner);
        }

        $tourpackage = Auth::user()->tourpackages()->create([...$fields, 'slug' => $slug, 'banner' => $path]);

        // Simpan gambar-gambar ke storage dan database
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('tourpackages-images', 'public');
                $tourpackage->tourimages()->create([
                    'image_path' => $path,
                ]);
            }
        }

        $tourpackage->tourroutes()->attach($fields['tourroutes']);

        return redirect('/tourpackages')->with('success', 'Tourpackage created successfully');
    }

    public function show(Tourpackage $tourpackage)
    {
        $latestThreeTourpackages = Tourpackage::latest()->where('id', '!=', $tourpackage->id)->take(4)->get();
        $blogs = Blog::with('blogcat')
            ->whereDoesntHave('blogcat', function ($query) {
                $query->where('slug', 'destinasi');
            })->latest()->take(4)->get();

        return view('pages.tour-package.show', compact('tourpackage', 'blogs', 'latestThreeTourpackages'));
    }

    public function edit(Request $request, Tourpackage $tourpackage)
    {
        $tourroutes = Tourroute::all();
        $tourpackagecats = Tourpackagecat::all();
        return view('dashboard.tour-package.edit', compact('tourpackage', 'tourpackagecats', 'tourroutes'));
    }

    public function update(Request $request, Tourpackage $tourpackage)
    {
        // Validate
        $fields = $request->validate([
            'name' => "required|max:255|unique:tourpackages,name,$tourpackage->id",
            'detail' => 'nullable',
            'price' => 'required|integer',
            'price_detail' => 'nullable',
            'status' => 'required|in:active,inactive',
            'itenary_description' => 'required',
            'itenary_detail' => 'nullable',
            'policy_description' => 'required',
            'policy_detail' => 'nullable',
            'info_description' => 'required',
            'info_detail' => 'nullable',
            'tourroutes' => 'required|array|min:1',
            'tourroutes.*' => 'exists:tourroutes,id',
            'banner' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'exists:tourimages,id',
            'tourpackagecat_id' => 'nullable|integer|exists:tourpackagecats,id',
        ]);

        $slug = Str::slug($fields['name']);

        // Upload image if file exist
        $path = null;
        if ($request->hasFile('banner')) {
            $path = Storage::disk('public')->put('tourpackages-images', $request->banner);
        }

        $path = $tourpackage->banner ?? null;
        if ($request->hasFile('banner')) {
            if ($tourpackage->banner) {
                Storage::disk('public')->delete($tourpackage->banner);
            }
            $path = Storage::disk('public')->put('tourpackages-images', $request->banner);
        }
        // Update the tourpackage
        $tourpackage->update([...$fields, 'slug' => $slug, 'banner' => $path]);

        // Sinkronisasi tourroutes jika ada
        if ($request->has('tourroutes')) {
            $tourpackage->tourroutes()->sync($fields['tourroutes']);
        }

        // Hapus gambar yang dipilih
        if ($request->has('delete_images')) {
            $imagesToDelete = Tourimage::whereIn('id', $request->delete_images)->get();
            foreach ($imagesToDelete as $image) {
                // Hapus file fisik
                if (Storage::disk('public')->exists($image->image_path)) {
                    Storage::disk('public')->delete($image->image_path);
                }
                // Hapus data dari database
                $image->delete();
            }
        }

        // Tambahkan gambar baru
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('tourpackages-images', 'public');
                $tourpackage->tourimages()->create([
                    'image_path' => $path,
                ]);
            }
        }

        return redirect('/tourpackages')->with('success', 'Tourpackage updaed successfully');
    }

    public function destroy(Tourpackage $tourpackage)
    {
        foreach ($tourpackage->tourimages as $image) {
            $filePath = $image->image_path;
            if (Storage::disk('public')->exists($filePath)) {
                // dump('File exists: ' . $filePath);
                Storage::disk('public')->delete($filePath);
                // dump('File deleted: ' . $filePath);
            } else {
                // dump('File not found: ' . $filePath);
            }
            $image->delete(); // Hapus data dari database
        }

        if ($tourpackage->banner) {
            Storage::disk('public')->delete($tourpackage->banner);
        }

        $tourpackage->delete();

        return back()->with('delete', 'Tourpackage deleted successfully');
    }
}
