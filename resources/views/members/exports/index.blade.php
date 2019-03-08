@extends('layout')

@section('content')
    <h3 class="text-center">Coupon Management</h3>


<div class="row">

      <table class="table table-hover">
          <tr>
              <th width="100px" >Member</th>
              <th width="100px" >Coupon code</th>
              <th width="100px" >Used Date</th>

          </tr>
              @foreach($memberCoupons as $key => $memberCoupon)
                  <tr >
                      <td>
                          {{ $memberCoupon->member->name }}
                      </td>
                      <td>{{ $memberCoupon->coupon->code}}</td>
                      <td>{{ $memberCoupon->used_date ?: "Not Yet" }}</td>
                  </tr>
              @endforeach

      </table>

</div>
@endsection

