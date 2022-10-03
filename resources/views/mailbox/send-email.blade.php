@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="margin:10px; padding:15px">
                <form method="POST" action="{{route('sendEmail', $mailBox)}}">
                    @if(Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('error'))
                        <div class="alert alert-danger">{{Session::get('error')}}</div>
                    @endif
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email') ?? request()->get('email')}}">
                                @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>

                                @enderror
                            </div>
                        </div>        
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Subject</label>
                                <input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{old('subject')}}">
                                @error('subject')
                                <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>

                                @enderror
                            </div>
                        </div>        
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Message</label>
                                <textarea name="message_body" class="form-control @error('message_body') is-invalid @enderror">  {{old('message_body')}}</textarea>
                                @error('message_body')
                                <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>

                                @enderror
                            </div>
                        </div>        
                    </div>

                    <div class="col-md-12">
                        <input type="submit" value="Send" class="btn btn-primary">
                    </div>
                <form>    
            </div>
        </div>
    </div>
</div>        
@endsection