<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Province;
use App\Models\District;
use App\Models\Commune;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use App\Http\Requests\CreateUser;
use App\Http\Requests\UpdateUser;
use App\Services\Upload\UploadService;
use App\Services\User\UserService;
use App\Jobs\SendEmail;
class UserController extends Controller
{
    public function __construct( UploadService $uploadService , UserService $userService)
    {
        $this -> uploadService = $uploadService;
        $this -> userService = $userService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->userService->getAll($request);
        return view('admin.User.index', compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = $this -> userService->getProvinces();
        return view('admin.User.create',compact('provinces'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateUser  $
     * @param  \App\Jobs\SendEmail $email
     * @return \App\Http\Requests\CreateUser
     */
    public function store(CreateUser $request)
    {
        try {
            $result = $this->userService->storeUser($request);
            if($result){
                return redirect()->route('users.index')->with('success','Data create successfully');
            }else{
                return back()->with('error', __('Failed to create User'));
            }
        }catch (\Exception $exception){
            Log::error("Message: {$exception->getMessage()}. Line: {$exception->getLine()}");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $provinces = $this -> userService->getProvinces();
        return view('admin.User.edit',compact('provinces', 'user'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUser $request
     * @param  \App\Models\User  $user
     * @param  \App\Jobs\SendEmail $email
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, User $user)
    {
        try {
            $result = $this->userService->updateUser($request,$user);
            if($result){
                return redirect()->route('users.index')->with('success', 'Data updated successfully');
            }else{
                return back()->with('error', __('Failed to Add Product'));
            }
        }catch (\Exception $exception){
            Log::error("Message: {$exception->getMessage()}. Line: {$exception->getLine()}");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
       return $this->userService->deleteUser($user);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\District
     * @return \Illuminate\Http\Response
     */
    public function fatchDistrict(Request $request){
        $data['districts'] = District::where('province_id',$request->province_id)->get(['name','id']);
        return response()->json($data);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commune
     * @return \Illuminate\Http\Response
     */
    public function fatchCommune(Request $request){
        $data['communes'] = Commune::where('district_id',$request->district_id)->get(['name','id']);
        return response()->json($data);
    }
}
