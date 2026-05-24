@extends('layouts.error-layout')

@section('title', '429 - Too Many Requests')

@section('icon')
    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
@endsection

@section('code', '429')

@section('message', 'Too Many Requests')

@section('description', "You're sending requests too quickly. Please slow down and try again in a few moments.")
