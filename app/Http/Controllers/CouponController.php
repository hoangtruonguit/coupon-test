<?php
/**
 * Created by PhpStorm.
 * User: Hoang Truong
 * Date: 07/03/2019
 * Time: 10:18
 */

namespace App\Http\Controllers;

use App\Coupon;
use App\MemberCoupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{


    public function redeem(Request $request)
    {
        $request->validate([
            'member_id'=>'numeric|required',
            'coupon_id'=> 'numeric|required'
        ]);

        $memberCoupon = MemberCoupon::where('coupon_id',$request->get('coupon_id'))->where('member_id',$request->get('member_id'))->first();

        if (!$memberCoupon ) {
           return $this->error('Member or coupon is not exits');
        }
        if (!$memberCoupon->used_date) {
            return  $this->error('Cant redeem! This coupon is available');
        }

        $memberCoupon->used_date = null;
        $memberCoupon->save();

        return $this->success(Coupon::find($request->get('coupon_id')));
    }

    public function apply(Request $request)
    {
        $request->validate([
            'member_id'=>'numeric|required',
            'code'=> 'string|required'
        ]);

        $coupon = Coupon::where('code',$request->get('code'))->first();
        if(!$coupon){
            return $this->error('Token or coupon is not exits');
        }
        $memberCoupon = MemberCoupon::where('coupon_id',$coupon->id)->where('member_id',$request->get('member_id'))->first();
        if (!$memberCoupon ) {
            return $this->error('Member  is not exits');
        }

        $memberCoupon->used_date = Carbon::now();
        $memberCoupon->save();

        return $this->success('SUCCESSFULLY');
    }
}