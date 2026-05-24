@extends('layouts.error-layout')

@section('title', '403 - Forbidden')

@section('icon')
    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
    </svg>
@endsection

@section('code', '403')

@section('message', 'Access Forbidden')

@section('description', "You don't have the necessary permissions to view this resource. If you believe this is an error, please contact your administrator.")
