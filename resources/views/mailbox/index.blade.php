@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$mailBox->name}}</div>

                <div class="card-body">
                    <ul>
                    <li><a href="{{route('sendEmail', $mailBox->id)}}">Compose Email</a></li>
                    <li><a href="{{route('inbox', $mailBox->id)}}">Inbox</a></li>
                    <li><a href="{{route('sentBox', $mailBox->id)}}">SentBox</a></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection