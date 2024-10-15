<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Orders;
use App\Models\Product_list;
use App\Models\Saller;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class SallerController extends Controller
{
    function insertProduct(Request $request)
    {
        $request->validate([
            'tittle'=>'string|max:250',
            'description'=>'string',
            'price'=>'string|max:6',
            'category'=>'string|max:50',
            'brand'=>'string|max:50',
            'quantity'=>'string|max:6',
            'discount'=>'string|max:3',
            'product_image1'=>'required|',
            'product_image2'=>'',
            'product_image3'=>''
        ]);

        //moving images to the products_images folder
        $image1 = time().'.'.$request->product_image1->extension();
        $image2 = (time()+1).'.'.$request->product_image2->extension();
        $image3 = (time()+2).'.'.$request->product_image3->extension();

        $imageManager = new ImageManager(new Driver());

        $img = $imageManager->read($request->product_image1);
        $img2 = $imageManager->read($request->product_image2);
        $img3 = $imageManager->read($request->product_image3);

        $img = $img->resize(500,667);
        $img2 = $img2->resize(500,667);
        $img3 = $img3->resize(500,667);

        $img->toJpeg(80)->save(public_path('/products_images/'.$image1));
        $img2->toJpeg(80)->save(public_path('/products_images/'.$image2));
        $img3->toJpeg(80)->save(public_path('/products_images/'.$image3));

        $product = new Product_list;

        $product->email = session('email');
        $product->name = $request->tittle;
        $product->discription = $request->description;
        $product->price = $request->price;
        $product->category = $request->category;
        $product->discount = $request->discount;
        $product->quantity = $request->quantity;
        $product->brand = $request->brand;
        $product->pic1 = $image1;
        $product->pic2 = $image2;
        $product->pic3 = $image3;
        $product->rating = 0;
        $product->sold_count = 0;

        $product->save();
        
        return redirect()->back()->with('success', 'Data added successfully.');
    }
    function deleteItem(Request $request)
    {
        $product = Product_list::where('email',session('email'))->where('id', $request->product_id)->first();
        if($product)
        {
            $product->delete();

            $cartItems = Cart::where("product_id", $request->product_id)->get();
            foreach ($cartItems as $item) {
                $item->delete();
            }
            return redirect()->back()->with('success','Item deleted success fully. !');
        }
        else
            return redirect()->back()->with('error','Unable to delete. !');
    }
    function orders(){
        $orders = Orders::where('saller_email',session('email'))->get();

        $products = [];

        foreach ($orders as $order) {
            $product = Product_list::where('id', $order->product_id)->first();
            if ($product) {
                array_push($products, $product);
            }
        }
                
        return view('/saller/allOrders',['products'=>$products,"orders"=>$orders]);
    }
    function login_view(){
        return view('saller/LoginPage');
    }
    function register_view()
    {
        return view('saller/Register');
    }
    function insertPage(){
        if(session('email'))
        {
            $product = Product_list::where('email',session('email'))->get();
            return view('saller.InsertProduct', [ 'products' => $product]);
        }
        else{
            return view('saller/LoginPage');
        }
    }
    function profile()
    {
        if(session('email'))
        {
            $saller = Saller::where('email',session('email'))->first();
            return view('saller.sallerProfile', ['saller' => $saller]);
        }
        else{
            return view('saller/LoginPage');
        }
    }
    function product_list()
    {
        if(session('email'))
        {
            $product = Product_list::where('email',session('email'))->get();
            return view('saller.ViewProduct', ['products' => $product]);
        }
        else{
            return view('saller/LoginPage');
        }
    }
    function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|string|max:50',
            'password' => 'required|string|min:8'
        ]);
        $saller = Saller::where('email', $request->email)->first();

        if($saller && password_verify($request->password,$saller->psw)){
            session(['email' => $saller->email ]);
            return redirect('/saller');
        }
        else{
            return redirect()->back()->with('error','Invalidate Credentials');
        }
    }
    function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'address' => 'required|string|max:250',
            'phone_number' => 'required|max:10|string',
            'email' => 'required|string|email|max:50|unique:sallers',
            'profile_pic'=>  'required',
            'password' => 'required|string|confirmed|min:8'
        ]);
        $imageName = time().'.'.$request->profile_pic->extension();
        $request->profile_pic->move(public_path('saller_pp'), $imageName);

        $saller = new Saller();
        $saller->name = $request->name;
        $saller->address = $request->address;
        $saller->email = $request->email;
        $saller->phone = $request->phone_number;
        $saller->photo = $imageName;
        $saller->psw =  bcrypt($request->password);
        $saller->save();
        
        return redirect('/saller')->with('success', 'User created successfully.');
        // return redirect()->route('users.create')->with('success', 'User created successfully.');
    }
    function logout()
    {
        session()->forget('email');
        return redirect('/saller');
    }
}
