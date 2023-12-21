<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Product;

class CategoryController extends Controller
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;
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

        //all category
        $categoryList = Category::where('active', '<', self::STATUS_DELETED)->orderBy('sort_order', 'ASC')->get();

        return view('admin/category/show', compact('categoryList', 'categories', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // all category
        $categories = Category::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();

        // all brand
        $brands = Brand::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();

        return view('admin/category/add', compact('categories', 'brands'));
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
            'name' => 'required|unique:categories',
            'sortOrder' => 'required|numeric'
        ], [
            'name.required' => 'Tên danh mục chưa được nhập',
            'name.unique' => 'Tên danh mục đã tồn tại',
            'sortOrder.numeric' => 'Thứ tự sắp xếp phải là số',
            'sortOrder.required' => 'Thứ tự sắp xếp chưa được nhập'
        ]);

        // add data
        $data = [
            'name' => $request->name,
            'sort_order' => $request->sortOrder,
            'active' => $request->acTive
        ];

        // create category
        $category = Category::create($data);

        session()->flash('messageAdd', $category->name.' Thêm danh mục thành công.');
        return redirect()->route('showCate');
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
        // Get all Category
        $categories = Category::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();

        // Get all Brand
        $brands = Brand::where('active', self::STATUS_ACTIVE)->orderBy('sort_order', 'ASC')->get();

        // Get Category
        $category = Category::find($id);

        //Check exist
        if (!isset($category->id)) {
            return view('error');
        }

        return view('admin/category/update', compact('category', 'categories', 'brands'));
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
        // validatation data
        $request->validate([
            'name' => 'required',
            'sortOrder' => 'required|numeric'
        ], [
            'name.required' => 'Tên danh mục chưa được nhập',
            'sortOrder.numeric' => 'Thứ tự sắp xếp phải là số',
            'sortOrder.required' => 'Thứ tự sắp xếp chưa được nhập'
        ]);

        // Category
        $category = Category::find($id);

        // update category
        $category->name = $request->name;
        $category->sort_order = $request->sortOrder;
        $category->active = $request->acTive;

        // save category
        $category->save();

        session()->flash('messageUpdate', $category->name.' Cập nhật danh mục thành công.');
        return redirect()->route('showCate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find category
        $category = Category::find($id);

        //Check exist
        if (!isset($category->id)) {
            return view('error');
        }

        $products = Product::where('category_id', $category->id)->get()->count();

        if (empty($products)) {
            // update active
            $category->active = self::STATUS_DELETED;

            // save category
            $category->save();

            session()->flash('messageDelete', $category->name.' Xóa danh mục thành công.');
        } else {
            session()->flash('messageError', $category->name.' Xóa danh mục không thành công.');
        }
        
        return redirect()->route('showCate');
    }

    public function active(Request $request)
    {
        // find category
        $category = Category::find($request->id);

        // update category
        $category->active = $request->status;

        // save category
        $category->save();
        echo ($request->status);
    }
}
