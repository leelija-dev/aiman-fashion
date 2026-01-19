<?php

namespace App\Http\Controllers\Web;

use Illuminate\Support\Facades\DB;
use App\Http\Service\Services;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct() {}
    public function home()
    {
        // $services = Service::with(['children' => function ($query) {
        //     $query->select('id', 'name', 'slug', 'parent_id');
        // }])
        //     ->select('id', 'name', 'parent_id')
        //     ->whereNull('parent_id')
        //     ->orderBy('name')
        //     ->get();
        // // dd($services);
        $data = Service::all();
        // $categories = Category::all();

        // $products = DB::table('products')
        //     ->where('is_active', 1)
        //     ->get();

        $products = DB::table('products')
            ->rightJoin('product_variants', 'products.id', '=', 'product_variants.product_id')
            ->where('products.is_active', 1)
            ->select(
                'products.*',
                'product_variants.id as variant_id',
                'product_variants.size',
                'product_variants.color',
                'product_variants.price',
                'product_variants.stock'
            )
            ->get();


       

        $categories = Category::withCount('products')->get();


        $testimonials = [];

        return view('web.home', compact('data', 'testimonials', 'categories', 'products'));
    }
}
