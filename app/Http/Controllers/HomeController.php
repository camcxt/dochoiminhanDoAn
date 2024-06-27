<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Brand;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_CANCEL= 2;
    const STATUS_DELETED = 2;
    const PER_PAGE = 10;
    const PER_PAGE_FRONT = 12;
    /**
     * Create a new controller instance.
     *
     * @return void
     */



    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalMoney = 0;
        $quantity = 0;

        $carts = Cart::content();
        foreach ($carts as $keyCart => $cartData) {
            $totalMoney +=  $cartData->price * $cartData->qty;
            $quantity += $cartData->qty;
        }
        $banners = Banner::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();
        $best_sell = Product::where('active', self::STATUS_ACTIVE)->where('is_best_sell', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->paginate(3);
        $new = Product::where('active', self::STATUS_ACTIVE)->where('is_new', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();
        $products = Product::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();
        $order = Order_item::groupBy('product_name')->groupBy('product_id')->select('product_name', 'product_id','product_image','product_price', Order_item::raw('sum(product_quantity) as total'))->orderBy('total', 'desc')->paginate(10);
        $productsell = DB::select('SELECT DISTINCT order_items.product_id, products.category_id, products.brand_id, products.name, products.image, products.price,products.old_price, products.description, products.amount,products.sort_order FROM `products` JOIN `order_items` ON products.id = order_items.product_id');
        $productsale = Product::where('active', self::STATUS_ACTIVE)->whereNotNull('old_price')->orderBy('id', 'DESC')->get();

        return view('home', compact('productsell','productsale','order','banners','products','best_sell','new'))->with('totalMoney', $totalMoney)->with('quantity', $quantity);

    }


    public function home(Request $request)
    {
        $totalOrder = Order::orderBy('id')->select('id')->count();
        $totalOrderComplete = Order::where('status', self::STATUS_ACTIVE)->orderBy('id')->select('id')->count();
        $totalOrderCancel = Order::where('status', self::STATUS_CANCEL)->orderBy('id')->select('id')->count();
        $totalOrderInactive = Order::where('status', self::STATUS_INACTIVE)->orderBy('id')->select('id')->count();
        // dd($totalOrderInactive);
        // Tổng mặt hàng
        $totalProduct = Product::orderBy('id')->select('id')->count();
        // Tổng số nhân viên
        $totalUser = User::where('permission', 1)->orderBy('id')->select('id')->count();
        $bestSale = Order_item::select('order_id', 'product_name', 'product_id', 'product_image', 'product_price', DB::raw('sum(product_quantity) as total'))
        ->where('status', 3)
        ->groupBy('order_id', 'product_name', 'product_id', 'product_image', 'product_price')
        ->having('total', '>=', 1)
        ->orderBy('total', 'desc')
        ->paginate(10);

        $month =$request->month;
        if (!isset($month)) {
            $topProductSale = DB::table('orders')
            ->select(DB::raw('MONTH(created_date) as month'), 'id')
            ->whereBetween('created_date', [now()->subMonths(1), now()])
            ->groupBy('month', 'id')
            ->orderByDesc('month')
            ->limit(10)
            ->get();
        }else{
            $topProductSale = DB::table('orders')
            ->select(DB::raw('MONTH(created_date) as month'), 'id')
            ->whereBetween('created_date', [now()->subMonths($month), now()])
            ->groupBy('month', 'id')
            ->orderByDesc('month')
            ->limit(10)
            ->get();
        }

        $orderData = Order::orderBy('total_money','DESC')->paginate(10);

        $viewData =[
            'totalOrder' => $totalOrder,
            'totalOrderCancel' => $totalOrderCancel,
            'totalOrderInactive' => $totalOrderInactive,
            'totalOrderComplete' => $totalOrderComplete,
            'totalUser' => $totalUser,
            'totalProduct'=> $totalProduct,

        ];
        return view('admin/home', compact('month','bestSale', 'topProductSale', 'orderData'), $viewData);
    }
}