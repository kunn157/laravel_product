<?php

namespace App\Services\Customer;
use App\Services\BaseService;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Auth;

class CustomerServiceApi extends BaseService
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Customer::class;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $customerId = auth('api')->user()->id;
            $customer = Customer::findOrFail($customerId)->update([
                'email' => $request->email,
                'full_name'=>$request->full_name,
                'birthday'=> $request -> birthday,
                'address'=> $request -> address,
                'province_id'=> $request -> province_id,
                'district_id' => $request -> district_id,
                'commune_id' =>$request -> commune_id,
                'status' => $request -> status,
            ]);
            DB::commit();
            return true;
        }catch (\Exception $e) {
            DB::rollBack();
            Log::error("Message: {$exception->getMessage()}. Line: {$exception->getLine()}");
            return false;
        }
    }
}

