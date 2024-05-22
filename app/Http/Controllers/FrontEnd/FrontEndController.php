<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionItem;
use App\Http\Controllers\Controller;
use Midtrans\Config;
use Midtrans\Snap;

class FrontEndController extends Controller
{
    public function index()
    {
        $category = Category::select('id', 'name', 'slug')->latest()->get();
        $product = Product::with('product_galleries')->select('id', 'name', 'slug', 'price')->latest()->limit(8)->get();

        return view('pages.frontend.index', compact(
            'category',
            'product'
        ));
    }

    public function detailProduct($slug)
    {
        $category = Category::select('id', 'name', 'slug')->latest()->get();
        $product = Product::with('product_galleries')->where('slug', $slug)->first();

        $recommendation = Product::with('product_galleries')->select('id', 'name', 'slug', 'price')->inRandomOrder()->limit(4)->get();

        return view('pages.frontend.detail-product', compact(
            'product',
            'category',
            'recommendation',
        ));
    }

    public function detailCategory($slug)
    {
        $category = Category::select('id', 'name', 'slug')->get();
        $categories = Category::where('slug', $slug)->first();

        if ($categories === null) {
            return redirect()->route('home')->with('error', 'Category not found.');
        }

        $product = Product::with('product_galleries')->where('category_id', $categories->id)->latest()->get();

        return view('pages.frontend.detail-category', compact(
            'categories',
            'category',
            'product'
        ));
    }


    public function cart()
    {
        $category = Category::select('id', 'name', 'slug')->latest()->get();
        $cart = Cart::with('product')->where('user_id', auth()->user()->id)->get();

        return view('pages.frontend.cart', compact(
            'category',
            'cart'
        ));
    }

    public function addToCart(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);

            Cart::create([
                'product_id' => $id,
                'user_id' => auth()->user()->id,
            ]);

            return redirect()->route('cart')->with('success', 'Product added to cart successfully!');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'An error occurred while adding the product to the cart.');
        }
    }

    public function deleteCart($id)
    {
        try {
            $cart = Cart::where('id', $id)->where('user_id', auth()->user()->id)->firstOrFail();
            $cart->delete();

            return redirect()->route('cart')->with('success', 'Product removed from cart successfully!');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'An error occurred while removing the product from the cart.');
        }
    }

    public function checkout(Request $request)
{
    try {
        // request data
        $data = $request->all();

        // get data cart user
        $cart = Cart::with('product')->where('user_id', auth()->user()->id)->get();

        // create transaction
        $transaction = Transaction::create([
            'user_id' => auth()->user()->id,
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'total_price' => $cart->sum('product.price'),
        ]);

        // create transaction item
        foreach ($cart as $item) {
            TransactionItem::create([
                'user_id' => auth()->user()->id,
                'product_id' => $item->product_id,
                'transaction_id' => $transaction->id,
            ]);
        }

        // delete cart
        Cart::where('user_id', auth()->user()->id)->delete();

        // setting midtrans
        Config::$serverKey = config('services.midtrans.serverkey');
        Config::$clientKey = config('services.midtrans.clientkey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // setup variable midtrans
        $midtrans = [
            'transaction_details' => [
                'order_id' => 'AZRIEL' . $transaction->id,
                'gross_amount' => (int) $transaction->total_price 
            ],
            'customer_details' => [
                'first_name' => $transaction->name,
                'email' => $transaction->email,
                'phone' => $transaction->phone,
            ],
            'enable_payments' => ['gopay', 'bank_transfer'],
            'vtweb' => []    
        ];

        
        $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

        $transaction->update([
            'payment_url' => $paymentUrl
        ]);

        return redirect($paymentUrl);

    } catch (\Exception $e) {
        dd($e->getMessage()); 
        return redirect()->back()->with('error', 'An error occurred during checkout.');
    }
}

}
