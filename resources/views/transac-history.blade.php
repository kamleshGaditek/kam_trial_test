@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <table class="table table-stripped">
                    <tr>
                        <th>ID</th>
                        <th>Service Name</th>
                        <th>Price</th>
                        <th>Date</th>
                    </tr>
                    @if(!empty($payments))
                    @foreach($payments as $payment)
                    <tr>
                        <td>{{$payment->id}}</td>
                        <td>{{$payment->service->name}}</td>
                        <td>{{$payment->amount}}</td>
                        <td>{{$payment->created_at->format('Y-m-d H:i')}}</td>
                    </tr>
                    @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>        
@endsection