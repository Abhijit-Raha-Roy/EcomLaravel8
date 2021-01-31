<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Session;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    function index(){
        $data = Product::all();
        return view('product',['products'=>$data]);
    }

    function productinsert(){
        return view('productinsert');
    }

    public function productsave(Request $request){
        // dd($request->all());
        
        $product = new Product();
    

        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->category = $request->input('category');
        $product->description = $request->input('description');
        
       
        if ($request->hasFile('image')) {
           
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            
            $file->move('uploads/gallery/', $filename);

//see above line.. path is set.(uploads/gallery/..)->which goes to public->then create
//a folder->upload and gallery, and it wil store the images in your file.

            $product->image = $filename;
        } else {
            $product->image = '';
        }
        $product->save();

        

       return redirect('product');
    }

    function detail($id){
        $data = Product::find($id);
        return view('detail',['product'=>$data]);
    }
    function search(Request $req){
       
        $data = Product::
       where('name', 'like' , '%'. $req->input('query').'%')
       ->get();
       return view('search',['product'=>$data]);
    }

    function addToCart(Request $req){
       if($req->session()->has('user'))
       {
        $cart = new Cart;
        $cart->user_id = $req->session()->get('user')['id'];
        $cart->product_id = $req->product_id;
        $cart->save();
        return redirect('/');
       }
       else{
           return redirect('/login');
       }
    }

    static function cartItem(){
        $userID = Session::get('user')['id'];
        return Cart::where('user_id',$userID)->count();
    }

    function cartlist(){
        $userID = Session::get('user')['id'];
        $products = DB::table('cart')
        ->join('products','cart.product_id','=','products.id')
        ->where('cart.user_id',$userID)
        ->select('products.*','cart.id as cart_id')
        ->get();
        return view('cartlist',['products'=>$products]);
    }

    function removecart($id){
        Cart::destroy($id);
        return redirect('cartlist');
    }


    function ordernow(){
        $userID = Session::get('user')['id'];
        $total = DB::table('cart')
        ->join('products','cart.product_id','=','products.id')
        ->where('cart.user_id',$userID)
        ->select('products.*','cart.id as cart_id')
        ->sum('products.price');
        return view('ordernow',['total'=>$total]);
    }

    function orderplace(Request $req){
        $userID = Session::get('user')['id'];
        $allcart = Cart::where('user_id',$userID)->get();
        foreach($allcart as $cart){
            $order= new Order;
            $order->product_id=$cart['product_id'];
            $order->user_id=$cart['user_id'];
            $order->status="pending";
            $order->payment_method=$req->payment;
            $order->payment_status="pending";
            $order->address=$req->address;
            $order->save();
            Cart::where('user_id',$userID)->delete(); 
          
        }
        return redirect('/');
    }

    function myorders(){
        $userID = Session::get('user')['id'];
        $orders= DB::table('orders')
        ->join('products','orders.product_id','=','products.id')
        ->where('orders.user_id',$userID)
        ->get();

        return view('myorders',['orders'=>$orders]);
    }

}
