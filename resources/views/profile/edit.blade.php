{{-- resources/views/profile/edit.blade.php --}}
@extends('layouts.user-layout')

@section('title', 'Edit Profile')
@section('page-title', 'Edit Profile')

@section('content')

<div class="row g-4">

    {{-- Left: Photo + Quick Info --}}
    <div class="col-lg-4">

        {{-- Photo Card --}}
        <div class="glass-card text-center mb-4">
            <div style="position:relative;display:inline-block;margin-bottom:20px;">
                <img id="avatarPreview"
                     src="{{ $user->getAvatarUrl() }}"
                     style="width:110px;height:110px;border-radius:50%;object-fit:cover;border:3px solid #ec4899;box-shadow:0 4px 16px rgba(236,72,153,0.25);">
                <button type="button" onclick="document.getElementById('photoFileInput').click();"
                        style="position:absolute;bottom:0;right:0;width:34px;height:34px;border-radius:50%;background:linear-gradient(135deg,#ec4899,#a855f7);border:3px solid white;color:white;cursor:pointer;display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-camera" style="font-size:12px;"></i>
                </button>
            </div>

            <h6 style="font-weight:700;color:#1f2937;margin-bottom:2px;">{{ $user->name }}</h6>
            <div style="font-size:12px;color:#a855f7;margin-bottom:16px;">
                {{ $profile->personality_type ?? 'Love Seeker' }}
            </div>

            {{-- Photo Upload Form --}}
            <form action="{{ route('profile.photo') }}" method="POST" enctype="multipart/form-data" id="photoForm">
                @csrf
                <input type="file" id="photoFileInput" name="photo" accept="image/*"
                       style="display:none;" onchange="previewAndUpload(this)">
            </form>

            {{-- Profile completeness --}}
            @php
                $fields = ['first_name','date_of_birth','gender','city','bio','profile_picture','occupation','interests','relationship_goal'];
                $filled = 0;
                foreach($fields as $f) { if($profile->$f) $filled++; }
                $pct = round(($filled / count($fields)) * 100);
            @endphp
            <div style="text-align:left;">
                <div style="display:flex;justify-content:space-between;font-size:12px;margin-bottom:6px;">
                    <span style="color:#6b7280;">Profile Strength</span>
                    <span style="font-weight:700;color:#ec4899;">{{ $pct }}%</span>
                </div>
                <div style="background:#fce7f3;border-radius:20px;height:8px;">
                    <div style="background:linear-gradient(90deg,#ec4899,#a855f7);border-radius:20px;height:8px;width:{{ $pct }}%;transition:width 1s;"></div>
                </div>
                @if($pct < 100)
                <p style="font-size:11px;color:#9ca3af;margin-top:6px;">
                    Complete your profile to attract better matches!
                </p>
                @endif
            </div>
        </div>

        {{-- Stats Card --}}
        <div class="glass-card mb-4">
            <h6 style="font-weight:700;color:#1f2937;margin-bottom:16px;">
                <i class="fas fa-chart-bar me-2" style="color:#a855f7;"></i>Profile Stats
            </h6>
            @foreach([
                ['Profile Views','profile_views','fa-eye','#6366f1'],
                ['Quiz Score','quiz_score','fa-brain','#f59e0b'],
            ] as [$label,$field,$icon,$color])
            <div style="display:flex;align-items:center;justify-content:space-between;padding:10px 0;border-bottom:1px solid #f3f4f6;">
                <div style="display:flex;align-items:center;gap:8px;">
                    <i class="fas {{ $icon }}" style="color:{{ $color }};font-size:14px;"></i>
                    <span style="font-size:13px;color:#6b7280;">{{ $label }}</span>
                </div>
                <span style="font-weight:700;color:#1f2937;">{{ $profile->$field ?? 0 }}</span>
            </div>
            @endforeach
            <div style="display:flex;align-items:center;justify-content:space-between;padding:10px 0;">
                <div style="display:flex;align-items:center;gap:8px;">
                    <i class="fas fa-shield-check" style="color:#22c55e;font-size:14px;"></i>
                    <span style="font-size:13px;color:#6b7280;">Verified</span>
                </div>
                <span style="font-weight:700;color:{{ $profile->is_verified ? '#22c55e' : '#f59e0b' }};">
                    {{ $profile->is_verified ? 'Yes ✓' : 'Pending' }}
                </span>
            </div>
        </div>

        {{-- Danger Zone --}}
        <div class="glass-card" style="border:1px solid rgba(239,68,68,0.2);">
            <h6 style="font-weight:700;color:#ef4444;margin-bottom:12px;">
                <i class="fas fa-triangle-exclamation me-2"></i>Danger Zone
            </h6>
            <p style="font-size:13px;color:#6b7280;margin-bottom:12px;">
                Permanently delete your account and all data.
            </p>
            <button type="button" onclick="document.getElementById('deleteModal').style.display='flex'"
                    style="background:#fee2e2;color:#ef4444;border:1px solid #fca5a5;border-radius:10px;padding:9px 16px;font-size:13px;font-weight:600;cursor:pointer;width:100%;">
                <i class="fas fa-trash me-2"></i>Delete Account
            </button>
        </div>

    </div>

    {{-- Right: Edit Forms --}}
    <div class="col-lg-8">

        @if(session('success'))
        <div style="background:#d1fae5;border:1px solid #6ee7b7;border-radius:12px;padding:14px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;color:#065f46;font-size:14px;">
            <i class="fas fa-check-circle" style="font-size:18px;"></i>
            {{ session('success') }}
        </div>
        @endif

        {{-- Tab Navigation --}}
        <div style="display:flex;gap:4px;background:#f3f4f6;border-radius:14px;padding:4px;margin-bottom:24px;" role="tablist">
            @foreach([
                ['tab-basic','fa-user','Basic Info'],
                ['tab-about','fa-heart','About Me'],
                ['tab-prefs','fa-sliders','Preferences'],
                ['tab-password','fa-lock','Password'],
            ] as [$id,$icon,$label])
            <button type="button" onclick="switchTab('{{ $id }}')"
                    id="btn-{{ $id }}"
                    style="flex:1;padding:9px 6px;border-radius:10px;border:none;font-size:12px;font-weight:600;cursor:pointer;transition:all .2s;
                           background:{{ $id === 'tab-basic' ? 'white' : 'transparent' }};
                           color:{{ $id === 'tab-basic' ? '#ec4899' : '#6b7280' }};
                           box-shadow:{{ $id === 'tab-basic' ? '0 2px 8px rgba(0,0,0,0.08)' : 'none' }};">
                <i class="fas {{ $icon }} me-1"></i>{{ $label }}
            </button>
            @endforeach
        </div>

        {{-- Basic Info Tab --}}
        <div id="tab-basic">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf @method('PATCH')

                <div class="glass-card">
                    <h5 style="font-weight:700;color:#1f2937;margin-bottom:20px;">Basic Information</h5>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label style="font-size:12px;font-weight:700;color:#374151;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">Full Name *</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                   style="width:100%;padding:11px 14px;border:1.5px solid #e5e7eb;border-radius:12px;font-size:14px;outline:none;"
                                   onfocus="this.style.borderColor='#ec4899'" onblur="this.style.borderColor='#e5e7eb'" required>
                        </div>
                        <div class="col-md-6">
                            <label style="font-size:12px;font-weight:700;color:#374151;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">Email *</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                   style="width:100%;padding:11px 14px;border:1.5px solid #e5e7eb;border-radius:12px;font-size:14px;outline:none;"
                                   onfocus="this.style.borderColor='#ec4899'" onblur="this.style.borderColor='#e5e7eb'" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label style="font-size:12px;font-weight:700;color:#374151;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">First Name</label>
                            <input type="text" name="first_name" value="{{ old('first_name', $profile->first_name) }}"
                                   style="width:100%;padding:11px 14px;border:1.5px solid #e5e7eb;border-radius:12px;font-size:14px;outline:none;"
                                   onfocus="this.style.borderColor='#ec4899'" onblur="this.style.borderColor='#e5e7eb'">
                        </div>
                        <div class="col-md-6">
                            <label style="font-size:12px;font-weight:700;color:#374151;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">Last Name</label>
                            <input type="text" name="last_name" value="{{ old('last_name', $profile->last_name) }}"
                                   style="width:100%;padding:11px 14px;border:1.5px solid #e5e7eb;border-radius:12px;font-size:14px;outline:none;"
                                   onfocus="this.style.borderColor='#ec4899'" onblur="this.style.borderColor='#e5e7eb'">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label style="font-size:12px;font-weight:700;color:#374151;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">Date of Birth</label>
                            <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $profile->date_of_birth?->format('Y-m-d')) }}"
                                   max="{{ now()->subYears(18)->format('Y-m-d') }}"
                                   style="width:100%;padding:11px 14px;border:1.5px solid #e5e7eb;border-radius:12px;font-size:14px;outline:none;"
                                   onfocus="this.style.borderColor='#ec4899'" onblur="this.style.borderColor='#e5e7eb'">
                        </div>
                        <div class="col-md-4">
                            <label style="font-size:12px;font-weight:700;color:#374151;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">Gender</label>
                            <select name="gender" style="width:100%;padding:11px 14px;border:1.5px solid #e5e7eb;border-radius:12px;font-size:14px;outline:none;">
                                <option value="">Select</option>
                                @foreach(['male'=>'Male','female'=>'Female','other'=>'Other'] as $v=>$l)
                                <option value="{{ $v }}" {{ old('gender',$profile->gender) === $v ? 'selected' : '' }}>{{ $l }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label style="font-size:12px;font-weight:700;color:#374151;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">Height (cm)</label>
                            <input type="number" name="height" value="{{ old('height', $profile->height) }}"
                                   min="100" max="250" placeholder="170"
                                   style="width:100%;padding:11px 14px;border:1.5px solid #e5e7eb;border-radius:12px;font-size:14px;outline:none;"
                                   onfocus="this.style.borderColor='#ec4899'" onblur="this.style.borderColor='#e5e7eb'">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label style="font-size:12px;font-weight:700;color:#374151;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">City</label>
                            <input type="text" name="city" value="{{ old('city', $profile->city) }}"
                                   style="width:100%;padding:11px 14px;border:1.5px solid #e5e7eb;border-radius:12px;font-size:14px;outline:none;"
                                   onfocus="this.style.borderColor='#ec4899'" onblur="this.style.borderColor='#e5e7eb'">
                        </div>
                        <div class="col-md-6">
                            <label style="font-size:12px;font-weight:700;color:#374151;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">Country</label>
                            <input type="text" name="country" value="{{ old('country', $profile->country) }}"
                                   style="width:100%;padding:11px 14px;border:1.5px solid #e5e7eb;border-radius:12px;font-size:14px;outline:none;"
                                   onfocus="this.style.borderColor='#ec4899'" onblur="this.style.borderColor='#e5e7eb'">
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label style="font-size:12px;font-weight:700;color:#374151;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">Occupation</label>
                            <input type="text" name="occupation" value="{{ old('occupation', $profile->occupation) }}"
                                   style="width:100%;padding:11px 14px;border:1.5px solid #e5e7eb;border-radius:12px;font-size:14px;outline:none;"
                                   onfocus="this.style.borderColor='#ec4899'" onblur="this.style.borderColor='#e5e7eb'">
                        </div>
                        <div class="col-md-6">
                            <label style="font-size:12px;font-weight:700;color:#374151;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">Education</label>
                            <select name="education" style="width:100%;padding:11px 14px;border:1.5px solid #e5e7eb;border-radius:12px;font-size:14px;outline:none;">
                                <option value="">Select</option>
                                @foreach(['High School','Associates','Bachelors','Masters','Doctorate','Trade/Vocational'] as $e)
                                <option value="{{ strtolower(str_replace('/','_',str_replace(' ','_',$e))) }}" {{ old('education',$profile->education) === strtolower(str_replace('/','_',str_replace(' ','_',$e))) ? 'selected' : '' }}>{{ $e }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div style="margin-top:20px;padding-top:16px;border-top:1px solid #f3f4f6;text-align:right;">
                        <button type="submit" style="background:linear-gradient(135deg,#ec4899,#a855f7);color:white;border:none;border-radius:12px;padding:12px 28px;font-size:14px;font-weight:700;cursor:pointer;">
                            <i class="fas fa-save me-2"></i>Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- About Me Tab --}}
        <div id="tab-about" style="display:none;">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf @method('PATCH')

                <div class="glass-card">
                    <h5 style="font-weight:700;color:#1f2937;margin-bottom:20px;">About Me</h5>

                    <div class="mb-4">
                        <label style="font-size:12px;font-weight:700;color:#374151;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">Bio</label>
                        <textarea name="bio" rows="5"
                                  style="width:100%;padding:12px 16px;border:1.5px solid #e5e7eb;border-radius:12px;font-size:14px;outline:none;resize:vertical;font-family:'Inter',sans-serif;line-height:1.6;"
                                  onfocus="this.style.borderColor='#ec4899'" onblur="this.style.borderColor='#e5e7eb'">{{ old('bio', $profile->bio) }}</textarea>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label style="font-size:12px;font-weight:700;color:#374151;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">Relationship Goal</label>
                            <select name="relationship_goal" style="width:100%;padding:11px 14px;border:1.5px solid #e5e7eb;border-radius:12px;font-size:14px;outline:none;">
                                @foreach(['marriage'=>'Marriage','long_term'=>'Long-term','casual'=>'Casual','friendship'=>'Friendship','not_sure'=>'Not Sure'] as $v=>$l)
                                <option value="{{ $v }}" {{ old('relationship_goal',$profile->relationship_goal) === $v ? 'selected' : '' }}>{{ $l }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label style="font-size:12px;font-weight:700;color:#374151;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">Religion</label>
                            <select name="religion" style="width:100%;padding:11px 14px;border:1.5px solid #e5e7eb;border-radius:12px;font-size:14px;outline:none;">
                                <option value="">Prefer not to say</option>
                                @foreach(['christian','muslim','hindu','buddhist','jewish','sikh','atheist','agnostic','other'] as $r)
                                <option value="{{ $r }}" {{ old('religion',$profile->religion) === $r ? 'selected' : '' }}>{{ ucfirst($r) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label style="font-size:12px;font-weight:700;color:#374151;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">Body Type</label>
                            <select name="body_type" style="width:100%;padding:11px 14px;border:1.5px solid #e5e7eb;border-radius:12px;font-size:14px;outline:none;">
                                <option value="">Prefer not to say</option>
                                @foreach(['slim','athletic','average','curvy','heavy'] as $b)
                                <option value="{{ $b }}" {{ old('body_type',$profile->body_type) === $b ? 'selected' : '' }}>{{ ucfirst($b) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label style="font-size:12px;font-weight:700;color:#374151;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">Smoking</label>
                            <select name="smoking" style="width:100%;padding:11px 14px;border:1.5px solid #e5e7eb;border-radius:12px;font-size:14px;outline:none;">
                                @foreach(['never'=>'Never','occasionally'=>'Occasionally','regularly'=>'Regularly','prefer_not_to_say'=>'Prefer not to say'] as $v=>$l)
                                <option value="{{ $v }}" {{ old('smoking',$profile->smoking) === $v ? 'selected' : '' }}>{{ $l }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label style="font-size:12px;font-weight:700;color:#374151;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">Drinking</label>
                            <select name="drinking" style="width:100%;padding:11px 14px;border:1.5px solid #e5e7eb;border-radius:12px;font-size:14px;outline:none;">
                                @foreach(['never'=>'Never','occasionally'=>'Occasionally','socially'=>'Socially','regularly'=>'Regularly','prefer_not_to_say'=>'Prefer not to say'] as $v=>$l)
                                <option value="{{ $v }}" {{ old('drinking',$profile->drinking) === $v ? 'selected' : '' }}>{{ $l }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label style="font-size:12px;font-weight:700;color:#374151;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">Has Children</label>
                            <select name="has_children" style="width:100%;padding:11px 14px;border:1.5px solid #e5e7eb;border-radius:12px;font-size:14px;outline:none;">
                                @foreach(['yes'=>'Yes','no'=>'No','prefer_not_to_say'=>'Prefer not to say'] as $v=>$l)
                                <option value="{{ $v }}" {{ old('has_children',$profile->has_children) === $v ? 'selected' : '' }}>{{ $l }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Interests --}}
                    <div class="mb-4">
                        <label style="font-size:12px;font-weight:700;color:#374151;display:block;margin-bottom:10px;text-transform:uppercase;letter-spacing:.5px;">Interests</label>
                        @php
                        $allInterests = ['fitness','cooking','travel','reading','art','gaming','nature','music','movies','volunteering','photography','dancing','swimming','cycling','yoga','pets','sustainability','dining','theatre','hiking','entrepreneurship','technology','writing','sports','gardening'];
                        $userInterests = $profile->interests ?? [];
                        @endphp
                        <div style="display:flex;flex-wrap:wrap;gap:8px;">
                            @foreach($allInterests as $int)
                            <label style="cursor:pointer;">
                                <input type="checkbox" name="interests[]" value="{{ $int }}" style="display:none;"
                                       {{ in_array($int,$userInterests) ? 'checked' : '' }}
                                       onchange="styleInterestChip(this)">
                                <span class="interest-chip" style="display:inline-block;padding:7px 14px;border-radius:25px;font-size:13px;font-weight:500;transition:all .2s;cursor:pointer;
                                             {{ in_array($int,$userInterests) ? 'background:linear-gradient(135deg,#ec4899,#a855f7);color:white;border:1px solid transparent;' : 'background:white;color:#6b7280;border:1.5px solid #e5e7eb;' }}">
                                    {{ ucfirst($int) }}
                                </span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div style="text-align:right;">
                        <button type="submit" style="background:linear-gradient(135deg,#ec4899,#a855f7);color:white;border:none;border-radius:12px;padding:12px 28px;font-size:14px;font-weight:700;cursor:pointer;">
                            <i class="fas fa-save me-2"></i>Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Preferences Tab --}}
        <div id="tab-prefs" style="display:none;">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf @method('PATCH')

                <div class="glass-card">
                    <h5 style="font-weight:700;color:#1f2937;margin-bottom:20px;">Match Preferences</h5>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label style="font-size:12px;font-weight:700;color:#374151;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">Interested In</label>
                            <select name="preferred_gender" style="width:100%;padding:11px 14px;border:1.5px solid #e5e7eb;border-radius:12px;font-size:14px;outline:none;">
                                @foreach(['male'=>'Men','female'=>'Women','any'=>'Everyone','other'=>'Non-binary'] as $v=>$l)
                                <option value="{{ $v }}" {{ old('preferred_gender',$profile->preferred_gender) === $v ? 'selected' : '' }}>{{ $l }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label style="font-size:12px;font-weight:700;color:#374151;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">Age Min</label>
                            <input type="number" name="preferred_age_min" value="{{ old('preferred_age_min',$profile->preferred_age_min ?? 22) }}"
                                   min="18" max="99"
                                   style="width:100%;padding:11px 14px;border:1.5px solid #e5e7eb;border-radius:12px;font-size:14px;outline:none;"
                                   onfocus="this.style.borderColor='#ec4899'" onblur="this.style.borderColor='#e5e7eb'">
                        </div>
                        <div class="col-md-4">
                            <label style="font-size:12px;font-weight:700;color:#374151;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">Age Max</label>
                            <input type="number" name="preferred_age_max" value="{{ old('preferred_age_max',$profile->preferred_age_max ?? 40) }}"
                                   min="18" max="99"
                                   style="width:100%;padding:11px 14px;border:1.5px solid #e5e7eb;border-radius:12px;font-size:14px;outline:none;"
                                   onfocus="this.style.borderColor='#ec4899'" onblur="this.style.borderColor='#e5e7eb'">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label style="font-size:12px;font-weight:700;color:#374151;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">
                            Max Distance: <span id="distanceVal">{{ $profile->preferred_distance_km ?? 100 }}</span> km
                        </label>
                        <input type="range" name="preferred_distance_km"
                               min="10" max="10000" step="10"
                               value="{{ old('preferred_distance_km',$profile->preferred_distance_km ?? 100) }}"
                               oninput="document.getElementById('distanceVal').textContent=this.value"
                               style="width:100%;accent-color:#ec4899;">
                        <div style="display:flex;justify-content:space-between;font-size:11px;color:#9ca3af;margin-top:4px;">
                            <span>10 km</span><span>Worldwide</span>
                        </div>
                    </div>

                    <div style="text-align:right;">
                        <button type="submit" style="background:linear-gradient(135deg,#ec4899,#a855f7);color:white;border:none;border-radius:12px;padding:12px 28px;font-size:14px;font-weight:700;cursor:pointer;">
                            <i class="fas fa-save me-2"></i>Save Preferences
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Password Tab --}}
        <div id="tab-password" style="display:none;">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf @method('PATCH')
                <input type="hidden" name="_tab" value="password">

                <div class="glass-card">
                    <h5 style="font-weight:700;color:#1f2937;margin-bottom:20px;">Change Password</h5>

                    <div class="mb-3">
                        <label style="font-size:12px;font-weight:700;color:#374151;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">Current Password</label>
                        <input type="password" name="current_password"
                               style="width:100%;padding:11px 14px;border:1.5px solid #e5e7eb;border-radius:12px;font-size:14px;outline:none;"
                               onfocus="this.style.borderColor='#ec4899'" onblur="this.style.borderColor='#e5e7eb'">
                        @error('current_password')<p style="font-size:12px;color:#ef4444;margin-top:4px;">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-3">
                        <label style="font-size:12px;font-weight:700;color:#374151;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">New Password</label>
                        <input type="password" name="password" id="newPwd"
                               style="width:100%;padding:11px 14px;border:1.5px solid #e5e7eb;border-radius:12px;font-size:14px;outline:none;"
                               onfocus="this.style.borderColor='#ec4899'" onblur="this.style.borderColor='#e5e7eb'"
                               oninput="checkPasswordStrength(this.value)">
                        <div id="pwdStrength" style="margin-top:6px;height:4px;border-radius:20px;background:#f3f4f6;overflow:hidden;">
                            <div id="pwdBar" style="height:100%;border-radius:20px;width:0%;transition:width .3s,background .3s;"></div>
                        </div>
                        <div id="pwdLabel" style="font-size:11px;color:#9ca3af;margin-top:4px;"></div>
                    </div>

                    <div class="mb-4">
                        <label style="font-size:12px;font-weight:700;color:#374151;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">Confirm New Password</label>
                        <input type="password" name="password_confirmation"
                               style="width:100%;padding:11px 14px;border:1.5px solid #e5e7eb;border-radius:12px;font-size:14px;outline:none;"
                               onfocus="this.style.borderColor='#ec4899'" onblur="this.style.borderColor='#e5e7eb'">
                    </div>

                    <button type="submit" style="background:linear-gradient(135deg,#ec4899,#a855f7);color:white;border:none;border-radius:12px;padding:12px 28px;font-size:14px;font-weight:700;cursor:pointer;">
                        <i class="fas fa-lock me-2"></i>Update Password
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

{{-- Delete Account Modal --}}
<div id="deleteModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:9999;align-items:center;justify-content:center;">
    <div style="background:white;border-radius:24px;padding:32px;width:90%;max-width:440px;">
        <div style="text-align:center;margin-bottom:20px;">
            <div style="width:60px;height:60px;background:#fee2e2;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
                <i class="fas fa-trash" style="color:#ef4444;font-size:22px;"></i>
            </div>
            <h5 style="font-weight:700;color:#1f2937;">Delete Account</h5>
            <p style="font-size:14px;color:#6b7280;">This will permanently delete your account, profile, matches, and all messages. This cannot be undone.</p>
        </div>
        <form action="{{ route('profile.destroy') }}" method="POST">
            @csrf @method('DELETE')
            <input type="password" name="password" placeholder="Enter your password to confirm"
                   style="width:100%;padding:12px 16px;border:1.5px solid #e5e7eb;border-radius:12px;font-size:14px;outline:none;margin-bottom:16px;"
                   onfocus="this.style.borderColor='#ef4444'" onblur="this.style.borderColor='#e5e7eb'" required>
            <div style="display:flex;gap:10px;">
                <button type="button" onclick="document.getElementById('deleteModal').style.display='none'"
                        style="flex:1;padding:12px;border-radius:12px;border:1.5px solid #e5e7eb;background:white;color:#6b7280;font-weight:600;cursor:pointer;">
                    Cancel
                </button>
                <button type="submit" style="flex:1;padding:12px;border-radius:12px;background:#ef4444;border:none;color:white;font-weight:700;cursor:pointer;">
                    Delete Forever
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function switchTab(id) {
    ['tab-basic','tab-about','tab-prefs','tab-password'].forEach(t => {
        document.getElementById(t).style.display = t === id ? 'block' : 'none';
        const btn = document.getElementById('btn-' + t);
        btn.style.background   = t === id ? 'white' : 'transparent';
        btn.style.color        = t === id ? '#ec4899' : '#6b7280';
        btn.style.boxShadow    = t === id ? '0 2px 8px rgba(0,0,0,0.08)' : 'none';
    });
}

function previewAndUpload(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => document.getElementById('avatarPreview').src = e.target.result;
        reader.readAsDataURL(input.files[0]);
        document.getElementById('photoForm').submit();
    }
}

function styleInterestChip(checkbox) {
    const chip = checkbox.nextElementSibling;
    if (checkbox.checked) {
        chip.style.background = 'linear-gradient(135deg,#ec4899,#a855f7)';
        chip.style.color      = 'white';
        chip.style.border     = '1px solid transparent';
    } else {
        chip.style.background = 'white';
        chip.style.color      = '#6b7280';
        chip.style.border     = '1.5px solid #e5e7eb';
    }
}

function checkPasswordStrength(pwd) {
    const bar   = document.getElementById('pwdBar');
    const label = document.getElementById('pwdLabel');
    let strength = 0;
    if (pwd.length >= 8)         strength++;
    if (/[A-Z]/.test(pwd))       strength++;
    if (/[0-9]/.test(pwd))       strength++;
    if (/[^a-zA-Z0-9]/.test(pwd)) strength++;

    const levels = [
        {w:'25%',  bg:'#ef4444', label:'Weak'},
        {w:'50%',  bg:'#f59e0b', label:'Fair'},
        {w:'75%',  bg:'#3b82f6', label:'Good'},
        {w:'100%', bg:'#22c55e', label:'Strong'},
    ];
    const lvl = levels[Math.max(0, strength - 1)];
    bar.style.width      = pwd.length > 0 ? lvl.w : '0%';
    bar.style.background = lvl.bg;
    label.textContent    = pwd.length > 0 ? lvl.label : '';
    label.style.color    = lvl.bg;
}
</script>
@endpush