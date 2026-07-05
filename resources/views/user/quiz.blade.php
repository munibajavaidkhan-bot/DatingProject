{{-- resources/views/user/quiz.blade.php --}}
@extends('layouts.user-layout')
@section('title', 'Quiz — Question ' . ($answeredCount + 1))
@section('page-title', 'Love Quiz')

@section('content')
<div style="max-width:680px;margin:0 auto;">

    {{-- Progress --}}
    <div class="glass-card mb-4" style="padding:16px 24px;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:10px;">
            <span style="font-size:13px;font-weight:700;color:#1f2937;">
                Question {{ $answeredCount + 1 }} of {{ $totalCount }}
            </span>
            <span style="font-size:13px;font-weight:700;background:linear-gradient(135deg,#ec4899,#a855f7);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">
                {{ $progress }}% Complete
            </span>
        </div>
        <div style="background:#fce7f3;border-radius:20px;height:8px;">
            <div style="background:linear-gradient(90deg,#ec4899,#a855f7);border-radius:20px;height:8px;width:{{ $progress }}%;transition:width .5s;"></div>
        </div>
        <div style="display:flex;gap:4px;margin-top:8px;">
            @php $cats = ['personality'=>'#ec4899','values'=>'#a855f7','lifestyle'=>'#22c55e','relationship_goals'=>'#6366f1','communication'=>'#f59e0b','interests'=>'#f43f5e']; @endphp
            @foreach($categories as $cat)
            <div style="flex:{{ $cat->total }};height:4px;border-radius:20px;background:{{ $cats[$cat->category] ?? '#e5e7eb' }};opacity:{{ isset($answeredByCategory[$cat->category]) ? 1 : 0.3 }};"></div>
            @endforeach
        </div>
    </div>

    {{-- Question Card --}}
    <div class="glass-card" style="padding:36px;" id="questionCard">
        <div style="margin-bottom:20px;">
            <span style="background:{{ $cats[$question->category] ?? '#ec4899' }}22;color:{{ $cats[$question->category] ?? '#ec4899' }};font-size:11px;font-weight:700;padding:4px 12px;border-radius:20px;text-transform:capitalize;">
                {{ str_replace('_',' ',$question->category) }}
            </span>
        </div>

        <h4 style="font-family:'Playfair Display',serif;font-size:20px;font-weight:700;color:#1f2937;margin-bottom:28px;line-height:1.4;">
            {{ $question->question }}
        </h4>

        @if($question->description)
        <p style="font-size:14px;color:#6b7280;margin-bottom:20px;line-height:1.6;">{{ $question->description }}</p>
        @endif

        <form id="quizForm">
            @csrf

            @if($question->type === 'single_choice')
            <div style="display:flex;flex-direction:column;gap:10px;">
                @foreach($question->options as $option)
                <label style="display:flex;align-items:center;gap:14px;padding:16px 18px;border:1.5px solid #e5e7eb;border-radius:14px;cursor:pointer;transition:all .2s;"
                       class="option-label" onmouseover="hoverOption(this)" onmouseout="unhoverOption(this)">
                    <input type="radio" name="answer" value="{{ $option['value'] }}" style="display:none;"
                           onchange="handleSelect(this)">
                    <div class="radio-dot" style="width:20px;height:20px;border-radius:50%;border:2px solid #e5e7eb;flex-shrink:0;transition:all .2s;"></div>
                    <span style="font-size:14px;color:#374151;font-weight:500;line-height:1.4;">{{ $option['label'] }}</span>
                </label>
                @endforeach
            </div>

            @elseif($question->type === 'multiple_choice')
            <p style="font-size:12px;color:#9ca3af;margin-bottom:14px;">Select all that apply</p>
            <div style="display:flex;flex-wrap:wrap;gap:10px;">
                @foreach($question->options as $option)
                <label style="cursor:pointer;">
                    <input type="checkbox" name="answer[]" value="{{ $option['value'] }}" style="display:none;">
                    <span class="multi-chip" style="display:inline-block;padding:9px 18px;border-radius:25px;border:1.5px solid #e5e7eb;font-size:13px;font-weight:500;color:#6b7280;transition:all .2s;cursor:pointer;"
                          onclick="toggleChip(this)">
                        {{ $option['label'] }}
                    </span>
                </label>
                @endforeach
            </div>

            @elseif($question->type === 'rating_scale')
            <div style="display:flex;flex-direction:column;gap:10px;">
                @foreach($question->options as $option)
                <label style="display:flex;align-items:center;gap:14px;padding:14px 18px;border:1.5px solid #e5e7eb;border-radius:14px;cursor:pointer;transition:all .2s;"
                       class="option-label">
                    <input type="radio" name="answer" value="{{ $option['value'] }}" style="display:none;"
                           onchange="handleSelect(this)">
                    <div style="width:28px;height:28px;border-radius:50%;background:linear-gradient(135deg,#ec4899,#a855f7);color:white;font-weight:800;font-size:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        {{ $option['value'] }}
                    </div>
                    <span style="font-size:13px;color:#374151;">{{ $option['label'] }}</span>
                </label>
                @endforeach
            </div>
            @endif

            <button type="submit" id="nextBtn"
                    style="margin-top:28px;width:100%;padding:15px;border-radius:14px;background:linear-gradient(135deg,#ec4899,#a855f7);color:white;border:none;font-size:15px;font-weight:700;cursor:pointer;opacity:0.5;pointer-events:none;transition:all .2s;"
                    disabled>
                Next Question <i class="fas fa-arrow-right ms-2"></i>
            </button>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
const questionId = {{ $question->id }};
const saveUrl    = '{{ route("member.quiz.answer") }}';
const csrfToken  = document.querySelector('meta[name="csrf-token"]').content;

function enableNext() {
    const btn = document.getElementById('nextBtn');
    btn.disabled = false;
    btn.style.opacity = '1';
    btn.style.pointerEvents = 'auto';
}

function handleSelect(input) {
    // Style selected radio option
    document.querySelectorAll('.option-label').forEach(lbl => {
        lbl.style.borderColor = '#e5e7eb';
        lbl.style.background  = 'white';
        lbl.querySelector('.radio-dot').style.borderColor = '#e5e7eb';
        lbl.querySelector('.radio-dot').style.background  = 'white';
    });

    const lbl = input.closest('.option-label');
    lbl.style.borderColor = '#ec4899';
    lbl.style.background  = '#fdf2f8';
    const dot = lbl.querySelector('.radio-dot');
    dot.style.borderColor = '#ec4899';
    dot.style.background  = 'linear-gradient(135deg,#ec4899,#a855f7)';
    enableNext();
}

function toggleChip(span) {
    const inp = span.previousElementSibling;
    inp.checked = !inp.checked;
    if (inp.checked) {
        span.style.background    = 'linear-gradient(135deg,#ec4899,#a855f7)';
        span.style.color         = 'white';
        span.style.borderColor   = 'transparent';
    } else {
        span.style.background    = 'white';
        span.style.color         = '#6b7280';
        span.style.borderColor   = '#e5e7eb';
    }

    const anyChecked = document.querySelectorAll('input[type="checkbox"]:checked').length > 0;
    if (anyChecked) enableNext();
}

function hoverOption(lbl) {
    if (!lbl.querySelector('input').checked) {
        lbl.style.borderColor = '#f9a8d4';
        lbl.style.background  = '#fdf2f8';
    }
}

function unhoverOption(lbl) {
    if (!lbl.querySelector('input').checked) {
        lbl.style.borderColor = '#e5e7eb';
        lbl.style.background  = 'white';
    }
}

document.getElementById('quizForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const btn = document.getElementById('nextBtn');
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Saving...';
    btn.disabled  = true;

    // Collect answer(s)
    const single   = document.querySelector('input[name="answer"]:checked');
    const multiple = document.querySelectorAll('input[name="answer[]"]:checked');
    const answer   = single ? single.value : Array.from(multiple).map(i => i.value);

    if (!answer || (Array.isArray(answer) && answer.length === 0)) {
        btn.innerHTML = 'Next Question <i class="fas fa-arrow-right ms-2"></i>';
        btn.disabled = false;
        return;
    }

    const res  = await fetch(saveUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
        body: JSON.stringify({ question_id: questionId, answer })
    });

    const data = await res.json();

    if (data.redirect) {
        window.location = data.redirect;
    } else {
        // Animate transition + reload for next question
        const card = document.getElementById('questionCard');
        card.style.opacity   = '0';
        card.style.transform = 'translateX(20px)';
        card.style.transition= 'all .25s ease';
        setTimeout(() => window.location.reload(), 250);
    }
});
</script>
@endpush