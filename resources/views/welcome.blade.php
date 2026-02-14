@extends('layouts.app')

@section('title', 'Welcome - Valentine\'s Day Messages')

@section('content')
<div class="min-h-[calc(100vh-4rem)] flex items-center justify-center px-4 py-8">
    <div class="w-full max-w-5xl">
        <!-- Hero Section -->
        <div class="text-center mb-8 sm:mb-12">
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold bg-gradient-to-r from-red-500 to-pink-500 bg-clip-text text-transparent mb-3 sm:mb-4">
                Valentine's Day Messages
            </h1>
            <p class="text-base sm:text-lg md:text-xl text-gray-600 max-w-2xl mx-auto">
                Create and share beautiful Valentine's messages with your loved ones
            </p>
        </div>

        <!-- Interactive Envelope -->
        <div 
            x-data="{ 
                opened: false,
                openEnvelope() {
                    this.opened = true;
                }
            }"
            class="relative"
        >
            <div 
                @click="!opened && openEnvelope()"
                :class="opened ? 'cursor-default' : 'cursor-pointer hover:scale-[1.02]'"
                class="relative transition-all duration-300"
            >
                <div class="relative w-full max-w-xl sm:max-w-2xl lg:max-w-3xl mx-auto">
                    <div class="relative bg-white rounded-2xl shadow-2xl overflow-hidden" style="aspect-ratio: 1.6/1;">
                        <!-- Envelope Flap -->
                        <div 
                            :class="opened ? 'rotate-[-180deg] translate-y-[-100%]' : 'rotate-0'"
                            class="absolute top-0 left-0 right-0 origin-top transition-all duration-1000 ease-in-out z-20"
                            style="transform-style: preserve-3d;"
                        >
                            <svg viewBox="0 0 400 200" class="w-full">
                                <defs>
                                    <linearGradient id="flapGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                        <stop offset="0%" style="stop-color:#ef4444;stop-opacity:1" />
                                        <stop offset="100%" style="stop-color:#dc2626;stop-opacity:1" />
                                    </linearGradient>
                                </defs>
                                <polygon points="0,0 200,150 400,0" fill="url(#flapGradient)" />
                                <polygon points="0,0 200,150 400,0" fill="rgba(0,0,0,0.1)" />
                            </svg>
                        </div>

                        <!-- Message Card -->
                        <div 
                            x-show="opened"
                            x-transition:enter="transition ease-out duration-1000 delay-500"
                            x-transition:enter-start="opacity-0 translate-y-full scale-75"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            class="absolute inset-0 flex items-center justify-center p-6 sm:p-8 md:p-12 z-10"
                        >
                            <div class="bg-gradient-to-br from-pink-50 via-white to-red-50 rounded-2xl w-full h-full flex flex-col items-center justify-center border-4 border-red-500 px-6">
                                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold text-red-500 mb-3 sm:mb-4 text-center">
                                    Happy Valentine's Day! 💕
                                </h2>
                                <p class="text-sm sm:text-base md:text-lg lg:text-xl text-gray-700 mb-6 sm:mb-8 text-center max-w-2xl">
                                    Spread love and joy with personalized messages
                                </p>
                                @auth
                                    <a href="{{ route('message.create') }}" class="bg-gradient-to-r from-red-500 to-pink-500 text-white px-6 sm:px-8 py-3 sm:py-4 rounded-xl text-base sm:text-lg font-semibold hover:shadow-lg hover:scale-105 transition-all duration-300">
                                        Create Your Message
                                    </a>
                                @else
                                    <a href="{{ route('register') }}" class="bg-gradient-to-r from-red-500 to-pink-500 text-white px-6 sm:px-8 py-3 sm:py-4 rounded-xl text-base sm:text-lg font-semibold hover:shadow-lg hover:scale-105 transition-all duration-300">
                                        Get Started Free
                                    </a>
                                @endauth
                            </div>
                        </div>

                        <!-- Closed Envelope Content -->
                        <div 
                            x-show="!opened"
                            class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-red-100 via-pink-100 to-red-100"
                        >
                            <div class="text-center">
                                <div class="text-6xl sm:text-7xl md:text-8xl lg:text-9xl mb-4 animate-pulse">💌</div>
                                <p class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-semibold text-red-500">Click to Open</p>
                                <p class="text-sm sm:text-base md:text-lg text-gray-600 mt-2">Discover the magic inside</p>
                            </div>
                        </div>

                        <!-- Envelope Border -->
                        <div class="absolute inset-0 border-4 border-red-500 rounded-2xl pointer-events-none"></div>
                    </div>

                    <!-- Hearts Animation -->
                    <div 
                        x-show="opened"
                        x-transition:enter="transition ease-out duration-1000"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        class="absolute inset-0 pointer-events-none overflow-hidden"
                    >
                        <div class="heart-float" style="left: 10%; animation-delay: 0s;">❤️</div>
                        <div class="heart-float" style="left: 30%; animation-delay: 0.5s;">💕</div>
                        <div class="heart-float" style="left: 50%; animation-delay: 1s;">💖</div>
                        <div class="heart-float" style="left: 70%; animation-delay: 1.5s;">💗</div>
                        <div class="heart-float" style="left: 90%; animation-delay: 2s;">💝</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="mt-12 sm:mt-16 grid grid-cols-1 sm:grid-cols-3 gap-6 sm:gap-8 max-w-4xl mx-auto">
            <div class="text-center p-4 sm:p-6 bg-white/50 backdrop-blur-sm rounded-xl">
                <div class="text-3xl sm:text-4xl mb-2 sm:mb-3">✨</div>
                <h3 class="text-base sm:text-lg font-semibold text-gray-800 mb-1 sm:mb-2">Beautiful Design</h3>
                <p class="text-xs sm:text-sm text-gray-600">Stunning animated envelopes</p>
            </div>
            <div class="text-center p-4 sm:p-6 bg-white/50 backdrop-blur-sm rounded-xl">
                <div class="text-3xl sm:text-4xl mb-2 sm:mb-3">🔗</div>
                <h3 class="text-base sm:text-lg font-semibold text-gray-800 mb-1 sm:mb-2">Easy Sharing</h3>
                <p class="text-xs sm:text-sm text-gray-600">Share with one click</p>
            </div>
            <div class="text-center p-4 sm:p-6 bg-white/50 backdrop-blur-sm rounded-xl">
                <div class="text-3xl sm:text-4xl mb-2 sm:mb-3">💝</div>
                <h3 class="text-base sm:text-lg font-semibold text-gray-800 mb-1 sm:mb-2">Personal Touch</h3>
                <p class="text-xs sm:text-sm text-gray-600">Customize your message</p>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes float-up {
        0% {
            transform: translateY(0) scale(0);
            opacity: 0;
        }
        50% {
            opacity: 1;
        }
        100% {
            transform: translateY(-500px) scale(1.5);
            opacity: 0;
        }
    }

    .heart-float {
        position: absolute;
        bottom: 0;
        font-size: 2rem;
        animation: float-up 3s ease-in infinite;
    }
</style>
@endsection
