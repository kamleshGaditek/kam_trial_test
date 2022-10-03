@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <table class="table table-stripped">
                    <tr>
                        <th>Sender Email</th>
                        <th>Subject</th>
                        <th>Date</th>
                    </tr>
                    @if(!empty($userEmails))
                    @foreach($userEmails as $userEmail)
                    <tr>
                        <td>{{$userEmail->receiver_email}}</td>
                        <td>{{$userEmail->subject}}</td>
                        <td><a href="{{route('emailById', $userEmail->id)}}">Detail</a></td>
                        <td>{{$userEmail->created_at->format('Y-m-d H:i')}}</td>
                    </tr>
                    @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>        
@endsection