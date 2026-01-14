<?php

namespace App\Http\Controllers\Web;

use App\Http\Service\Services;
use App\Http\Controllers\Controller;
use App\Models\Service;
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
        $testimonials=[];

        return view('web.home', compact('data','testimonials'));
    }
}
