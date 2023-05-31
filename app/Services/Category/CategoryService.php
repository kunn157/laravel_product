<?php

namespace App\Services\Category;

use App\Models\Category;;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\Category\CreateCategory;
use Log;
class CategoryService
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Category::class;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategory(){
        $categories  = Category ::Select('id', 'name', 'parent_id')->paginate(15);
       return $categories;
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createCategory()
    {
        $categories = Category::select('id', 'name', 'parent_id')-> where('parent_id',null)->get();
        return $categories;
    }
     /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Category\CreateCategory;  $request
     * @return App\Http\Requests\Category\CreateCategory;
     */
    public function storeCategory(CreateCategory $request)
    {
        DB::beginTransaction();
        try {
            $categories = Category::create([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
            ]);
            DB::commit();
            return true;
        }catch (\Exception $e) {
            DDB::rollBack();
            Log::error("Message: {$exception->getMessage()}. Line: {$exception->getLine()}");
            return false;
        }
    }
     /**
     * Update the specified resource in storage.
     *
     * @param  use\App\Http\Requests\Category\CreateCategory; $request
     * @param  \App\Models\Category
     * @return \Illuminate\Http\Response
     */
    public function updateCategory(Request $request, Category $category)
    {
        DB::beginTransaction();
        try {
            $category->update([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
            ]);
            DB::commit();
            return true;
        }catch (\Exception $e) {
            DDB::rollBack();
            Log::error("Message: {$exception->getMessage()}. Line: {$exception->getLine()}");
            return false;
        }
    }
     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function deleteCategory(Category $category)
    {
        DB::beginTransaction();
        try {
            $category->delete();
            DB::commit();
            return response(__("messages.deleteSuccess"), Response::HTTP_OK);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Delete category failed');
        }
    }
}

