<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Orders;
use App\Models\Product_list;
use App\Models\Saller;
use App\Models\SubscribedUser;
use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    function home()
    {
        $products = Product_list::latest()->take(10)->get();

        return view('header',['products'=>$products]);
    }
    function about_us()
    {
        return view('about_us');
    }
    function showproduct(Request $request){
        $product = Product_list::where('id',$request->id)->first();
        return view('productview',['product'=>$product]);
    }
    function search(Request $request)
    {
        $sort_by = $request->input('sort_by', 'id'); // default column to sort by
        $sort_direction = $request->input('sort_direction', 'asc');
        $searchTerm = "";
        if($request->searchTerm)
        {
            $request->validate(['searchTerm'=>'string']);
            $searchTerm = $request->searchTerm;
        }
        elseif($request->search_text)
        {
            $request->validate(['search_text'=>'string']);
            $searchTerm = $request->search_text;
        }

        if ($sort_by == 'price') {
            // Fetch sorted products with price cast to numeric type
            $products = Product_list::where(function($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('discription', 'like', '%' . $searchTerm . '%')
                      ->orWhere('brand', 'like', '%' . $searchTerm . '%')
                      ->orWhere('category', 'like', '%' . $searchTerm . '%');
            })->orderByRaw('CAST(price AS DECIMAL(10,2)) ' . $sort_direction)
            ->get();
        } 
        else {
            $products = Product_list::where(function($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('discription', 'like', '%' . $searchTerm . '%')
                      ->orWhere('brand', 'like', '%' . $searchTerm . '%')
                      ->orWhere('category', 'like', '%' . $searchTerm . '%');
            })->orderBy($sort_by, $sort_direction)
            ->get();
        }

        return view('listView', compact('products', 'searchTerm', 'sort_by', 'sort_direction'));
    }
    function allProducts(Request $request)
    {
        // Get sorting parameters from the request
        $sort_by = $request->input('sort_by', 'id'); // default column to sort by
        $sort_direction = $request->input('sort_direction', 'asc'); // default sort direction

        // Check if the sorting column is price
        if ($sort_by == 'price') {
            // Fetch sorted products with price cast to numeric type
            $products = Product_list::select('*')
            ->orderByRaw('CAST(price AS DECIMAL(10,2)) ' . $sort_direction)
            ->get();
        } 
        else {
            $products = Product_list::orderBy($sort_by, $sort_direction)->get();
        }

        return view('listView', compact('products', 'sort_by', 'sort_direction'));
    }
    function subscribe(Request $request)
    {
        $request->validate(['email'=>'string|required:max:90']);
        if( 0 < SubscribedUser::where('email',$request->email)->count() )
        {
            return redirect()->back()->with(['footer_error'=>'Email already subscribed.']);
        }
        else{
            
            $subscribed_user = new SubscribedUser();
            $subscribed_user->email = $request->email;
            $subscribed_user->save();

            return redirect()->back()->with(['footer_success'=>'Subscribed Sucessfully.']);
        }
    }
}
