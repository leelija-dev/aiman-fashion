<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Unit;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    //
    public function index(Request $request){
        // Eager-load images to fetch the first image per product efficiently
        $query = Product::with(['images' => function ($q) {
            $q->orderBy('id');
        }]); 
        if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('sku', 'like', "%{$search}%");
        });
        }
        $data = $query->paginate(15);
        $brands = Brand::select('id','name')->where('is_active', true)->orderBy('name')->get();
        $units=Unit::all();
        $categories=Category::select('id','name')->where('is_active', 1)->orderBy('name')->get();
        $categories=Category::select('id','name')->where('is_active', 1)->orderBy('name')->get();
        return view('Admin.product.index', compact('data','brands','units','categories'));
    }
    public function create(){
        // Provide brands and units for dropdowns
        $brands = Brand::select('id','name')->orderBy('name')->get();
        $units  = Unit::select('id','name','code')->orderBy('name')->get();
        $categories = Category::select('id','name')->where('is_active', 1)->orderBy('name')->get();
        return view('Admin.product.create', compact('brands','units','categories'));
    }
    public function store(Request $request){
        $data=$request->validate([
            //'sku'         => 'nullable|string|max:64',
            'sku'         =>'required|string|max:64|unique:products,sku',
            //'name'        => 'required|string|max:255',
            'name'        =>'required|string|max:255',
            'brand_id'    => 'required|exists:brands,id',
            'unit'        => 'required|string|max:12',
            'unit_id'     => 'required|exists:units,id',
            'category_id' => 'required|exists:product_categories,id',
            'description' => 'nullable|string',
            'is_active'   => 'nullable|boolean',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        $product = Product::create([
            'sku'         => $data['sku'] ?? null,
            'name'        => $data['name'],
            'brand_id'    => $data['brand_id'] ?? null,
            'unit_amount' => $data['unit'] ?? null,
            'unit_id'     => $data['unit_id'],
            'category_id' => $data['category_id'] ?? null,
            'description' => $data['description'] ?? null,
            'is_active'   => (bool)($data['is_active'] ?? true),
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();

            //Automatically create folder if it doesn’t exist
            $uploadPath = public_path('upload_image');

            if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
            }

            $file->move($uploadPath, $filename);
            //
            
            //
            ProductImage::create([
                'product_id' => $product->id,
                'image'      => $filename,
            ]);
        }
        return(redirect()->route('admin.products')->with('success','Product data submitted successfully'));

    }
    public function update(Request $request,$id){
        $data=$request->validate([
            'sku'         => 'nullable|string|max:64|unique:products,sku,'.$id,
            'name'        => 'required|string|max:255',
            'brand_id'    => 'required|exists:brands,id',
            'unit'        => 'required|string|max:12',
            'unit_id'     => 'required|exists:units,id',
            'category_id' => 'required|exists:product_categories,id',
            'description' => 'nullable|string',
            'is_active'   => 'nullable|boolean',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        Product::where('id',$id)->update([
            'sku'         => $data['sku'] ?? null,
            'name'        => $data['name'],
            'brand_id'    => $data['brand_id'] ?? null,
            'unit_amount'        => $data['unit'] ?? null,
            'unit_id'     => $data['unit_id'],
            'category_id' => $data['category_id'] ?? null,
            'description' => $data['description'] ?? null,
            'is_active'   => (bool)($data['is_active'] ?? true),
        ]);

        // If a new image is uploaded, remove previous images and store the new one
        if ($request->hasFile('image')) {
            // Delete existing image files and DB rows for this product
            $existingImages = ProductImage::where('product_id', $id)->get();
            foreach ($existingImages as $img) {
                $path = public_path('upload_image/' . $img->image);
                if (File::exists($path)) {
                    File::delete($path);
                }
            }
            ProductImage::where('product_id', $id)->delete();

            // Save the new image
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload_image'), $filename);

            ProductImage::create([
                'product_id' => $id,
                'image'      => $filename,
            ]);
        }
        $data=Product::all();
        return(redirect()->route('admin.products',compact('data'))->with('success','Product data updated successfully'));
    }
    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        
        $data=Product::all();
        return (redirect()->route('admin.products',compact('data')))->with('success', 'Product deleted successfully!');
    }
    public function trashed()
    {
        $data=Product::onlyTrashed()->get();
        return view('Admin.product.trashed',compact('data'));
    }
    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();
        
        //$data=Product::all();
        return (redirect()->route('admin.products-trashed'))->with('success', 'Product restored successfully!');
    }
    public function permanentlyDelete($id){
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->forceDelete();
        return (redirect()->route('admin.products-trashed'))->with('success', 'Product permanently deleted successfully!');
    }
}
