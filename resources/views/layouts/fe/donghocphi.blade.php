@extends('layouts.client.client')
@section('content')
đóng học phí
    <form method="POST" enctype="application/x-www-form-urlencoded" action="{{route('xu-ly-thanh-toan-momo-qr')}}" target="_blank">
        @csrf
        <button>Đóng học phí momo QR</button>
    </form>
    <form method="POST" enctype="application/x-www-form-urlencoded" action="{{route('xu-ly-thanh-toan-momo-atm')}}" target="_blank">
        @csrf
        <button>Đóng học phí momo ATM</button>
    </form>
@endsection
