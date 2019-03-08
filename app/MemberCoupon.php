<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberCoupon extends Model
{
    protected  $table = 'members_coupons';

    public function member()
    {
        return $this->belongsTo('App\Member', 'member_id');
    }

    public function coupon()
    {
        return $this->belongsTo('App\Coupon', 'coupon_id');
    }
}
