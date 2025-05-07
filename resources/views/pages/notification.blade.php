@extends('layouts.app')
@section('title', 'Notification')

@section('content')
<div class="flex flex-col min-h-screen">

<main class="flex-grow mt-20 px-4">
<div class="breadcrumbs text-sm">
  <ul class="flex space-x-2">
    <li><a href="/">Home</a></li>
    <li class="text-blue-500">Notifikasi</li>
  </ul>
</div>

<div class="flex gap-6">
<x-user-sidebar />

<div class="flex flex-col w-full"> 
    <!-- Tab Navigation -->
    <div class="bg-custom-green text-white px-10 py-10 overflow-x-auto whitespace-nowrap">
        <div class="flex flex-wrap gap-2">
            <button class="btn btn-soft btn-success rounded-full px-6">All</button>
            <button class="btn btn-soft btn-success rounded-full px-6">Transaction</button>
            <button class="btn btn-soft btn-success rounded-full px-6">Promo</button>
            <button class="btn btn-soft btn-success rounded-full px-6">Account</button>
            <button class="btn btn-soft btn-success rounded-full px-6">My Reward</button>
        </div>
    </div>

    <!-- Notifications Content -->
    <div class="w-full">
        <div class="flex flex-col space-y-6">
            @for($i = 0; $i < 5; $i++)
                @include('components.collapse', [
                    'content' => 'thanks for using our service'
                ])
            @endfor
        </div>
    </div>
</div>
@endsection