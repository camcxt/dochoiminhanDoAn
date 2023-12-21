<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\User;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;
    const PER_PAGE = 10;
    const PER_PAGE_FRONT = 12;

    public function index()
    {
        $users = User::where('active', self::STATUS_ACTIVE)->where('permission', '=', self::STATUS_ACTIVE)->paginate(10);
        $guest = User::where('active', self::STATUS_ACTIVE)->where('permission', '=', self::STATUS_DELETED)->paginate(10);
        return view('admin/user/show', compact('users','guest'));
    }

    public function create()
    {
        $categories = Category::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();
        $brands = Brand::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();

        return view('admin/user/add', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:brands',
            'email' => 'required|unique:users|email|string',
            'password' => 'required|min:8',
            'phone' => 'required|numeric'
        ], [
            'name.required' => 'Tên nhân viên chưa được nhập',
            'email.unique' => 'Email đã tồn tại',
            'email.required' => 'Email chưa được nhập',
            'phone.numeric' => 'Số điện thoại chưa nhập đúng định dạnh',
            'phone.required' => 'Số điện thoại chưa được nhập'
        ]);

        $data = [
            'username' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'permission' => self::STATUS_ACTIVE,
            'active' => self::STATUS_ACTIVE
        ];

        $staff = User::create($data);

        session()->flash('messageAdd', $staff->username . ' Thêm thành công.');
        return redirect()->route('indexUser');
    }

    public function edit($id)
    {
        // Get all Category
        $categories = Category::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();

        // Get all Brand
        $brands = Brand::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();

        // Get Staff
        $staff = User::find($id);

        return view('admin/user/update', compact('brands', 'categories', 'staff'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:brands',
            'email' => 'required|email|string',
            'phone' => 'required|numeric'
        ], [
            'name.required' => 'Tên nhân viên chưa được nhập',
            'email.required' => 'Email chưa được nhập',
            'phone.numeric' => 'Số điện thoại chưa nhập đúng định dạnh',
            'phone.required' => 'Số điện thoại chưa được nhập'
        ]);

        // Brand
        $staff = User::find($id);

        //update Brand
        $staff->username = $request->name;
        $staff->phone = $request->phone;
        $staff->email = $request->email;

        //save Brand
        $staff->save();

        session()->flash('messageUpdate', $staff->name . ' Cập nhật thành công.');
        return redirect()->route('indexUser');
    }

    public function destroy($id)
    {
        $staff = User::find($id);

        //Check exist
        if (!isset($staff->id)) {
            return view('error');
        }

        $staff->delete();
        session()->flash('messageDelete', $staff->name . ' Xóa thành công .');
        return redirect()->route('indexUser');
    }
    public function destroyGuest($id)
    {
        $guest = User::find($id);
        $order = Order::where('user_id', $guest->id)->where('status', self::STATUS_INACTIVE)->get()->count();
        //Check exist
        if (!isset($guest->id)) {
            return view('error');
        }
// dd($order);
        if (empty($order)) {
            // update active
            $guest->active = self::STATUS_DELETED;
            // save guest
            $guest->save();
            // $guest->delete();
            session()->flash('messageDelete', $guest->name . ' Xóa thành công.');
        } else {
            session()->flash('messageError', $guest->name . ' Xóa không thành công.');
        }
        return redirect()->route('indexUser');
    }
}
