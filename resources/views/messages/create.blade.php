@extends('layouts.app')

@section('title', 'Create Message')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-2xl shadow-xl p-8">
        <h1 class="text-3xl sm:text-4xl font-bold text-red-500 mb-2 text-center">Create Your Message</h1>
        <p class="text-gray-600 text-center mb-8">Write a heartfelt message to share with someone special</p>
        
        <form method="POST" action="{{ route('message.store') }}" class="space-y-6">
            @csrf
            
            <div x-data="{ count: 0 }">
                <label for="message_text" class="block text-base sm:text-lg font-medium text-gray-700 mb-2">Your Message</label>
                <textarea 
                    name="message_text" 
                    id="message_text" 
                    rows="10"
                    required
                    maxlength="1000"
                    placeholder="Write your Valentine's message here..."
                    x-ref="textarea"
                    x-on:input="count = $refs.textarea.value.length"
                    x-init="count = $refs.textarea.value.length"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent resize-none text-base sm:text-lg md:text-xl leading-relaxed @error('message_text') border-red-500 @enderror"
                >{{ old('message_text') }}</textarea>
                <div class="flex justify-between items-center mt-2">
                    @error('message_text')
                        <p class="text-sm sm:text-base text-red-500">{{ $message }}</p>
                    @else
                        <p class="text-sm sm:text-base text-gray-500">Share your feelings ❤️</p>
                    @enderror
                    <p class="text-sm sm:text-base font-medium text-gray-600">
                        <span x-text="count"></span>/1000
                    </p>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4">
                <button type="submit" class="flex-1 bg-red-500 text-white py-3 rounded-lg font-semibold hover:bg-red-600 transition">
                    Create & Preview
                </button>
                <a href="{{ route('dashboard') }}" class="flex-1 bg-gray-200 text-gray-700 py-3 rounded-lg font-semibold hover:bg-gray-300 transition text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
