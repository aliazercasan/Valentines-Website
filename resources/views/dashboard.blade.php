@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <h1 class="text-3xl sm:text-4xl font-bold text-gray-800">My Messages</h1>
        <a href="{{ route('message.create') }}" class="bg-red-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-600 transition">
            + Create New Message
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if($messages->isEmpty())
        <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
            <div class="text-6xl mb-4">💌</div>
            <h2 class="text-2xl font-semibold text-gray-700 mb-2">No messages yet</h2>
            <p class="text-gray-500 mb-6">Create your first Valentine's message to share with someone special</p>
            <a href="{{ route('message.create') }}" class="inline-block bg-red-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-600 transition">
                Create Message
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($messages as $message)
                <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                    <div class="flex items-start justify-between mb-4">
                        <div class="text-3xl">💌</div>
                        <span class="text-xs text-gray-500">{{ $message->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-gray-700 mb-4 line-clamp-3">{{ $message->message_text }}</p>
                    <a href="{{ route('message.preview', $message->share_slug) }}" class="block w-full text-center bg-red-500 text-white py-2 rounded-lg font-semibold hover:bg-red-600 transition">
                        View & Share
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
