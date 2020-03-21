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

        <h2 class="mt-5"><strong>Management</strong><small> - List request to suppliers</small></h2>
        <table class="table table-striped">
            <thead>
            <tr class="">
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Type</th>
                <th scope="col">Role</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($requestSuppliers as $item)
                <tr>
                    <th scope="row" class="text-center">1</th>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->user->email }}</td>
                    <td>{{ $item->user->get_user_type_label() }}</td>
                    <td>{{ $item->user->get_role_label() }}</td>
                    <td>
                        <button class="btn btn-success"
                                data-user-name="{{ $item->user->name }}"
                                data-action="{{route('request-suppliers.accept', $item->id)}}"
                                data-toggle="modal"
                                data-target="#accept" >Accept</button>
                        <button class="btn btn-danger"
                                data-user-name="{{ $item->user->name }}"
                                data-action="{{route('request-suppliers.reject', $item->id)}}"
                                data-toggle="modal"
                                data-target="#reject" >Reject</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @include('frontend.pages.request_suppliers.includes.modal_confirmation')
    @include('frontend.pages.request_suppliers.includes.modal_reject')
@endsection
@section('script')
    <script>
        // Handle data modal confirm
        $('#accept').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var userName= button.data('user-name')
            var action= button.data('action')
            var modal = $(this)
            modal.find('.modal-title').text('Allow ' + userName+ ' become a supplier ?')
            modal.find('#form-accept').attr('action', action)
        })
        //Handle data modal reject
        $('#reject').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var userName= button.data('user-name')
            var action= button.data('action')
            var modal = $(this)
            console.log(action)
            modal.find('.modal-title').text('Deny ' + userName+ ' become a supplier ?')
            modal.find('#form-reject').attr('action', action)
        })
    </script>
@endsection

