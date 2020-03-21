@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="mt-3">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{session('success')}}
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <h2 class="mt-5 text-center"><strong>Login</strong></h2>
        <form class="mt-2" action="{{route('auth.login')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            </div>
            <div class="text-center">
                <a href="{{route('home')}}" class="btn btn-danger text-white">Cancel</a>
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
            <div class="social-login">
                <a href="{{ route('auth.social', config('const.social_auth.github_provider')) }}" class="btn btn-success text-white">Login Github</a>
            </div>
        </form>
    </div>
@endsection
