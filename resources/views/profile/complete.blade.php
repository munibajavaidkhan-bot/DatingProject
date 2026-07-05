{{-- resources/views/profile/complete.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Your Profile — The Love Project</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #fce7f3 0%, #ede9fe 50%, #fce7f3 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .wizard-wrap {
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(20px);
            border-radius: 28px;
            border: 1px solid rgba(255,255,255,0.5);
            box-shadow: 0 20px 60px rgba(236,72,153,0.12);
            width: 100%;
            max-width: 680px;
            overflow: hidden;
        }

        /* ── Progress Header ── */
        .wizard-header {
            background: linear-gradient(135deg, #ec4899, #a855f7);
            padding: 28px 36px;
            color: white;
        }

        .wizard-steps {
            display: flex;
            gap: 8px;
            margin-top: 20px;
        }

        .step-dot {
            flex: 1;
            height: 4px;
            border-radius: 20px;
            background: rgba(255,255,255,0.3);
            transition: background .3s;
        }

        .step-dot.active  { background: white; }
        .step-dot.done    { background: rgba(255,255,255,0.7); }

        /* ── Step Labels ── */
        .step-labels {
            display: flex;
            justify-content: space-between;
            margin-top: 8px;
        }

        .step-label {
            font-size: 10px;
            opacity: 0.7;
            text-align: center;
            flex: 1;
        }

        .step-label.active { opacity: 1; font-weight: 700; }

        /* ── Body ── */
        .wizard-body { padding: 36px; }

        .step-panel { display: none; }
        .step-panel.active { display: block; }

        .step-title {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 6px;
        }

        .step-subtitle {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 28px;
        }

        /* ── Form Fields ── */
        .form-label-custom {
            font-size: 12px;
            font-weight: 700;
            color: #374151;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
            display: block;
        }

        .form-control-custom {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #e5e7eb;
            border-radius: 12px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            color: #1f2937;
            background: white;
            transition: border-color .2s, box-shadow .2s;
            outline: none;
        }

        .form-control-custom:focus {
            border-color: #ec4899;
            box-shadow: 0 0 0 3px rgba(236,72,153,0.1);
        }

        /* ── Interest Pills ── */
        .interest-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .interest-pill {
            padding: 8px 16px;
            border-radius: 25px;
            border: 1.5px solid #e5e7eb;
            background: white;
            font-size: 13px;
            font-weight: 500;
            color: #6b7280;
            cursor: pointer;
            transition: all .2s;
            user-select: none;
        }

        .interest-pill:hover {
            border-color: #ec4899;
            color: #ec4899;
        }

        .interest-pill.selected {
            background: linear-gradient(135deg, #ec4899, #a855f7);
            color: white;
            border-color: transparent;
            box-shadow: 0 3px 10px rgba(236,72,153,0.3);
        }

        /* ── Photo Upload ── */
        .photo-upload-area {
            border: 2px dashed rgba(236,72,153,0.3);
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: all .2s;
            background: #fdf2f8;
        }

        .photo-upload-area:hover {
            border-color: #ec4899;
            background: #fce7f3;
        }

        .photo-preview {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #ec4899;
            display: none;
            margin: 0 auto 12px;
        }

        /* ── Navigation ── */
        .wizard-footer {
            padding: 0 36px 36px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-prev {
            padding: 12px 24px;
            border-radius: 12px;
            border: 1.5px solid #e5e7eb;
            background: white;
            color: #6b7280;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
        }

        .btn-prev:hover {
            border-color: #ec4899;
            color: #ec4899;
        }

        .btn-next {
            padding: 12px 32px;
            border-radius: 12px;
            background: linear-gradient(135deg, #ec4899, #a855f7);
            color: white;
            font-size: 14px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: all .2s;
            box-shadow: 0 4px 14px rgba(236,72,153,0.35);
        }

        .btn-next:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(236,72,153,0.45);
        }

        /* ── Error ── */
        .field-error {
            font-size: 12px;
            color: #ef4444;
            margin-top: 4px;
        }

        /* ── Gender/Goal Options ── */
        .option-card {
            border: 1.5px solid #e5e7eb;
            border-radius: 14px;
            padding: 14px;
            text-align: center;
            cursor: pointer;
            transition: all .2s;
            background: white;
        }

        .option-card:hover { border-color: #ec4899; }
        .option-card.selected {
            border-color: #ec4899;
            background: #fdf2f8;
        }

        .option-card .option-icon {
            font-size: 24px;
            margin-bottom: 6px;
            display: block;
        }

        .option-card .option-label {
            font-size: 13px;
            font-weight: 600;
            color: #1f2937;
        }

        .option-card input[type="radio"] { display: none; }
    </style>
</head>
<body>

<div class="wizard-wrap">

    {{-- Header --}}
    <div class="wizard-header">
        <div style="display:flex;align-items:center;gap:14px;">
            <img src="{{ asset('assets/images/love_logo.png') }}" alt="Logo" style="height:40px;">
            <div>
                <div style="font-family:'Playfair Display',serif;font-size:18px;font-weight:700;">Complete Your Profile</div>
                <div style="font-size:12px;opacity:0.85;">Step <span id="currentStepLabel">1</span> of 4</div>
            </div>
        </div>

        <div class="wizard-steps mt-3">
            <div class="step-dot active" id="dot-1"></div>
            <div class="step-dot" id="dot-2"></div>
            <div class="step-dot" id="dot-3"></div>
            <div class="step-dot" id="dot-4"></div>
        </div>

        <div class="step-labels">
            <span class="step-label active" id="lbl-1">Basics</span>
            <span class="step-label" id="lbl-2">About You</span>
            <span class="step-label" id="lbl-3">Interests</span>
            <span class="step-label" id="lbl-4">Photo</span>
        </div>
    </div>

    {{-- Form --}}
    <form action="{{ route('profile.complete.store') }}" method="POST" enctype="multipart/form-data" id="profileForm">
        @csrf

        {{-- ── STEP 1: Basics ─────────────────────────── --}}
        <div class="wizard-body">

            <div class="step-panel active" id="step-1">
                <div class="step-title">Tell us about yourself 👋</div>
                <div class="step-subtitle">This helps us find your most compatible matches.</div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">First Name *</label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}"
                               class="form-control-custom" placeholder="Your first name" required>
                        @error('first_name')<p class="field-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Last Name *</label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}"
                               class="form-control-custom" placeholder="Your last name" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label-custom">Date of Birth * (must be 18+)</label>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}"
                           class="form-control-custom"
                           max="{{ now()->subYears(18)->format('Y-m-d') }}" required>
                    @error('date_of_birth')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label-custom">I am a *</label>
                    <div class="row g-2">
                        @foreach([
                            ['male','Male','fa-mars','#6366f1'],
                            ['female','Female','fa-venus','#ec4899'],
                            ['other','Non-binary','fa-genderless','#a855f7'],
                        ] as [$val,$label,$icon,$color])
                        <div class="col-4">
                            <label class="option-card" id="gender-{{ $val }}">
                                <input type="radio" name="gender" value="{{ $val }}"
                                       {{ old('gender') === $val ? 'checked' : '' }}
                                       onchange="selectOption('gender','{{ $val }}')" required>
                                <i class="fas {{ $icon }} option-icon" style="color:{{ $color }};"></i>
                                <div class="option-label">{{ $label }}</div>
                            </label>
                        </div>
                        @endforeach
                    </div>
                    @error('gender')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">City *</label>
                        <input type="text" name="city" value="{{ old('city') }}"
                               class="form-control-custom" placeholder="Your city" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Country *</label>
                        <select name="country" class="form-control-custom" required>
                            <option value="">Select Country</option>
                            @foreach(['United States','United Kingdom','Canada','Australia','India','Pakistan','Germany','France','Spain','Italy','Brazil','Mexico','Japan','South Korea','Singapore','UAE','Saudi Arabia','South Africa','Nigeria','Egypt','Other'] as $c)
                            <option value="{{ $c }}" {{ old('country') === $c ? 'selected' : '' }}>{{ $c }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- ── STEP 2: About You ──────────────────── --}}
            <div class="step-panel" id="step-2">
                <div class="step-title">About you 💭</div>
                <div class="step-subtitle">Share a bit more so matches can get to know you.</div>

                <div class="mb-3">
                    <label class="form-label-custom">Bio * (min 50 characters)</label>
                    <textarea name="bio" class="form-control-custom" rows="4"
                              placeholder="Tell potential matches about yourself, your passions, and what you're looking for..."
                              id="bioTextarea" required>{{ old('bio') }}</textarea>
                    <div style="font-size:11px;color:#9ca3af;margin-top:4px;">
                        <span id="bioCount">0</span>/1000 characters
                    </div>
                    @error('bio')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Occupation</label>
                        <input type="text" name="occupation" value="{{ old('occupation') }}"
                               class="form-control-custom" placeholder="What do you do?">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Education</label>
                        <select name="education" class="form-control-custom">
                            <option value="">Select level</option>
                            @foreach(['High School','Some College','Associates','Bachelors','Masters','Doctorate','Trade/Vocational','Other'] as $e)
                            <option value="{{ strtolower(str_replace(' ','_',$e)) }}" {{ old('education') === strtolower(str_replace(' ','_',$e)) ? 'selected' : '' }}>{{ $e }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label-custom">Looking for *</label>
                    <div class="row g-2">
                        @foreach([
                            ['marriage','💍','Marriage'],
                            ['long_term','❤️','Long-term'],
                            ['casual','☕','Casual Dating'],
                            ['friendship','🤝','Friendship'],
                            ['not_sure','🤔','Not Sure'],
                        ] as [$val,$emoji,$label])
                        <div class="col">
                            <label class="option-card" id="goal-{{ $val }}" style="padding:10px 6px;">
                                <input type="radio" name="relationship_goal" value="{{ $val }}"
                                       {{ old('relationship_goal') === $val ? 'checked' : '' }}
                                       onchange="selectOption('goal','{{ $val }}')" required>
                                <span class="option-icon" style="font-size:20px;">{{ $emoji }}</span>
                                <div class="option-label" style="font-size:11px;">{{ $label }}</div>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label-custom">Interested in *</label>
                    <div class="row g-2">
                        @foreach([
                            ['male','Men','fa-mars','#6366f1'],
                            ['female','Women','fa-venus','#ec4899'],
                            ['any','Everyone','fa-heart','#a855f7'],
                        ] as [$val,$label,$icon,$color])
                        <div class="col-4">
                            <label class="option-card" id="pref-{{ $val }}">
                                <input type="radio" name="preferred_gender" value="{{ $val }}"
                                       {{ old('preferred_gender') === $val ? 'checked' : '' }}
                                       onchange="selectOption('pref','{{ $val }}')" required>
                                <i class="fas {{ $icon }} option-icon" style="color:{{ $color }};"></i>
                                <div class="option-label">{{ $label }}</div>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Preferred Age Min</label>
                        <input type="number" name="preferred_age_min" value="{{ old('preferred_age_min', 22) }}"
                               min="18" max="99" class="form-control-custom">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Preferred Age Max</label>
                        <input type="number" name="preferred_age_max" value="{{ old('preferred_age_max', 40) }}"
                               min="18" max="99" class="form-control-custom">
                    </div>
                </div>
            </div>

            {{-- ── STEP 3: Interests ──────────────────── --}}
            <div class="step-panel" id="step-3">
                <div class="step-title">Your interests 🌟</div>
                <div class="step-subtitle">Select at least 3 — this powers our matching algorithm.</div>

                @php
                $allInterests = [
                    '🏃 Fitness','🍳 Cooking','✈️ Travel','📚 Reading',
                    '🎨 Art','🎮 Gaming','🌿 Nature','🎵 Music','🎬 Movies',
                    '❤️ Volunteering','📸 Photography','💃 Dancing','🏊 Swimming',
                    '🚴 Cycling','🧘 Yoga','🐶 Pets','🌱 Sustainability',
                    '🍷 Wine & Dining','🎭 Theatre','🏄 Surfing','🎸 Guitar',
                    '🧁 Baking','🏔️ Hiking','💼 Entrepreneurship','🖥️ Technology',
                    '🧬 Science','✍️ Writing','🏈 Sports','🎺 Jazz','🌺 Gardening',
                ];
                @endphp

                <div class="interest-grid" id="interestGrid">
                    @foreach($allInterests as $interest)
                    @php $val = strtolower(preg_replace('/[^a-z0-9]/i','', $interest)); @endphp
                    <div class="interest-pill" onclick="toggleInterest(this, '{{ $val }}')" data-value="{{ $val }}">
                        {{ $interest }}
                    </div>
                    @endforeach
                </div>

                <input type="hidden" name="interests[]" id="interestHidden" value="">

                <div style="margin-top:16px;padding:12px 16px;background:#fdf2f8;border-radius:12px;">
                    <span style="font-size:13px;color:#ec4899;font-weight:600;">
                        <i class="fas fa-star me-1"></i>
                        <span id="selectedCount">0</span> selected
                        <span style="color:#9ca3af;font-weight:400;">(minimum 3)</span>
                    </span>
                </div>

                @error('interests')<p class="field-error mt-2">{{ $message }}</p>@enderror
            </div>

            {{-- ── STEP 4: Photo ─────────────────────── --}}
            <div class="step-panel" id="step-4">
                <div class="step-title">Add your photo 📸</div>
                <div class="step-subtitle">Profiles with photos get 10x more matches. You can skip this for now.</div>

                <div class="photo-upload-area" onclick="document.getElementById('photoInput').click();" id="photoArea">
                    <img id="photoPreview" class="photo-preview" src="" alt="Preview">
                    <i class="fas fa-camera fa-2x mb-2" style="color:#ec4899;" id="cameraIcon"></i>
                    <div style="font-weight:700;color:#1f2937;margin-bottom:4px;" id="uploadLabel">Upload Your Best Photo</div>
                    <div style="font-size:12px;color:#9ca3af;">JPG, PNG, WebP — max 2MB</div>
                </div>

                <input type="file" name="profile_picture" id="photoInput" accept="image/*"
                       style="display:none;" onchange="previewPhoto(this)">

                @error('profile_picture')<p class="field-error mt-2">{{ $message }}</p>@enderror

                <div style="margin-top:24px;padding:20px;background:linear-gradient(135deg,#fce7f3,#f3e8ff);border-radius:16px;">
                    <div style="font-weight:700;color:#1f2937;margin-bottom:8px;">
                        <i class="fas fa-shield-check me-2" style="color:#ec4899;"></i>
                        You're almost there!
                    </div>
                    <ul style="list-style:none;padding:0;margin:0;">
                        @foreach(['Profile stays private until you match','Only matched users can see your full profile','You can update everything anytime'] as $item)
                        <li style="display:flex;align-items:center;gap:8px;font-size:13px;color:#4b5563;margin-bottom:6px;">
                            <i class="fas fa-check-circle" style="color:#ec4899;flex-shrink:0;"></i>{{ $item }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>{{-- /wizard-body --}}

        {{-- Footer Navigation --}}
        <div class="wizard-footer">
            <button type="button" class="btn-prev" id="prevBtn" onclick="prevStep()" style="display:none;">
                <i class="fas fa-arrow-left me-2"></i>Back
            </button>

            <div style="flex:1;"></div>

            <button type="button" class="btn-next" id="nextBtn" onclick="nextStep()">
                Continue <i class="fas fa-arrow-right ms-2"></i>
            </button>

            <button type="submit" class="btn-next" id="submitBtn" style="display:none;">
                <i class="fas fa-heart me-2"></i>Complete Profile!
            </button>
        </div>

    </form>
</div>

<script>
    let currentStep    = 1;
    const totalSteps   = 4;
    const selectedInterests = new Set();

    // ── Step Navigation ──────────────────────────────────────
    function nextStep() {
        if (!validateStep(currentStep)) return;
        if (currentStep < totalSteps) {
            currentStep++;
            updateWizard();
        }
    }

    function prevStep() {
        if (currentStep > 1) {
            currentStep--;
            updateWizard();
        }
    }

    function updateWizard() {
        // Show correct panel
        document.querySelectorAll('.step-panel').forEach(p => p.classList.remove('active'));
        document.getElementById('step-' + currentStep).classList.add('active');

        // Update dots + labels
        for (let i = 1; i <= totalSteps; i++) {
            const dot = document.getElementById('dot-' + i);
            const lbl = document.getElementById('lbl-' + i);
            dot.className = 'step-dot';
            lbl.className = 'step-label';
            if (i < currentStep)  { dot.classList.add('done'); }
            if (i === currentStep){ dot.classList.add('active'); lbl.classList.add('active'); }
        }

        document.getElementById('currentStepLabel').textContent = currentStep;

        // Show/hide buttons
        document.getElementById('prevBtn').style.display   = currentStep > 1 ? 'block' : 'none';
        document.getElementById('nextBtn').style.display   = currentStep < totalSteps ? 'block' : 'none';
        document.getElementById('submitBtn').style.display = currentStep === totalSteps ? 'block' : 'none';
    }

    // ── Validation ───────────────────────────────────────────
    function validateStep(step) {
        if (step === 1) {
            const fn = document.querySelector('[name="first_name"]').value.trim();
            const ln = document.querySelector('[name="last_name"]').value.trim();
            const db = document.querySelector('[name="date_of_birth"]').value;
            const gn = document.querySelector('[name="gender"]:checked');
            const cy = document.querySelector('[name="city"]').value.trim();
            const cn = document.querySelector('[name="country"]').value;

            if (!fn || !ln) { showError('Please enter your full name.'); return false; }
            if (!db)        { showError('Please enter your date of birth.'); return false; }
            if (!gn)        { showError('Please select your gender.'); return false; }
            if (!cy || !cn) { showError('Please enter your city and country.'); return false; }
        }

        if (step === 2) {
            const bio  = document.getElementById('bioTextarea').value.trim();
            const goal = document.querySelector('[name="relationship_goal"]:checked');
            const pref = document.querySelector('[name="preferred_gender"]:checked');

            if (bio.length < 50)  { showError('Bio must be at least 50 characters.'); return false; }
            if (!goal)            { showError('Please select what you are looking for.'); return false; }
            if (!pref)            { showError('Please select who you are interested in.'); return false; }
        }

        if (step === 3) {
            if (selectedInterests.size < 3) {
                showError('Please select at least 3 interests.');
                return false;
            }
        }

        return true;
    }

    function showError(msg) {
        const existing = document.getElementById('wizardError');
        if (existing) existing.remove();

        const el = document.createElement('div');
        el.id = 'wizardError';
        el.style.cssText = 'background:#fee2e2;color:#dc2626;border-radius:10px;padding:10px 16px;font-size:13px;margin:0 36px 12px;display:flex;align-items:center;gap:8px;';
        el.innerHTML = `<i class="fas fa-circle-exclamation"></i>${msg}`;
        document.querySelector('.wizard-footer').before(el);
        setTimeout(() => el?.remove(), 3000);
    }

    // ── Option Cards ─────────────────────────────────────────
    function selectOption(group, value) {
        document.querySelectorAll(`[id^="${group}-"]`).forEach(el => el.classList.remove('selected'));
        document.getElementById(`${group}-${value}`)?.classList.add('selected');
    }

    // ── Interests ────────────────────────────────────────────
    function toggleInterest(el, value) {
        if (selectedInterests.has(value)) {
            selectedInterests.delete(value);
            el.classList.remove('selected');
        } else {
            if (selectedInterests.size >= 10) {
                showError('Maximum 10 interests allowed.');
                return;
            }
            selectedInterests.add(value);
            el.classList.add('selected');
        }

        document.getElementById('selectedCount').textContent = selectedInterests.size;

        // Update hidden inputs
        const container = document.getElementById('interestHidden').parentNode;
        container.querySelectorAll('input[name="interests[]"]').forEach(i => i.remove());

        selectedInterests.forEach(v => {
            const inp = document.createElement('input');
            inp.type  = 'hidden';
            inp.name  = 'interests[]';
            inp.value = v;
            container.appendChild(inp);
        });
    }

    // ── Photo Preview ────────────────────────────────────────
    function previewPhoto(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('photoPreview');
                preview.src   = e.target.result;
                preview.style.display = 'block';
                document.getElementById('cameraIcon').style.display = 'none';
                document.getElementById('uploadLabel').textContent   = 'Photo selected! ✓';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // ── Bio Counter ──────────────────────────────────────────
    document.getElementById('bioTextarea').addEventListener('input', function() {
        document.getElementById('bioCount').textContent = this.value.length;
    });

    // Init old values
    @if(old('gender'))
    document.addEventListener('DOMContentLoaded', () => {
        selectOption('gender', '{{ old("gender") }}');
        selectOption('goal',   '{{ old("relationship_goal") }}');
        selectOption('pref',   '{{ old("preferred_gender") }}');
    });
    @endif
</script>
</body>
</html>