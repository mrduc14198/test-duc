@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-10"><h1>Profile</h1></div>
        </div>
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
        <div class="row">
            <div class="col-sm-12">
                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        <hr>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="name"><h4>Type: </h4></label> <span class="btn btn-outline-info">{{ auth()->user()->get_user_type_label() }}</span>
                            </div>
                            <a href=""></a>
                            @if(auth()->user()->is_customer())
                                @include('frontend.pages.profile.includes.request-supplier')
                            @endif
                        </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="name"><h4>Role: </h4></label>
                                    <span class="btn btn-outline-info">{{ auth()->user()->get_role_label() }}</span>
                                </div>
                            </div>
                        <form class="form" action="{{route('profile.update', auth()->user()->id)}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="name"><h4>Name</h4></label>
                                    <input type="text" class="form-control"
                                           value="{{auth()->user()->name}}"
                                           name="name"
                                           id="name"
                                           placeholder="Name"
                                           title="Enter your name">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="phone"><h4>Phone</h4></label>
                                    <input type="text" class="form-control"
                                           name="phone_number"
                                           value="{{auth()->user()->phone_number}}"
                                           id="phone"
                                           placeholder="Enter phone number"
                                           title="enter your phone number if any.">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="email"><h4>Email</h4></label>
                                    <input class="form-control" type="text" value="{{auth()->user()->email}}" disabled>
                                    <input type="hidden" class="form-control"
                                           name="email"
                                           value="{{auth()->user()->email}}"
                                           id="email"
                                           placeholder="admin@gmail.com"
                                           title="enter your email">
                                </div>
                            </div>

                            @if(!auth()->user()->password)
                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label for="password"><h4>Password</h4></label>
                                        <input type="password"
                                               class="form-control"
                                               name="password"
                                               id="password"
                                               placeholder="Password"
                                               title="enter your password.">
                                    </div>
                                </div>
                            @endif
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <br>
                                    <button class="btn btn-lg btn-success"
                                            type="submit"><i
                                            class="glyphicon glyphicon-ok-sign"></i> Save
                                    </button>
                                    <a href="{{ route('home') }}" class="btn btn-lg btn-danger"><i class="glyphicon glyphicon-repeat"></i> Cancel
                                    </a>
                                </div>
                            </div>
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
