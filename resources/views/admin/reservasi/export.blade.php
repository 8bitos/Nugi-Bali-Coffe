@extends('admin.layouts.app')
@section('title','Export Reservasi')
@section('page_title','Data Export Reservasi')
@section('content')
<div class="rounded-xl border border-slate-200 bg-white p-4 text-sm">Total data: {{ $reservasi->count() }}</div>
@endsection
