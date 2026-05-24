@extends('layouts.error-layout')

@section('title', '419 - Page Expired')

@section('icon')
    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
@endsection

@section('code', '419')

@section('message', 'Page Expired')

@section('description', "Your session has expired due to inactivity. Please reload the page and try again.")
