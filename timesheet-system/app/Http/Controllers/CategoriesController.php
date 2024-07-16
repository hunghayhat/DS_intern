<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function __construct()
    {
        
    }
    //Hiển thị danh sách chuyên mục
    public function index() {
       return view('clients/categories/list');
    }

    // Lấy ra 1 chuyên mục theo id (phương thức GET)
    public function getCategory ($id){
        return 'Chi tiết chuyên mục '.$id;
    }

    //Show form thêm dữ liệu (Phương thức get)
    public function addCategory(){
        return view('clients/categories/add');
    }

    //Cập nhật 1 chuyên mục
    public function updateCategory($id) {
        return view('clients/categories/edit');
    }

    //Thêm dữ liệu vào chuyên mục (Phương thức post)
    public function handleAddCategory(){

    }

    //Xoá dữ liệu
    public function deleteCategory(){

    }
}
