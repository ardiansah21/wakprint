@extends('layouts.main') 
@section('title', 'Create')
@section('content')
<div class="row">
 <div class="col-lg-6">
  <h4>Create Blog</h4>
  {{-- {{ action('MemberController@show', ['id'=>$ts->id_transaksi]) }} --}}
  {{-- <form action="{{ 'SiteController@store' }}"></form> --}}
  {!! Form::model($blog, array('action' => 'SiteController@store')) !!}
   @include('form')
  {!! Form::close() !!}
</div>
 
@endsection