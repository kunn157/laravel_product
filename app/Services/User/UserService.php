<?php

namespace App\Services\User;

use App\Models\User;
use App\Models\Province;
use App\Models\District;
use App\Models\Commune;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Services\Upload\UploadService;
use Log;
use App\Http\Requests\CreateUser;
use App\Http\Requests\UpdateUser;
use Illuminate\Support\Facades\Hash;
use App\Jobs\SendEmail;

class UserService
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return User::class;
    }
    /**
     * Instantiate a new UploadService instance.
     */
    public function __construct( UploadService $uploadService)
    {
        $this -> uploadService = $uploadService;
    }
     /**
     * Handle product management list.
     *
     * @param Request $request
     *
     */
    public function getAll(Request $request)
    {
        $search_users = $request -> search_users;
        $data = User::select([
            'id',
            'user_name',
            'email',
            'birthday',
            'flag_delete'
        ]);
        if ($request -> has('search_users') && !is_null($search_users)){
            $data
            ->Where('user_name', 'like', "%{$search_users}%")
            ->orWhere('email', 'like', "%{$search_users}%")
            ->orWhere('first_name', 'like', "%{$search_users}%")
            ->orWhere('last_name', 'like', "%{$search_users}%");
        }
        $users = $data->where('flag_delete', 0)->paginate(15);
        return $users;
    }
     /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateUser  $
     * @param  \App\Jobs\SendEmail $email
     * @return \App\Http\Requests\CreateUser
     */
    public function storeUser(CreateUser $request)
    {
        DB::beginTransaction();
        try {
        $avatar = $this->uploadService->uploadImg($request);
        $user = User::create([
            'email' => $request->email,
            'user_name' => $request->user_name,
            'birthday' => $request->birthday,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'status' => $request->status,
            'address'=>$request->address,
            'province_id' => $request->province_id,
            'district_id' => $request->district_id,
            'commune_id' => $request->commune_id,
            'avatar'=>$avatar,
            'password' => Hash::make($request['password']),
        ]);
        $mails = array(
            'user' => $user,
            'view' => 'admin.Mails.User.create');
        SendEmail::dispatch($mails);
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
     * @param  \App\Http\Requests\UpdateUser $request
     * @param  \App\Models\User  $user
     * @param  \App\Jobs\SendEmail $email
     * @return \Illuminate\Http\Response
     */
    public function updateUser(UpdateUser $request, User $user)
    {
        DB::beginTransaction();
        try {
            $avatar = $this->uploadService->uploadImg($request);
            $user->update([
                'email' => $request->email,
                'user_name' => $request->user_name,
                'birthday' => $request->birthday,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'status' => $request->status,
                'address'=>$request->address,
                'province_id' => $request->province_id,
                'district_id' => $request->district_id,
                'commune_id' => $request->commune_id,
                'avatar'=>$avatar,
            ]);
            $mails = array(
                'user' => $user,
                'view' => 'admin.Mails.User.edit');
            SendEmail::dispatch($mails);
            DB::commit();
            return true;
        }catch (\Exception $e) {
            DB::rollBack();
            Log::error("Message: {$exception->getMessage()}. Line: {$exception->getLine()}");
            return false;
        }
    }
     /**
     *   DeleteUser
     *
     * @param $request
     * @param $user
     * @return response
     */
    public function deleteUser(User $user)
    {
        DB::beginTransaction();
        try {
            $user->update(array('flag_delete' => 1));
            DB::commit();
            return response('Post deleted successfully.', Response::HTTP_OK);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Delete User failed');
        }
    }
    /**
     * get a list of the province.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getProvinces()
    {
        $provinces = Province::select('id', 'name')->get();
        return $provinces;
    }
}

