<?php
namespace App\Services;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Traits\FileUploader;
class VendorService{

    use FileUploader;



    public function register(Request $request, $userId)
    {

        $vendor = new Vendor();
        $vendor->name = $request->shop_name;
        $vendor->user_id = $userId;
        if($request->has('address')){
            $vendor->address = $request->address;
        }
        if($request->has('trade_license')){
            $vendor->trade_license = $this->upload($request->trade_license);
        }
        if($request->has('license_expiry_date')){
            $vendor->license_expiry_date = $request->license_expiry_date;
        }
        if($request->has('address')){
            $vendor->address = $request->address;
        }
        if($request->has('phone')){
            $vendor->phone = $request->phone;
        }
        if($request->has('website')){
            $vendor->website = $request->website;
        }
        if($request->has('city')){
            $vendor->city = $request->city;
        }
        if($request->has('country')){
            $vendor->country = $request->country;
        }
        $vendor->save();
        return $vendor->load('user');

    }




}
