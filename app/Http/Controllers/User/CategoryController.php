<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Response;
use App\Http\Requests\Category\CreateCategory;
use App\Services\Category\CategoryService;
class CategoryController extends Controller
{
     /**
     * Instantiate a new CategoryService instance.
     */
    public function __construct(CategoryService $categoryService) {
        $this -> categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this -> categoryService -> getCategory();
        return view('user.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this -> categoryService -> createCategory();
        return view('user.category.create',compact('categories'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Category\CreateCategory;  $request
     * @return App\Http\Requests\Category\CreateCategory;
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategory $request)
    {
        try {
            $result = $this->categoryService->storeCategory($request);
            if($result){
                return redirect()->route('category.index') ->with('success', __("messages.createSuccess"));
            }else{
                return back()->with('error', __('Failed to Add Category'));
            }
        }catch (\Exception $exception){
            Log::error("Message: {$exception->getMessage()}. Line: {$exception->getLine()}");
        }

    }

    /**
     * Show the form for editing the specified resource.
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category  $category)
    {
        $categories = $this -> categoryService -> createCategory();
        return view ('user.category.edit', compact('category','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Requests $request
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
        try {
            $result = $this->categoryService->updateCategory($request , $category);
            if($result){
                return redirect()->route('category.index') ->with('success',__("messages.updateSuccess"));
            }else{
                return back()->with('error', __('Failed to Add Category'));
            }
        }catch (\Exception $exception){
            Log::error("Message: {$exception->getMessage()}. Line: {$exception->getLine()}");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
         return $this->categoryService->deleteCategory($category);
    }
}
