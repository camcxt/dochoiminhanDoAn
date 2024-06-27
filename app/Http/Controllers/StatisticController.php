<?php

namespace App\Http\Controllers;

use App\Constants\Constants;
use App\Models\Order;
use App\Models\Order_item;
use App\Helpers\Date;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use function GuzzleHttp\Promise\all;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class StatisticController extends Controller
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_CANCEL = 2;

    function index(Request $request)
    {

        $totalMoneyProduct = 0;

        $orderBestSell = Order_item::select('order_id', 'product_name', 'product_id', 'product_image', 'product_price', DB::raw('sum(product_quantity) as total'))
            ->where('status', 3)
            ->groupBy('order_id', 'product_name', 'product_id', 'product_image', 'product_price')
            ->having('total', '>=', 1)
            ->orderBy('total', 'desc')
            ->paginate(10);

        //Tổng đơn hàng
        $totalOrder = Order::orderBy('id')->select('id')->count();
        $totalOrderComplete = Order::where('status', self::STATUS_ACTIVE)->orderBy('id')->select('id')->count();
        $totalOrderCancel = Order::where('status', self::STATUS_CANCEL)->orderBy('id')->select('id')->count();
        $totalOrderInactive = Order::where('status', self::STATUS_INACTIVE)->orderBy('id')->select('id')->count();
        // dd($totalOrderInactive);
        // Tổng mặt hàng
        $totalProduct = Product::orderBy('id')->select('id')->count();
        // Tổng số nhân viên
        $totalUser = User::where('permission', 1)->orderBy('id')->select('id')->count();

        // Lấy danh sách doanh thu
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $endDate1 = Carbon::parse($endDate)->addDay();
        $sales = Order::whereBetween('created_date', [$startDate, $endDate1])->where('status', self::STATUS_ACTIVE)->select(Order::raw('sum(total_money) as totalMoney'), Order::raw('sum(total_money) as totalMoney'), Order::raw('sum(total_products) as totalProducts'), Order::raw('DATE(created_date) as day'))->groupBy('day')->get();
        foreach ($sales as $value) {
            $totalMoneyProduct += $value->totalMoney;
        }

        $items = Order_item::Where('status', Constants::PAID)->get();
        // Tạo mảng dữ liệu để vẽ biểu đồ
        $revenueData = [];
        $currentDate = Carbon::parse($startDate);

        while ($currentDate->lte(Carbon::parse($endDate))) {
            $dailyRevenue = Order::where('status', self::STATUS_ACTIVE)->whereDate('created_date', $currentDate->format('Y-m-d'))->sum('total_money');
            $revenueData[$currentDate->format('Y-m-d')] = $dailyRevenue;
            $currentDate->addDay();
        }

        // số lượng sản phẩm
        $products = Product::where('status', self::STATUS_ACTIVE);
        $topProducts = Product::orderBy('amount', 'desc')->take(10)->get();
        $productCounts = $topProducts->pluck('amount', 'name');
        $outOfStockProduct = Product::where('amount', 0)->orderBy('amount')->get();

        $viewData = [
            'totalOrder' => $totalOrder,
            'totalOrderCancel' => $totalOrderCancel,
            'totalOrderInactive' => $totalOrderInactive,
            'totalOrderComplete' => $totalOrderComplete,
            'totalUser' => $totalUser,
            'totalProduct' => $totalProduct,
            'orderBestSell' => $orderBestSell,
            'items' => $items,
            'totalMoneyProduct' => $totalMoneyProduct,
            'topProducts' => $topProducts,
            'outOfStockProduct' => $outOfStockProduct,

        ];
        return view('admin/statistic/statistics', compact('sales', 'revenueData', 'productCounts'), $viewData);
    }
    public function export(Request $request)
    {
        // Lấy danh sách doanh thu
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $endDate1 = Carbon::parse($endDate)->addDay();
        $sales = Order::whereBetween('created_date', [$startDate, $endDate1])->where('status', self::STATUS_ACTIVE)->select(Order::raw('sum(total_money) as totalMoney'), Order::raw('sum(total_money) as totalMoney'), Order::raw('sum(total_products) as totalProducts'), Order::raw('DATE(created_date) as day'))->groupBy('day')->get();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $i = 3;


        $styleArrayTitle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'ffffff'], // White font color
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THICK,
                    'color' => ['rgb' => '1c1e21'],
                ],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => '2ed87a'],
            ],
        ];

        $styleArray = [
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THICK,
                    'color' => ['rgb' => '1c1e21'],
                ],
            ],
        ];

        $sheet->setCellValue("D3", "Ngày bán");
        $sheet->setCellValue("E3", "Số lượng");
        $sheet->setCellValue("F3", "Tổng tiền");

        foreach ($sales as $item) {
            $i++;

            $column = $i;

            $sheet->setCellValue("D" . $i, $item->day);
            $sheet->setCellValue("E" . $i, $item->totalProducts);
            $sheet->setCellValue("F" . $i, $item->totalMoney);
        }

        $sheet->getStyle('D3:F3')->applyFromArray($styleArrayTitle);
        $sheet->getStyle('D4:F' . $column)->applyFromArray($styleArray);

        for ($row = 3; $row <= $column; $row++) {
            if ($row % 2 == 1) {
                $sheet->getStyle('D' . $row . ':F' . $row)->applyFromArray($styleArrayTitle);
            }
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment;filename=\"sales.xlsx\"");
        header("Cache-Control: max-age=0");
        header("Expires: Fri, 11 Nov 2011 11:11:11 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: cache, must-revalidate");
        header("Pragma: public");
        return $writer->save("php://output");
    }
}
