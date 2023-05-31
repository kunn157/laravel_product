<?php

namespace App\Http\Controllers\Api;
use App\Models\Customer;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class AuthController extends BaseController
{

    //
    /**
     * Register customer api
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function Register(Request $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $customer = Customer::create($input);
        if($customer){
            $success['access_token'] =  $customer->createToken('access_token')->accessToken;
            $success['name'] =  $customer->full_name;
            return $this->sendResponse($success, ['Customer register successfully.']);
        }
        return $this->sendError('Error.', $request->messages(), Response::HTTP_NOT_FOUND);
    }

    /**
     * Login customers api
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function Login(Request $request)
    {
        if(auth()->guard('customer')->attempt(['phone' => $request->phone, 'password' => $request->password])){
            $customer = auth()->guard('customer')->user();
            $success['token'] = $customer->createToken('MyApp')->accessToken;
            $success['name'] =  $customer->full_name;
            return $this->sendResponse($success, 'Customer login successfully.');
        }
        else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }
    /**
     * get information about customer
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function showCustomer(){
        $customer = auth()->guard('api')->user();
        $success['customer'] = $customer;
        return $this->sendResponse($success, 'successfully.');
    }
}
