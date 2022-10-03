@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$userEmail->subject ?? 'Email Detail'}}</div>

                <div class="card-body">
                    <p><strong>Email: </strong> {{$userEmail->receiver_email}}</p>
                    <p><strong>Subject: </strong> {{$userEmail->subject ?? ''}}</p>
                    <p><strong>Message: </strong> {{$userEmail->message ?? ''}}</p>
                    <br><br>
                    @if($userEmail->sender_id != Auth::id())
                    <a href="{{route('sendEmail')}}?email={{$userEmail->sender->email}}" class="btn btn-primary">Reply</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection