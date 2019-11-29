@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                    <h3>Editing answer for question : <strong>{{$question->title}}</strong></h3>
                    </div>
                    <hr>
             
                <form action="{{route('questions.answers.update', [$question->id,$answer->id])}}" method="POST">
                      @csrf
                     @method('PUT')
                      <div class="form-group">
                      <textarea name="body" class="form-control {{$errors->has('body') ? 'is-invalid' : ''}}" id=""  rows="7">{{old('body',$answer->body)}}</textarea>
                      </div>
                      @if($errors->has('body'))
                        <div class="invalid-feedback">
                        <strong>{{$errors->first('body')}}</strong>
                        </div>
                    @endif
                      <div class="form-group">
                          <button type="submit" class="btn btn-lg btn-outline-primary">Update</button>
                        </div>
                  </form>
                   
                </div>
            </div>
        </div>
    </div>
</div>

@endsection