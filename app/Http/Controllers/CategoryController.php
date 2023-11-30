<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;


use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate('5');
        $softDeletedCategories = Category::onlyTrashed()->get(); 
        return view('admin.category.category', compact('categories','softDeletedCategories'));
        
    }

    public function AddCat(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',

        ]);
       
        $categoryData = [
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ];
        
        if ($request->hasFile('category_image')) {
            $imagePath = $request->file('category_image')->store('categories', 'public');
            $categoryData['category_image'] = $imagePath;
        }
        
        Category::create($categoryData);
        
        return Redirect()->back()->with('success', 'Category Inserted Succesfully');
    }


    public function Edit($id)
    {

        $categories = Category::find($id);
        return view('admin.category.edit', compact('categories'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
    
        // Update category details
        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;
        
        // Check if a new image is being uploaded
        if ($request->hasFile('category_image')) {
            $imagePath = $request->file('category_image')->store('categories', 'public');
            $category->category_image = $imagePath;
        }
    
        $category->save();
    
        return redirect()->route('AllCat')->with('success', 'Updated Successfully');
    }
    

    
    public function destroy($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully');
    }

    private function validateCategory(Request $request)
    {
        return $request->validate([
            'category_name' => 'required|string',
            'category_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }
    public function restore($id)
    {
        $category = Category::onlyTrashed()->find($id);
        $category->restore();

        return redirect()->route('AllCat')->with('status', 'Category restored successfully.');
    }

    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->find($id);
        $category->forceDelete();

        return redirect()->route('AllCat')->with('status', 'Category permanently deleted.');
    }

}
