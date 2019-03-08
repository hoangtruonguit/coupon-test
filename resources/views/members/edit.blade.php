@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Edit Share
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('members.update', $member->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          {{ csrf_field() }}
          <label for="name"> Name:</label>
          <input type="text" class="form-control" name="name" value="{{$member->name}}"/>
        </div>
        <div class="form-group">
          <label for="email">Email :</label>
          <input type="email" class="form-control" name="email" value="{{$member->email}}"/>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection