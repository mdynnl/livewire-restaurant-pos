@extends('layouts.base')

@section('body')
    <x-nav />
    @yield('content')

    @isset($slot)
        {{ $slot }}
    @endisset
@endsection
