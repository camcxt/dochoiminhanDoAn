<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Product;
use App\Models\Brand;
use GuzzleHttp\Handler\Proxy;
use Symfony\Component\Process\Process;

class CartController extends Controller
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;
    const PER_PAGE = 10;
    const PER_PAGE_FRONT = 12;


    public function add_cart(Request $request)
    {
        $dataCart = [
            'id' => $request->product_id,
            'qty' => $request->quantity,
            'name' => $request->product_name,
            'price' => $request->product_price,
            'weight' => '12',
            'options' => ['image' => $request->product_image]
        ];    
        $product = Product::find($request->product_id);
        if ($product->amount<1) {
            return redirect()->back()->with('success', 'hết hàng!');
        }elseif($product->amount < $request->quantity){
            return redirect()->back()->with('success', 'Không đủ số lượng sản phẩm! sản phẩm còn '.$product->amount);
        }else{
            Cart::add($dataCart);
        }
        return redirect()->route('show_Cart');
    }
    

    public function show_cart(Request $request)
    {
        $totalMoney = 0;
        $quantity = 0;
        $products = [];
        if (isset($request->search)) {
            $products = Product::where('active', self::STATUS_ACTIVE)->where('name', 'like', '%' . $request->search . '%')->orderBy('sort_order', 'ASC')->paginate(3);
        } else {
            $products = Product::where('active', self::STATUS_ACTIVE)->where('sort_order', '=', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->paginate(3);
        }
        $carts = Cart::content();

        foreach ($carts as $keyCart => $cartData) {
            $totalMoney +=  $cartData->price * $cartData->qty;
            $quantity += $cartData->qty;
        }

        return view('web/cart/show', compact('carts', 'products'))->with('totalMoney', $totalMoney)->with('quantity', $quantity);
    }

    public function show()
    {
        $carts = Cart::content();
        return response()->json(['carts' => $carts]);
    }

    public function delete_cart($rowId)
    {
        $cart = Cart::get($rowId);

        Cart::remove($rowId);

        $carts = Cart::content();

        return response()->json(['carts' => $carts]);
    }

    // update nhiều bản ghi
    public function update_quantity(Request $request)
    {
        $newQuantity = 0;
        $messError = "";

        $cart = Cart::get($request->rowId);
        $newQuantity = $request->quantity;
        Cart::update($request->rowId, $newQuantity);
        $carts = Cart::content();

        return response()->json(['carts' => $carts, 'messError' => $messError]);
    }

    // update số lượng
    public function quantityUpdate(Request $request)
    {
        $newQuantity = 0;
        $messError = "";

        $cart = Cart::get($request->rowId);

        $product = Product::find($cart->id);

        if (isset($cart)) {
            if ($request->status == "minusCart") {
                $newQuantity = $cart->qty - 1;
            } else {
                $newQuantity = $cart->qty + 1;
                if ($newQuantity > $product->amount) {
                    $messError = "Không đủ số lượng sản phẩm";
                    $newQuantity = $product->amount;
                }
            }
            Cart::update($request->rowId, $newQuantity);
        }
        $carts = Cart::content();
        
        return response()->json(['carts' => $carts, 'messError'=>$messError]);
    }
}