@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex flex-row">
            @if($user->image)
                <div class="imagen">
                    <img src="{{ route('user.avatar', ['filename'=>$user->image]) }}" class="rounded-circle overflow-hidden" style="width:200px; height:200px;">
                </div>
            @endif
                <div class="user info d-flex-flex-column p-4">
                    <h1>{{ '@'.$user->nick }}</h1>
                    <h2>{{ $user->name .' '. $user->surname }}</h2>
                    <p>{{ 'Se unio: '. \FormatTime::LongTimeFilter($user->created_at) }}</p>
                </div>
            </div>
            <hr>
            @foreach($user->images as $image)
                @include('includes.image', ['image'=>$image])
            @endforeach

        </div>
    </div>  
</div>
@endsection
