<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Query all categories
        $categories = Category::query();

        // Add filter by name if requested
        if ($request->has('name') && $request->name !== '') {
            $categories->where('name', 'like', '%' . $request->name . '%');
        }

        // Order by latest and paginate
        $categories = $categories->latest()->paginate();

        // Return view
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return view to create a new category
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'name' => 'required|string|unique:categories,name',
        ]);

        // Create new category
        $category = new Category();
        $category->name = $request->name;
        $category->save();

        // Redirect with success message
        return redirect()->route('category.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        // Return view to show a single category
        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // Return view to edit a category
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name,' . $category->id,
        ]);
     
        $category->name = $request->name;
        $category->save();
     
        return redirect()->route('category.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    // public function destroy(Category $category)
    // {
    //     // Delete category
    //     $category->delete();

    //     // Redirect with success message
    //     return redirect()->route('category.index')->with('success', 'Kategori berhasil dihapus!');
    // }

    public function destroy(Category $category)
    {
        // Check if the category has items
        if ($category->items()->exists()) {
            return redirect()->route('category.index')->with('error', 'Kategori tidak dapat dihapus karena masih memiliki item terkait.');
        }

        // Delete the category if no items are associated
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
