@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
      margin-bottom: 20px;
  }
</style>

      <h3 class="text-center">Coupon Management</h3>
<div class="uper">
@if(session()->get('success'))
<div class="alert alert-success">
{{ session()->get('success') }}
</div><br />
@endif
    <div class="row">
        <div class="col-6" >
        <a href="{{ route('members.create')}}" class="btn btn-primary text-left">Add Member</a>
        </div>
        <div class="btn-group col-6" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle justify-content-end" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Export
            </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <a href="{{ route('members.export','xls')}}" class="dropdown-item">Exel</a>
                <a class="dropdown-item" href="{{ route('members.export','csv')}}">CSV</a>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th width="80px">@sortablelink('id')</th>
                <th>@sortablelink('name')</th>
                <th>@sortablelink('email')</th>
                <th>@sortablelink('created_at')</th>
                <td colspan="2">Action</td>
            </tr>
            @if($members->count())
                @foreach($members as $key => $member)
                    <tr >
                        <td>
                            {{ $member->id }}
                        </td>
                        <td>
                            <a href="#" data-toggle="collapse" data-target="#demo{{$member->id}}" class="accordion-toggle">
                                {{ $member->name }}
                            </a>
                        </td>
                        <td>{{ $member->email}}</td>
                        <td>{{ $member->created_at->format('d-m-Y') }}</td>
                        <td><a href="{{ route('members.edit',$member->id)}}" class="btn btn-primary">Edit</a></td>
                        <td>
                            <a href="#" data-id="{{$member->id}}"  class="btn btn-danger delete-member"  data-toggle="modal"  data-modal="#deleteMemberModal" >
                                DELETE
                            </a>
                        </td>
                    </tr>

                    <tr class="child-row">
                        <td colspan="12" class="hiddenRow">
                            <div class="accordian-body collapse" id="demo{{$member->id}}">
                                @if ($member->memberCoupon->count())
                                    <table class="table table-striped">
                                        <thead>
                                        <th>Id</th>
                                        <th>Coupon</th>
                                        <th>Used Date</th>
                                        </thead>
                                        <tbody>
                                        @foreach($member->memberCoupon as $key => $memberCoupon)
                                            <tr>
                                                <td>{{$memberCoupon->coupon->id}}</td>
                                                <td>{{$memberCoupon->coupon->code}}</td>
                                                <td>{{$memberCoupon->used_date ?: 'not yet'}}</td>
                                        </tbody>
                                        @endforeach
                                    </table>
                                @else
                                    <p>No data found</p>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
        </table>

    </div>
{!! $members->appends(\Request::except('page'))->render() !!}
</div>
@include('members.delete')
@endsection
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    var ATTRIBUTES = [ 'id'];

        $('.delete-member').on('click', function (e) {
            var $target = $(e.target);
            var modalSelector = $target.data('modal');
            ATTRIBUTES.forEach(function (attributeName) {
                var $modalAttribute = $(modalSelector + ' .modal-body #' + attributeName);
                var dataValue = $target.data(attributeName);
                $(modalSelector+ ' form').attr('action', 'members/'+dataValue);
                $modalAttribute.val(dataValue || '');
            });
            $(modalSelector).modal('show');
        });
    });
</script>
