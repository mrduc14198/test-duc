<p>
    @if(auth()->user()->is_pending_request_supplier())
        <button class="btn btn-primary" disabled>{{__('labels.all.request_supplier_pending')}}</button>
    @endif
    @if(auth()->user()->is_show_request_supplier_button())
    <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        {{__('labels.all.request_supplier')}}
    </a>
    @elseif(auth()->user()->is_rejected_request_supplier())
    <a class="btn btn-danger" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        {{__('labels.all.request_supplier_denied')}}
    </a>
    @endif
</p>
<div class="collapse" id="collapseExample">
    <div class="card card-body">
        <form action="{{route('request-suppliers.create')}}" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
                <div class="col-xs-6">
                    <label for="email"><h6>Email</h6></label>
                    <input type="text" class="form-control" name="email" id="name" placeholder="Email" title="Enter your email ...">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-6">
                    <label for="password"><h6>Password</h6></label>
                    <input type="password" class="form-control" name="password" id="name" placeholder="Password" title="Enter your password ...">
                </div>
            </div>
            <button type="submit" class="btn btn-success">Send</button>
        </form>
    </div>
</div>
