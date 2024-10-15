<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Orders;
use App\Models\Product_list;
use App\Models\User;
use Carbon\Carbon;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class UserController extends Controller
{
    function forgot(Request $request)
    {
        $request->validate(["email"=>"required|exists:users,email"]);
        $mail = new PHPMailer(true);
        $userMail = $request->email;
        session(["userEmail"=>$userMail]);
        $user = User::where("email",$userMail)->first();
        $userName = $user->name;
        $otp = rand(100000, 999999);
        session(["otp"=>$otp,'expires_at' => now()->addMinutes(10)]);
        $message = "Your otp is ".$otp;

        try 
        {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'connectmypc3@gmail.com';
            $mail->Password   = 'zzhu unml jbpc wfdu'; // Use App Password or correct credentials
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom($userMail, "Pretty Liitle");
            $mail->addAddress($userMail);
            $mail->addReplyTo("noreply@gmail.com", 'Pretty Little');

            $mail->isHTML(false);
            $mail->Subject = 'Do not share';
            $mail->Body    = $message;

            $mail->send();
            
            return redirect("otp_validation"); 
            
        } 
        catch (Exception $e) {
            echo "!!!!!";
        }
        
    }
    public function verify_otp(Request $request)
    {
        // Validate the request
        $request->validate([
            'otp' => 'required|digits:6'
        ]);

        // Check if OTP exists in the session
        if (session("otp") !== null) {
            // Check if the OTP matches
            if ($request->otp == session("otp")) {
                session(["otp_validation"=>true]);
                return redirect("/create_new");
            } else {
                return redirect()->back()->with(['msg' => 'Invalid OTP, try again!']);
            }
        } else {
            return redirect()->back()->with(['msg' => 'OTP has expired']);
        }
    }

    function update_password(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|same:password',
        ]);
        if(session("otp_validation") == true){
        
            $user = User::where("email",session("userEmail"))->first();
            $user->psw = bcrypt($request->password);

            $user->save();

            return redirect("/login")->with(["msg"=>"Udated successfully!"]);
        }
        else{
            return redirect("/login");
        }
    }
    function create_new()
    {
        return view("user.create_new");
    }
    function otp_validation()
    {
        return view("user/otp_conformation");
    }
    function forgot_page()
    {
        return view("user/forgot");
    }
    function cart()
    {
        if(session('useremail'))
        {
            $cartItems = Cart::where('email', session('useremail'))->get();

            // Fetch the products based on the product_ids in the cart
            $productIds = $cartItems->pluck('product_id')->toArray();

            $products = Product_list::whereIn('id', $productIds)->get();

            $user = User::where('email',session('useremail'))->first();
            return view('user/cart',['products'=>$products,'user'=>$user,'cartItems'=>$cartItems]);
        }
        else{
            return view('user/LoginPage');
        }
        
    }
    function addToCart(Request $request)
    {
        $request->validate(['qty'=>'required|string']);

        $cart = Cart::where('email',session('useremail'))->where("product_id",$request->product_id)->get();

        if($cart->count() >0)
        {
            return redirect()->back()->with('error','Item already added to cart.');
        }

        if(session('useremail'))
        {
            $cart = new Cart();
            $cart->email = session('useremail');
            $cart->qty = $request->qty;
            $cart->product_id = $request->product_id;
            $cart->save();

            $cartItemCount = session('cartItemCount');
            $cartItemCount +=1;
            session(['cartItemCount'=>$cartItemCount]);
            return redirect()->back()->with(['msg' => 'Added Sucessfuly.']);
        }
        else{
            return view('user/LoginPage');
        }
    }
    function updateqty(Request $request)
    {
        $cartItem = Cart::where('id',$request->item_id)->first();
        if($cartItem)
        {
            $cartItem->qty = $request->qty;
            $cartItem->save();
            return redirect()->back()->with('success', 'Item updated successfully!');
        }
        else {
            return redirect()->back()->with('error', $request->item_id);
        }
    }
    function deleteItem(Request $request)
    {
        $cartItem = Cart::where('id',$request->item_id)->first();
    
        if ($cartItem) {
            $cartItem->delete();
            if(session('cartItemCount')>0){
                $cartItemCount = session('cartItemCount');
                $cartItemCount -=1;
                session(['cartItemCount'=>$cartItemCount]);
            }
            return redirect()->back()->with('success', 'Item deleted successfully!');
        } else {
            return redirect()->back()->with('error', $request->item_id);
        }
    }
    function orders()
    {
        
        $orders = Orders::where('client_email',session('useremail'))->get();

        $products = [];

        foreach ($orders as $order) {
            $product = Product_list::where('id', $order->product_id)->first();
            if ($product) {
                array_push($products, $product);
            }
        }

        return view('/user/ordered_items',['products'=>$products,"orders"=>$orders]);

    }
    function calcelOrder(Request $request)
    {
        $request->validate(['orderId'=>'required']);

        $orderItem = Orders::where('email',session('useremail'))->where('id',$request->orderId)->first();

        if($orderItem->count())
        {
            $orderItem->delete();
            return redirect()->back()->with(["msg"=>"deleted successfully!"]);
        }
    }
    function addOrder(Request $request)
    {
        if(!session('useremail'))
        {
            return redirect('login');
        }

        if($request->xhzp)
        {
            $request->validate(['xhzp'=>'required']);

            $decodedData = base64_decode($request["?data"]);

            $jsonData = json_decode($decodedData, true);
            $producy_id = base64_decode($request->xhzp);
            $saller_email = Product_list::where('id',$producy_id)->first()->email;
    
            $isExist = Orders::where('uuid',$jsonData["transaction_uuid"])->get();
            if(!$isExist->count()){
    
                $order = new Orders();
                $order->client_email = session('useremail');
                $order->product_id = $producy_id;
                $order->qty = base64_decode($request->lpdb);
                $order->uuid = $jsonData["transaction_uuid"];
                $order->saller_email = $saller_email;
                $order->status = '3 days left';
                $order->delivery_date = date('Y-m-d');
                $order->transaction_detail = $request["?data"];
                $order->save();
                if(session('cartItemCount')>0){
                    $cartItemCount = session('cartItemCount');
                    $cartItemCount -=1;
                    session(['cartItemCount'=>$cartItemCount]);
                }
            }
        }
        else
        {
            $decodedData = base64_decode($request["data"]);

            $jsonData = json_decode($decodedData, true);

            $cartItems = Cart::where('email',session('useremail'))->get();
            foreach($cartItems as $cartItem){
                
                $product = Product_list::where('id',$cartItem->product_id)->first();

                // $isExist = Orders::where('uuid',$jsonData["transaction_uuid"])->get();

                $order = new Orders();
                $order->client_email = session('useremail');
                $order->product_id = $cartItem->product_id;
                $order->qty = $cartItem->qty;
                $order->uuid = $jsonData["transaction_uuid"];
                $order->price = (int)$product->price*(int)$cartItem->qty;
                $order->saller_email = $product->email;
                $order->status = '3 days left';
                $order->delivery_date = Carbon::now()->format('Y-m-d');
                $order->transaction_detail = $request["data"];
                $order->save();

                $cartItem->delete();
            }
            session(["cartItemCount" => 0]);
        }
        $orders = Orders::where('client_email',session('useremail'))->get();

        $products = [];

        foreach ($orders as $order) {
            $product = Product_list::where('id', $order->product_id)->first();
            if ($product) {
                array_push($products, $product);
            }
        }

        return view('/user/ordered_items',['products'=>$products,"orders"=>$orders]);
    }
    function user_profile()
    {
        $user = User::where('email',session('useremail'))->first();
        return view("user/user_profile",['user'=>$user]);
    }
    function edit_profile()
    {
        return view("user/conform_password");
    }

    function conform(Request $request)
    {
        $request->validate(["password"=>"required|string|min:8"]);

        $user = User::where('email', session('useremail'))->first();

        if($user && password_verify($request->password,$user->psw)){
            session(["otp_validation" => true]);
            return redirect("/create_new");
        }
        else{
            return redirect()->back()->with('error','Invalidate Password');
        }
    }
    public function change_password(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Handle successful validation (e.g., updating the password)
        // Add your business logic here

        // Redirect to another page or back with success message
        return redirect()->route('cart')->with('success', 'Password changed successfully.');
    }
    function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'address' => 'required|string',
            'phone_number' => 'required|min:10|max:10|string',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|confirmed|min:8'
        ]);
        

        $user = new User();
        $user->name = $request->name;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->phone = $request->phone_number;

        if($request->profile_pic)
        {
            $imageName = time().'.'.$request->profile_pic->extension();
            $request->profile_pic->move(public_path('User_pp'), $imageName);
            $user->photo = $imageName;
        }

        $user->psw =  bcrypt($request->password);
        $user->save();
        
        return redirect('/cart');
    }
    function loginUser( Request $request)
    {
        $request->validate([
            'email' => 'required|email|string|max:50',
            'password' => 'required|string|min:8'
        ]);
        $user = User::where('email', $request->email)->first();

        if($user && password_verify($request->password,$user->psw)){
            session(['useremail' => $user->email,
                    'cartItemCount'=>Cart::where('email',$user->email)->count()]);
            return redirect('/cart');
        }
        else{
            return redirect()->back()->with('error','Invalidate Credentials');
        }
    }
    function logoutUser(){
        session()->forget('useremail');
        session()->forget('cartItemCount');
        return redirect('/');
    }
}
