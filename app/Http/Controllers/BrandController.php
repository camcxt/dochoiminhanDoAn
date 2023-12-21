<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Alert;

class BrandController extends Controller
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;
    public $test = 'Tôi là test';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //all category
        $categories = Category::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();

        //all brand
        $brands = Brand::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();

        //all brand
        $brandList = Brand::where('active', '<', self::STATUS_DELETED)->orderBy('sort_order', 'ASC')->paginate(10);

        return view('admin/brands/show', compact('brands', 'categories', 'brandList'));
    }

    public function test()
    {
        return redirect()->route('homeAdmin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //all category
        $categories = Category::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();

        //all brand
        $brands = Brand::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();

        return view('admin/brands/add', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:brands',
            'link' => 'required',
            'sortOrder' => 'required|numeric'
        ], [
            'name.required' => 'Tên thương hiệu chưa được nhập',
            'name.unique' => 'Tên thương hiệu đã tồn tại',
            'link.required' => 'Liên kế chưa được nhập',
            'sortOrder.numeric' => 'Thứ tự sắp xếp phải là số',
            'sortOrder.required' => 'Thứ tự sắp xếp chưa được nhập'
        ]);

        $imageName = "";

        if ($request->has('imageUrl')) {
            $image = $request->file('imageUrl');
            $imageName = $image->getClientOriginalName();
            $image->move('images',  $imageName);
        } else {
            $imageName = "no-image.png";
        }

        //add data
        $data = [
            'name' => $request->name,
            'image_url' => $imageName,
            'link' => $request->link,
            'sort_order' => $request->sortOrder,
            'active' => $request->acTive
        ];

        // Create Brand
        $brand = Brand::create($data);

        session()->flash('messageAdd', $brand->name . ' Thêm thương hiệu thành công.');
        return redirect()->route('showBrand');
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
        // all category
        $categories = Category::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->paginate(10);

        //all brand
        $brands = Brand::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->paginate(10);

        //find brand
        $brand = Brand::find($id);

        //check brand exist
        if (!isset($brand->id)) {
            return view('error');
        }

        return view('admin/brands/update', compact('brands', 'categories', 'brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'sortOrder' => 'required|numeric',
            'link' => 'required'
        ], [
            'name.required' => 'Tên thương hiệu chưa được nhập',
            'link.required' => 'Liên kế chưa được nhập',
            'sortOrder.numeric' => 'Thứ tự sắp xếp phải là số',
            'sortOrder.required' => 'Thứ tự sắp xếp chưa được nhập'
        ]);

        $imageName = "";

        //check image exist
        if ($request->has('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move('images',  $imageName);
        } else {
            $imageName = $request->imageOld;;
        }

        // Brand
        $brand = Brand::find($id);

        //update Brand
        $brand->name = $request->name;
        $brand->image_url = $imageName;
        $brand->link = $request->link;
        $brand->sort_order = $request->sortOrder;
        $brand->active = $request->acTive;

        //save Brand
        $brand->save();

        session()->flash('messageDelete', $brand->name . ' Cập nhật thương hiệu thành công.');
        return redirect()->route('showBrand');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find brand
        $brand = Brand::find($id);

        //check brand exist
        if (!isset($brand->id)) {
            return view('error');
        }

        $products = Product::where('brand_id', $brand->id)->get()->count();

        if (empty($products)) {
            // update active
            $brand->active = self::STATUS_DELETED;

            // save brand
            $brand->save();

            session()->flash('messageDelete', $brand->name . ' Xóa thương hiệu thành công.');
        } else {
            session()->flash('messageError', $brand->name . ' Xóa thương hiệu không thành công.');
        }
        return redirect()->route('showBrand');
    }

    public function active(Request $request)
    {
        //find Brand
        $brand = Brand::find($request->id);

        //update active Brand
        $brand->active = $request->status;

        //save Brand
        $brand->save();

        echo ($request->status);
    }
}