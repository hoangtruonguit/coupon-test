<?php
/**
 * Created by PhpStorm.
 * User: Hoang Truong
 * Date: 07/03/2019
 * Time: 16:06
 */
namespace App\Exports;

use App\Member;
use App\MemberCoupon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MemberCouponExport implements FromView
{
    public function view(): View
    {
        return view('members.exports.index', [
            'memberCoupons' => MemberCoupon::all()
        ]);
    }
}