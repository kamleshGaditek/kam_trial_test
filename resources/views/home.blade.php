@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul>
                    <li><a href="{{route('transacHistory')}}">Transactions</a></li>
                    <li><a href="{{route('mailbox')}}">Mailbox</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Select Service</div>

                <div class="card-body">
                    <form method="POST" action="{{route('purchase')}}">
                        @if(Session::has('success'))
                            <div class="alert alert-success">{{Session::get('success')}}</div>
                        @endif
                        @if(Session::has('error'))
                            <div class="alert alert-danger">{{Session::get('error')}}</div>
                        @endif
                        @csrf
                        <div class="row">
                            @foreach($services as $service)
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="radio" name="service" id="service{{$service->id}}" value="{{$service->id}}" checked>
                                        <label>{{$service->name .' - '.$service->price}}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Card Number" name="card_number" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="MM" name="expiration_month" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="YY" name="expiration_year" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="CVC" name="cvc" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="submit" value="Submit" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
