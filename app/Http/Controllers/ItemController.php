<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\File;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $items = Item::query();

        if ($request->has('q') && $request->q !== '') {
            $category = Category::where('name', $request->q)->first();
            if ($category) {
                $items->where('category_id', $category->id);
            }
        }

        $items = $items->get();
        $categories = Category::all(); // Fetch all categories

        return view('items.index', [
            'items' => $items,
            'categories' => $categories, // Pass categories to the view
        ]);
        
    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all(); // Fetch all categories

        return view('items.create', [
            'categories' => $categories, // Pass categories to the view
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Mengambil file gambar dari request
        $file = $request->file('image');
        $fileName = $file->getClientOriginalName();

        // Menyimpan gambar ke folder public/img/products
        $file->move(public_path('img/products'), $fileName);

        // Membuat URL gambar relatif
        $imageUrl = 'img/products/' . $fileName;

        // Simpan data barang ke database
        $item = new Item();
        $item->name = $request->name;
        $item->price = $request->price;
        $item->category_id = $request->category_id;
        $item->image = $fileName; 
        $item->save();

        // Redirect kembali ke dashboard dengan flash message
        return redirect()->route('dashboard')->with('success', 'Barang berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $categories = Category::all(); // Fetch all categories
        
        return view('items.edit', compact('item', 'categories'));
    }

    public function editJson(Item $item)
    {
        return response()->json($item);
    }

        /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $item->name = $request->name;
        $item->price = $request->price;
        $item->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($item->image && File::exists(public_path('img/products/' . $item->image))) {
                File::delete(public_path('img/products/' . $item->image));
            }

            // Upload gambar baru
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/products'), $fileName);
            $item->image = $fileName;
        }

        $item->save();

        return redirect()->route('dashboard')->with('success', 'Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    
    public function destroy(Item $item)
    {
        // Hapus file gambar dari server jika ada
        if ($item->image && File::exists(public_path('img/products/' . $item->image))) {
            File::delete(public_path('img/products/' . $item->image));
        }

        // Hapus item dari database
        $item->delete();

        return redirect()->route('dashboard')->with('success', 'Item deleted successfully');
    }
}
