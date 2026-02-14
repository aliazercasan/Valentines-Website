@extends('layouts.app')

@section('title', 'Valentine\'s Message')

@section('content')
<div class="min-h-[calc(100vh-4rem)] flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-5xl">
        @if($isOwner ?? false)
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl p-6 sm:p-8 mb-8 border border-gray-200">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-gradient-to-r from-red-500 to-pink-500 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800">Share Your Message</h2>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="flex-1 relative">
                        <input 
                            type="text" 
                            readonly 
                            value="{{ route('message.show', $message->share_slug) }}"
                            id="shareLink"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl bg-gray-50 text-gray-700 font-mono text-sm focus:outline-none focus:border-red-300 transition-colors"
                        >
                    </div>
                    <button 
                        onclick="copyLink()"
                        class="bg-gradient-to-r from-red-500 to-pink-500 text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg hover:scale-105 transition-all duration-300 whitespace-nowrap flex items-center justify-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        Copy Link
                    </button>
                </div>
                <p class="text-sm text-gray-500 mt-3 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Share this link with your Valentine!
                </p>
            </div>
        @endif

        <div 
            x-data="{ 
                opened: false,
                showCopyButton: false,
                openEnvelope() {
                    this.opened = true;
                    setTimeout(() => {
                        this.showCopyButton = true;
                    }, 1500);
                }
            }"
            class="relative"
        >
            <!-- Envelope Container -->
            <div 
                @click="!opened && openEnvelope()"
                :class="opened ? 'cursor-default' : 'cursor-pointer hover:scale-105'"
                class="relative transition-transform duration-300"
            >
                <!-- Envelope -->
                <div class="relative w-full max-w-2xl lg:max-w-3xl xl:max-w-4xl mx-auto">
                    <!-- Envelope Body -->
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
                            class="absolute inset-0 flex items-center justify-center p-3 sm:p-4 md:p-6 lg:p-8 z-10"
                        >
                            <div class="bg-gradient-to-br from-pink-50 via-white to-red-50 rounded-xl shadow-2xl w-full h-full overflow-hidden flex flex-col border-4 border-red-500">
                                <div class="flex-1 overflow-y-auto px-4 py-4 sm:px-6 sm:py-5 md:px-8 md:py-6 lg:px-10 lg:py-8">
                                    <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl font-bold text-red-500 text-center mb-4 sm:mb-5 md:mb-6 lg:mb-8">
                                        Happy Valentine's Day! 💕
                                    </h1>
                                    <p class="text-xs sm:text-sm md:text-base lg:text-lg xl:text-xl text-gray-800 leading-relaxed text-left whitespace-pre-wrap message-content">{{ $message->message_text }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Closed Envelope Content -->
                        <div 
                            x-show="!opened"
                            class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-red-100 to-pink-100"
                        >
                            <div class="text-center">
                                <div class="text-6xl sm:text-7xl md:text-8xl mb-4">💌</div>
                                <p class="text-xl sm:text-2xl font-semibold text-red-500">Click to Open</p>
                            </div>
                        </div>

                        <!-- Envelope Border -->
                        <div class="absolute inset-0 border-4 border-red-500 rounded-lg pointer-events-none"></div>
                    </div>

                    <!-- Hearts Animation -->
                    <div 
                        x-show="opened"
                        x-transition:enter="transition ease-out duration-1000"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        class="absolute inset-0 pointer-events-none"
                    >
                        <div class="heart-float" style="left: 10%; animation-delay: 0s;">❤️</div>
                        <div class="heart-float" style="left: 30%; animation-delay: 0.5s;">💕</div>
                        <div class="heart-float" style="left: 50%; animation-delay: 1s;">💖</div>
                        <div class="heart-float" style="left: 70%; animation-delay: 1.5s;">💗</div>
                        <div class="heart-float" style="left: 90%; animation-delay: 2s;">💝</div>
                    </div>
                </div>
            </div>

            <!-- Copy Link Button (for guests) -->
            <div 
                x-show="showCopyButton && !{{ $isOwner ?? false ? 'true' : 'false' }}"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="mt-8 text-center"
            >
                <button 
                    onclick="copyLink()"
                    class="bg-red-500 text-white px-8 py-4 rounded-lg font-semibold hover:bg-red-600 transition text-lg shadow-lg"
                >
                    📋 Copy Link to Share
                </button>
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

    .message-content {
        text-indent: 2.5em;
        line-height: 1.8;
    }

    /* Custom scrollbar for webkit browsers */
    .overflow-y-auto::-webkit-scrollbar {
        width: 8px;
    }

    .overflow-y-auto::-webkit-scrollbar-track {
        background: rgba(255, 192, 203, 0.2);
        border-radius: 4px;
    }

    .overflow-y-auto::-webkit-scrollbar-thumb {
        background: rgba(239, 68, 68, 0.5);
        border-radius: 4px;
    }

    .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: rgba(239, 68, 68, 0.7);
    }

    /* Better text rendering */
    .message-content {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-rendering: optimizeLegibility;
    }
</style>

<script>
    function copyLink() {
        const link = "{{ route('message.show', $message->share_slug) }}";
        navigator.clipboard.writeText(link).then(() => {
            alert('Link copied to clipboard! 💕');
        }).catch(err => {
            // Fallback for older browsers
            const input = document.getElementById('shareLink') || document.createElement('input');
            input.value = link;
            document.body.appendChild(input);
            input.select();
            document.execCommand('copy');
            document.body.removeChild(input);
            alert('Link copied to clipboard! 💕');
        });
    }
</script>
@endsection
