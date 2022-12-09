<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{

    public function index()
    {
        return Category::all();
    }

    public function store()
    {
        $validator = validator(request()->all(), [
            "name" => "required",
        ]);

        if($validator->fails())
            return response($validator->errors()->all(), 400);

        $category = new Category;
        $category->name = request()->name;
        $category->save();

        return $category;
    }

    public function show($id)
    {
        return Category::find($id);
    }

    public function update($id)
    {
        $validator = validator(request()->all(), [
            "name" => "required",
        ]);

        if($validator->fails())
            return response($validator->errors()->all(), 400);

        $category = Category::find($id);
        $category->name = request()->name;
        $category->save();

        return $category;
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return $category;
    }
}
