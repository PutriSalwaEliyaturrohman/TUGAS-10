@extends('layouts.app')

@section('title', 'Groups')

@section('content')
<a href="/groups/create" class="card-link btn btn-primary"> Tambah Groups </a>
<div class="row">
  <div class="col d-inline-flex">
@foreach  ($groups as $group)

<div class="card mt-2 me-2 bg-light" style="width: 18rem;">
  <div class="card-body">
    <a href="/groups/{{$group['id']}}" class="card-title">{{ $group['name'] }}</a>
      <p class="card-text">{{ $group['description'] }}.</p>
      <hr>
      <a href="/groups/addmember/{{$group['id']}}" class="card-link btn btn-primary"> Tambah Anggota </a> 
      <ul class="list-group">
         @foreach ($group->friends as $friend)

        
          <li class="list-group-item d-flex justify-content-between align-items-center">
            {{$friend->name}}
            <form action="/groups/deleteaddmember/{{ $friend->id }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="bedge card-link btn btn-danger">x</button>
            </form>
          </li>
        

        @endforeach
      <hr>
    <a href="/groups/{{$group['id']}}/edit" class="card-link btn btn-warning">Edit Group</a>
    <form action="/groups/{{ $group['id']}}" method="POST">
        @csrf
        @method('DELETE')
        <button class="card-link btn btn-danger">Delete Group</button>
    </form>
  </div>
</div>
    
@endforeach
</div>
</div>

@endsection