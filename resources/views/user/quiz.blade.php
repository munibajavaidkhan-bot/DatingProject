{{-- resources/views/user/quiz.blade.php (Interactive & Category-Split) --}}

@extends('layouts.user-layout')
@section('title', 'Love Assessment')

@section('content')
@php
    // Custom Colors (for consistent branding)
    $primaryColor = '#F14B8A'; // Deep Pink (Q1)
    $secondaryColor = '#7E3FF2'; // Purple (Q2)
    $tertiaryColor = '#DE3163'; // Deep Red (Q3)

    // Dynamic Variables
    $questionType = $question->type ?? 'rating';
    $options = $question->options ? json_decode($question->options, true) : [];
    
    // Determine Category Accent Color for visual appeal
    $categoryAccent = $primaryColor;
    if (str_contains($question->category ?? '', '2')) {
        $categoryAccent = $secondaryColor; // Purple for Q2
    } elseif (str_contains($question->category ?? '', '3')) {
        $categoryAccent = $tertiaryColor; // Deep Red for Q3
    }
    
    // Determine Max Selections for Multiselect display
    $maxSelections = 4; // Default/Fallback
    if (str_contains($question->question ?? '', 'top 3')) $maxSelections = 3; 

    // Determine Button Text
    $buttonText = ($current ?? 1) == ($totalQuestions ?? 23) ? 'Finish Your Story' : 'Next Love Spark';
@endphp

<div class="w-screen h-screen bg-gradient-to-br from-pink-100 via-purple-100 to-rose-100 fixed top-0 left-0 -z-10"></div>
<div class="relative z-0 min-h-screen p-6 lg:p-8 flex items-center justify-center">
    <div class="max-w-4xl mx-auto w-full">

        <div class="text-center mb-6">
            <h1 class="text-3xl lg:text-4xl font-extrabold text-gray-800">The 52 Week Love Project</h1>
        </div>

        @if($question->category ?? false)
        <div class="text-center mb-8 animate-slide-in-down">
            <h2 class="text-lg md:text-xl font-bold uppercase tracking-widest text-white px-6 py-2 rounded-full inline-block shadow-lg" 
                style="background-color: {{ $categoryAccent }};">
                {{ $question->category }}
            </h2>
        </div>
        @endif

        <div class="glass-card rounded-3xl shadow-xl backdrop-blur-xl border border-white/30 p-6 mb-8 animate-fade-in">
            <div class="flex justify-between items-center mb-3">
                <span class="text-sm font-semibold text-gray-700">
                    Question {{ $current ?? 1 }} of {{ $totalQuestions ?? 23 }}
                </span>
                <span class="text-sm font-semibold" style="color: {{ $categoryAccent }};">
                    {{ round((($current ?? 1) / ($totalQuestions ?? 23)) * 100) }}% Complete
                </span>
            </div>
            <div class="w-full bg-white/50 rounded-full h-3 shadow-inner overflow-hidden">
                <div class="h-full rounded-full transition-all duration-700 ease-in-out" 
                     style="width: {{ (($current ?? 1) / ($totalQuestions ?? 23)) * 100 }}%; background-image: linear-gradient(to right, {{ $primaryColor }}, {{ $secondaryColor }});">
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('quiz.store') }}" id="quizForm" class="animate-slide-in-up">
            @csrf
            <input type="hidden" name="question_id" value="{{ $question->id ?? '' }}">
            <input type="hidden" name="current" value="{{ $current ?? 1 }}">

            <div class="glass-card rounded-3xl shadow-2xl backdrop-blur-xl border border-white/30 p-8 lg:p-10">

                <h3 class="text-xl lg:text-2xl font-extrabold text-gray-800 text-center mb-10 transition-opacity duration-500">
                    {{ $question->question ?? 'Loading...' }}
                </h3>

                @if($questionType === 'rating')
                    {{-- Rating Scale (Q3) - Use Animated Hearts --}}
                    <div class="text-center text-sm text-gray-500 mb-6 font-medium">
                        Rate the importance: (1 = Not Important, 5 = Essential)
                    </div>
                    <div class="flex justify-center flex-wrap gap-4 lg:gap-8 mb-8">
                        @for($i = 1; $i <= 5; $i++)
                            <label class="cursor-pointer group rating-label">
                                <input type="radio" name="answer" value="{{ $i }}" class="hidden rating-radio" required>
                                <div class="heart-rating w-16 h-16 lg:w-20 lg:h-20 transition-all duration-300 transform group-hover:scale-125 focus:scale-125">
                                    <svg class="w-full h-full text-gray-300 transition-colors duration-300" 
                                         fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                    </svg>
                                </div>
                                <span class="block text-xs text-center mt-2 text-gray-600 font-medium">
                                    {{ $i == 1 ? 'Low' : ($i == 5 ? 'High' : $i) }}
                                </span>
                            </label>
                        @endfor
                    </div>
                
                @elseif($questionType === 'multiple_choice')
                    {{-- Single Select (Q1/Q2) - Big, clickable options --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($options as $option)
                            <label class="cursor-pointer choice-label">
                                <input type="radio" name="answer" value="{{ $option }}" class="hidden choice-radio" required>
                                <div class="choice-card p-4 rounded-xl text-lg font-semibold border-2 border-gray-300 transition-all duration-300 hover:scale-[1.02] hover:shadow-lg"
                                     style="color: {{ $categoryAccent }}; border-color: {{ $categoryAccent }}40;">
                                    {{ $option }}
                                </div>
                            </label>
                        @endforeach
                    </div>

                @elseif($questionType === 'multiselect')
                    {{-- Multi Select (Q1/Q2) - Checkbox style, with limit alert --}}
                    <div class="text-center text-base text-gray-700 mb-4 font-medium">
                        Select your preferences: (Up to {{ $maxSelections }} options)
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach($options as $option)
                            <label class="cursor-pointer multiselect-label">
                                <input type="checkbox" name="answer[]" value="{{ $option }}" class="hidden multiselect-checkbox" data-max="{{ $maxSelections }}">
                                <div class="choice-card p-3 rounded-xl text-sm font-medium border-2 border-gray-300 transition-all duration-300 hover:bg-gray-50 hover:shadow-sm"
                                     style="border-color: {{ $categoryAccent }}40;">
                                    {{ $option }}
                                </div>
                            </label>
                        @endforeach
                    </div>

                @endif

                <div class="flex justify-center mt-12">
                    <button type="submit" id="submitButton" disabled 
                            class="neumorphic-btn text-white px-10 py-4 rounded-full font-extrabold shadow-xl transition transform duration-300 opacity-50 cursor-not-allowed flex items-center gap-2"
                            style="background-image: linear-gradient(to right, {{ $primaryColor }}, {{ $tertiaryColor }});">
                        {{ $buttonText }}
                        <i class="fas fa-arrow-right ml-1"></i>
                    </button>
                </div>
                
                {{-- Optional Back Button --}}
                @if(($current ?? 1) > 1)
                    <div class="text-center mt-4">
                        <a href="{{ route('quiz.show', ($current ?? 1) - 1) }}" class="text-gray-500 hover:text-gray-800 text-sm font-medium transition flex items-center justify-center gap-1">
                            <i class="fas fa-chevron-left"></i> Go Back
                        </a>
                    </div>
                @endif
            </div>
        </form>
    </div>
</div>

<style>
    /* Custom Styling for Premium Look */
    .glass-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    .neumorphic-btn {
        box-shadow: 6px 6px 12px rgba(0,0,0,0.1), -6px -6px 12px rgba(255,255,255,0.8);
    }
    .neumorphic-btn:not([disabled]):hover {
        transform: translateY(-2px) scale(1.02);
        box-shadow: 8px 8px 16px rgba(0,0,0,0.15), -8px -8px 16px rgba(255,255,255,0.6);
    }
    
    /* Heart Rating Styling */
    .rating-label input:checked + .heart-rating > svg {
        color: #F14B8A; 
        transform: scale(1.1);
    }
    
    /* Single Choice & Multiselect Selected State (Uses CategoryAccent) */
    .choice-label input:checked + .choice-card {
        border-color: {{ $categoryAccent }} !important;
        background-color: {{ $categoryAccent }}1A;
        box-shadow: 0 0 10px {{ $categoryAccent }}80;
        transform: scale(1.03);
    }

    .multiselect-label input:checked + .choice-card {
        border-color: {{ $categoryAccent }} !important;
        background-color: {{ $categoryAccent }}1A;
        box-shadow: 0 0 10px {{ $categoryAccent }}80;
        transform: scale(1.03);
    }

    /* Custom Animations for Smooth Flow */
    @keyframes slide-in-down {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes slide-in-up {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fade-in {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    .animate-slide-in-down { animation: slide-in-down 0.5s ease-out forwards; }
    .animate-slide-in-up { animation: slide-in-up 0.5s ease-out forwards; }
    .animate-fade-in { animation: fade-in 0.5s ease-out forwards; }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const quizForm = document.getElementById('quizForm');
    const submitButton = document.getElementById('submitButton');
    const questionType = '{{ $questionType }}';
    const maxSelectionsDefault = parseInt(document.querySelector('.multiselect-checkbox')?.dataset.max || 4); 

    // --- 1. ENABLE/DISABLE SUBMIT BUTTON ---
    function checkFormValidity() {
        let isValid = false;
        
        if (questionType === 'rating' || questionType === 'multiple_choice') {
            isValid = quizForm.querySelector('input[name="answer"]:checked');
        } else if (questionType === 'multiselect') {
            const checkedCount = quizForm.querySelectorAll('.multiselect-checkbox:checked').length;
            isValid = checkedCount > 0;
        }

        if (isValid) {
            submitButton.disabled = false;
            submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
        } else {
            submitButton.disabled = true;
            submitButton.classList.add('opacity-50', 'cursor-not-allowed');
        }
    }

    // --- 2. RATING HEARTS SCRIPT (Visual Feedback) ---
    document.querySelectorAll('.rating-radio').forEach(radio => {
        radio.addEventListener('change', function() {
            const selectedValue = parseInt(this.value);
            // Apply visual change to hearts
            document.querySelectorAll('.heart-rating').forEach((h, index) => {
                const currentHeartSvg = h.querySelector('svg');
                if (index < selectedValue) {
                    currentHeartSvg.style.color = '#F14B8A'; // Pink for selected hearts
                } else {
                    currentHeartSvg.style.color = '#ccc';
                }
            });
            checkFormValidity();
        });
    });

    // --- 3. MULTISELECT LIMIT SCRIPT (Interactive Limit Check) ---
    document.querySelectorAll('.multiselect-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const currentMax = parseInt(this.dataset.max) || maxSelectionsDefault;
            const checkedCount = quizForm.querySelectorAll('.multiselect-checkbox:checked').length;
            
            if (checkedCount > currentMax) {
                this.checked = false; 
                alert(`Oops! You can only select up to ${currentMax} options for this question.`);
            }
            checkFormValidity();
        });
    });

    // --- 4. SINGLE CHOICE AUTO-SELECTION (for radio buttons) ---
    document.querySelectorAll('.choice-radio').forEach(radio => {
        radio.addEventListener('change', checkFormValidity);
    });

    // Initial check on load
    checkFormValidity();
});
</script>
@endsection