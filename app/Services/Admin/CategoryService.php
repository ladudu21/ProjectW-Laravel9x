<?php

namespace App\Services\Admin;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryService
{
    /*
    *Lấy danh sách các danh mục
    */
    public function getAll()
    {
        return Category::orderby('id')
            ->simplePaginate(10);
    }

    /*
    *Lấy danh sách các danh mục trừ danh mục hiện tại
    */
    public function getAvailCategories($id)
    {
        return Category::where('id', '!=', $id)->get();
    }

    /*
    *Cập nhật danh mục
    */
    function update($request, $category)
    {       
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        return $category->update($data);
    }
    
    /*
    *Thêm danh mục
    */
    function create($request)
    {   
        $data = $request->except('_token');
        $data['slug'] = Str::slug($request->name);
        return Category::create($data);
    }

    /*
    *Xóa danh mục
    */
    function delete($category)
    {   
        try {
            Category::where('parent_id', $category->id)->delete();
            $category->delete();
            return "Thành công";
        } catch (\Throwable $e) {
            return "Thất bại";
        }
    }
}
