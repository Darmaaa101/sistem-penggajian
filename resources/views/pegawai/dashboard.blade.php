@extends('layouts.karyawan')

@section('title', 'Dashboard')

@section('content')

<h1 class="text-2xl font-bold">
    Dashboard Karyawan
</h1>

<p>Selamat datang, {{ Auth::user()->name }}</p>

@endsection