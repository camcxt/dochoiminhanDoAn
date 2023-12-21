<?php

namespace App\Http\Controllers;

use App\Constants\Constants;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\XmlConfiguration\Constant;
use Illuminate\Support\Carbon;

class Order_itemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        DB::beginTransaction();
        try {
            $item = Order_item::find($id);
            $currentDateTime = Carbon::now();

            if ($item) {
                $product = Product::find($item->product_id);
                $order = Order::find($item->order_id);

                if (
                    !$product || $item->status == Constants::IN_ACTIVE && isset($product->amount)
                    && $item->product_quantity > $product->amount
                ) {
                    session()->flash('message-error', 'Số lượng không hợp lệ!');
                    return redirect()->back();
                }

                $newAmount = $product->amount - $item->product_quantity;

                if ($item->status == Constants::IN_ACTIVE) {
                    $product->update(['amount' => $newAmount]);
                    $order->update(['created_date'=> $currentDateTime]);
                }

                $item->update(["status" => ((int)$item->status ?? 0) + 1]);

                if ($item->status == Constants::PAID) {
                    $order->update(['status'=> 1]);
                    $order->update(['created_date'=> $currentDateTime]);
                }

                if ($item->status == Constants::CANCEL) {
                    $order->update(['status'=> 2]);
                    $order->update(['created_date'=> $currentDateTime]);
                }
                DB::commit();
                session()->flash('message', 'Đã cập nhật trạng thái!');
                return redirect()->back();
            } else {
                session()->flash('message-error', 'Không tìm thấy đơn hàng!');
                DB::rollBack();
                return redirect()->back();
            }
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('message-error', 'Lỗi không xác định!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cancel($id)
    {
        DB::beginTransaction();
        try {
            $order = Order_item::find($id);
            $currentDateTime = Carbon::now();
            if ($order) {
                $product = Product::find($order->product_id);

                if ($order->status > Constants::IN_ACTIVE) {
                    $newAmount = ($product->amount ?? 0) + ($order->product_quantity ?? 0);
                    $product->update(['amount' => $newAmount]);
                    $order->update(['created_date'=> $currentDateTime]);
                }

                $order->update(['status' => Constants::CANCEL]);

                DB::commit();
                session()->flash('message', 'Đã hủy đơn hàng!');
                return redirect()->back();
            } else {
                session()->flash('message-error', 'Không tìm thấy đơn hàng!');
                DB::rollBack();
                return redirect()->back();
            }
        } catch (Exception $exception) {
            session()->flash('message-error', 'Lỗi không xác định!');
            DB::rollBack();
            return redirect()->back();
        }
    }
}
