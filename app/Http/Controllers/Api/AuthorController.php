<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\ResponseHelper;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors =  Author::all();
        return ResponseHelper::success(' جميع المؤلفين', $authors);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|max:50|unique:authors'
        ]);
        $author = new Author();
        $author->name = $request->name;
        $author->save();
        return ResponseHelper::success("تمت إضافة المؤلف", $author);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => "required|max:50|unique:authors,name,$id"
        ]);

        $author = Author::find($id);
        $author->name = $request->name;
        $author->save();
        return ResponseHelper::success("تم تعديل اسم المؤلف", $author);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $author = Author::find($id);
        $author->delete();
        return ResponseHelper::success("تم حذف المؤلف", $author);
    }
}
