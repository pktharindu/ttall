@extends('layouts.base')

@section('body')
<x-navbar />
@yield('content')

@isset($slot)
{{ $slot }}
@endisset
@endsection