@extends('layout.base')
@section('title', '个人资料')
@section('body')
{{ $user->email }}
@endsection