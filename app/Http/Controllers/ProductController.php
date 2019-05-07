<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\Order;
use App\ProductOrder;
use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use Auth;
use Stripe\Charge;
use Stripe\Stripe;

class ProductController extends Controller
{

    // Api

    public function api_getAll()
    {
        $products = Product::all();
        $response = [
            'products' => $products
        ];
        return response()->json($response, 200);
    }



    public function api_addProduct(Request $request)
    {
        $user = JWTAuth::parseToken()->toUser();
        // This code is not needed when using the auth.jwt middleware!
//        if (!$user = JWTAuth::parseToken()->authenticate()) {
//            return response()->json(['error' => 'Authentication failed'], 404);
//        }
        $product = new Product();
        $product->content = $request->input('content');
        $product->save();
        return response()->json(['product' => $product, 'user' => $user], 201);
    }
   
    public function api_putProduct(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Document not found'], 404);
        }
        $product->content = $request->input('content');
        $product->save();
        return response()->json(['product' => $product], 200);
    }
    public function api_deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json(['message' => 'product deleted'], 200);
    }


  // end API


    //website
    

    public function getIndex()
    {
        $products = Product::all();
        return view('shop.index', ['products' => $products]);
    }

    public function getAddToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        return redirect()->route('product.index');
    }

    public function getReduceByOne($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return redirect()->route('product.shoppingCart');
    }

    public function getRemoveItem($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->route('product.shoppingCart');
    }

    public function getCart()
    {
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shop.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function getCheckout()
    {
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('shop.checkout', ['total' => $total]);
    }

    public function postCheckout(Request $request)
    {
        if (!Session::has('cart')) {
            return redirect()->route('shop.shoppingCart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        Stripe::setApiKey('sk_test_uPLRzeCSmpVvI9o7BOkDQOTj00RdYStifJ');
        try {
            $charge = Charge::create(array(
                "amount" => $cart->totalPrice * 100,
                "currency" => "usd",
                "source" => $request->input('stripeToken'), // obtained with Stripe.js
                "description" => "Test Charge"
            ));
            $order = new Order();
            //$order->cart = serialize($cart);
            $order->address = $request->input('address');
            $order->name = $request->input('name');
            $order->payment_id = $charge->id;
            
            Auth::user()->orders()->save($order);
            
          
             foreach ($cart->items as $product) {

                $added = new ProductOrder([
                    'order_id' => $order->id,
                    'product_id' => $product['item']['id'],
                    'quantity' => $product['qty'],
                ]);
                 
                $added->save();
            } 


        } catch (\Exception $e) {
            return redirect()->route('checkout')->with('error', $e->getMessage());
        }

        Session::forget('cart');
        return redirect()->route('product.index')->with('success', 'Successfully purchased products!');
    }
}
