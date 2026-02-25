@extends('layouts.user-layout')

@section('title','Complete Your Profile')

@section('content')
<div class="w-screen h-screen bg-gradient-to-br from-pink-100 via-purple-100 to-rose-100 fixed top-0 left-0 -z-10"></div>
<div class="relative z-0">
<div class="max-w-3xl mx-auto px-4 py-8">
  <!-- Header Section -->
  <div class="text-center mb-8">
    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Complete Your Profile</h1>
    <p class="text-lg text-gray-600">Help us get to know you better to enhance your Love Project experience</p>
  </div>

  <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 md:p-8">
    @if(session('info'))
      <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg text-yellow-800">
        <div class="flex items-center">
          <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
          </svg>
          {{ session('info') }}
        </div>
      </div>
    @endif

<form action="{{ route('profile.complete.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

  
      
     <!-- Profile Picture Section -->
      <div class="bg-pink-50 rounded-lg p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
          <svg class="w-5 h-5 text-pink-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
          </svg>
          Profile Picture
        </h3>

        <div class="flex flex-col md:flex-row items-center gap-6">
          <!-- Profile Circle -->
          <div class="relative">
            <div id="profileCircle" class="w-32 h-32 rounded-full overflow-hidden border-4 border-white shadow-lg flex items-center justify-center bg-gradient-to-br from-pink-400 to-purple-500">
              @if($user->profile_picture)
                <img id="previewImage" src="{{ route('profile.photo', ['filename' => basename($user->profile_picture)]) }}" class="w-full h-full object-cover" alt="avatar">
              @else
                <img id="previewImage" src="" class="hidden w-full h-full object-cover" alt="avatar">
                <svg id="defaultIcon" class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
              @endif
            </div>

            <div class="absolute -bottom-2 -right-2 bg-pink-500 rounded-full p-2 shadow-lg">
              <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
            </div>
          </div>

          <!-- Upload Section -->
          <div class="flex-1">
            <label class="block text-sm font-medium text-gray-700 mb-2">Upload your photo</label>
            <div class="flex items-center gap-4">
              <label class="cursor-pointer">
                <span
                  class="px-4 py-2 bg-white border border-pink-300 text-pink-600 rounded-lg hover:bg-pink-50 transition-colors font-medium text-sm">
                  Choose File
                </span>
                <input type="file" name="profile_picture" id="profile_picture" accept="image/*" class="hidden" />
              </label>
              <span class="text-sm text-gray-500" id="fileName">No file chosen</span>
            </div>
            @error('profile_picture')
              <p class="text-sm text-red-600 mt-2 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                    clip-rule="evenodd" />
                </svg>
                {{ $message }}
              </p>
            @enderror
            <p class="text-xs text-gray-600 mt-2">Allowed: JPG, PNG, WebP. Maximum file size: 2MB.</p>
          </div>
        </div>
      </div>
      <!-- Personal Information Section -->
      <div class="bg-pink-50 rounded-lg p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
          <svg class="w-5 h-5 text-pink-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
          </svg>
          Personal Information
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Gender -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
            <select name="gender" class="w-full border border-gray-300 rounded-lg p-3 focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50 transition-colors bg-white">
              <option value="">Select your gender</option>
              <option value="Male" {{ old('gender', $user->gender) == 'Male' ? 'selected' : '' }}>Male</option>
              <option value="Female" {{ old('gender', $user->gender) == 'Female' ? 'selected' : '' }}>Female</option>
              <option value="Other" {{ old('gender', $user->gender) == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('gender') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
          </div>

          <!-- DOB -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
            <input type="date" name="dob" value="{{ $user->dob ? (is_string($user->dob) ? substr($user->dob, 0, 10) : $user->dob->format('Y-m-d')) : '' }}" class="w-full border border-gray-300 rounded-lg p-3 focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50 transition-colors" />
            @error('dob') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
          </div>

          <!-- Location Dropdown -->
          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Location (Country / City)</label>
            <select name="location" class="w-full border border-gray-300 rounded-lg p-3 focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50 transition-colors bg-white">
              <option value="">Select your country / city</option>

              <optgroup label="🇺🇸 North America">
                <option value="New York, USA" {{ old('location', $user->location) == 'New York, USA' ? 'selected' : '' }}>New York, USA</option>
                <option value="Los Angeles, USA" {{ old('location', $user->location) == 'Los Angeles, USA' ? 'selected' : '' }}>Los Angeles, USA</option>
                <option value="Toronto, Canada" {{ old('location', $user->location) == 'Toronto, Canada' ? 'selected' : '' }}>Toronto, Canada</option>
                <option value="Vancouver, Canada" {{ old('location', $user->location) == 'Vancouver, Canada' ? 'selected' : '' }}>Vancouver, Canada</option>
              </optgroup>

              <optgroup label="🇬🇧 Europe">
                <option value="London, UK" {{ old('location', $user->location) == 'London, UK' ? 'selected' : '' }}>London, UK</option>
                <option value="Paris, France" {{ old('location', $user->location) == 'Paris, France' ? 'selected' : '' }}>Paris, France</option>
                <option value="Berlin, Germany" {{ old('location', $user->location) == 'Berlin, Germany' ? 'selected' : '' }}>Berlin, Germany</option>
                <option value="Madrid, Spain" {{ old('location', $user->location) == 'Madrid, Spain' ? 'selected' : '' }}>Madrid, Spain</option>
              </optgroup>

              <optgroup label="🇦🇺 Oceania">
                <option value="Sydney, Australia" {{ old('location', $user->location) == 'Sydney, Australia' ? 'selected' : '' }}>Sydney, Australia</option>
                <option value="Melbourne, Australia" {{ old('location', $user->location) == 'Melbourne, Australia' ? 'selected' : '' }}>Melbourne, Australia</option>
                <option value="Auckland, New Zealand" {{ old('location', $user->location) == 'Auckland, New Zealand' ? 'selected' : '' }}>Auckland, New Zealand</option>
              </optgroup>

              <optgroup label="🇦🇪 Middle East">
                <option value="Dubai, UAE" {{ old('location', $user->location) == 'Dubai, UAE' ? 'selected' : '' }}>Dubai, UAE</option>
                <option value="Abu Dhabi, UAE" {{ old('location', $user->location) == 'Abu Dhabi, UAE' ? 'selected' : '' }}>Abu Dhabi, UAE</option>
                <option value="Doha, Qatar" {{ old('location', $user->location) == 'Doha, Qatar' ? 'selected' : '' }}>Doha, Qatar</option>
                <option value="Riyadh, Saudi Arabia" {{ old('location', $user->location) == 'Riyadh, Saudi Arabia' ? 'selected' : '' }}>Riyadh, Saudi Arabia</option>
              </optgroup>

              <optgroup label="🇸🇬 Asia Pacific">
                <option value="Singapore" {{ old('location', $user->location) == 'Singapore' ? 'selected' : '' }}>Singapore</option>
                <option value="Bangkok, Thailand" {{ old('location', $user->location) == 'Bangkok, Thailand' ? 'selected' : '' }}>Bangkok, Thailand</option>
                <option value="Tokyo, Japan" {{ old('location', $user->location) == 'Tokyo, Japan' ? 'selected' : '' }}>Tokyo, Japan</option>
                <option value="Seoul, South Korea" {{ old('location', $user->location) == 'Seoul, South Korea' ? 'selected' : '' }}>Seoul, South Korea</option>
                <option value="Kuala Lumpur, Malaysia" {{ old('location', $user->location) == 'Kuala Lumpur, Malaysia' ? 'selected' : '' }}>Kuala Lumpur, Malaysia</option>
              </optgroup>
            </select>
            @error('location') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
          </div>

          <!-- Bio -->
          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">About You</label>
            <textarea name="bio" rows="4" placeholder="Tell us about yourself..." class="w-full border border-gray-300 rounded-lg p-3 focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50 transition-colors resize-none">{{ old('bio', $user->bio) }}</textarea>
            @error('bio') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
          </div>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-6 border-t border-gray-200">
        <a href="{{ route('user.dashboard') }}" class="text-gray-600 hover:text-gray-800 transition-colors flex items-center font-medium">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
          </svg>
          Skip for now
        </a>
        <button type="submit" class="px-8 py-3 rounded-full bg-gradient-to-r from-pink-500 to-purple-600 text-white font-semibold hover:from-pink-600 hover:to-purple-700 transition-all transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center">
          Save & Continue
          <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
          </svg>
        </button>
      </div>
    </form>
  </div>
</div>

<!-- ✅ JS for Live Image Preview + Restore Default -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  const fileInput = document.getElementById('profile_picture');
  const previewImage = document.getElementById('previewImage');
  const fileNameDisplay = document.getElementById('fileName');
  const defaultIcon = document.getElementById('defaultIcon');
  const profileCircle = document.getElementById('profileCircle');

  fileInput.addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (!file) {
      // Reset to default if no file selected
      previewImage.classList.add('hidden');
      defaultIcon.classList.remove('hidden');
      profileCircle.classList.add('bg-gradient-to-br', 'from-pink-400', 'to-purple-500');
      fileNameDisplay.textContent = 'No file chosen';
      return;
    }

    // File name
    fileNameDisplay.textContent = file.name;

    // Size limit
    if (file.size > 2 * 1024 * 1024) {
      alert('File size exceeds 2MB. Please choose a smaller image.');
      fileInput.value = '';
      return;
    }

    // Read + Preview
    const reader = new FileReader();
    reader.onload = function (event) {
      previewImage.src = event.target.result;
      previewImage.classList.remove('hidden');
      defaultIcon.classList.add('hidden');
      profileCircle.classList.remove('bg-gradient-to-br', 'from-pink-400', 'to-purple-500');
    };
    reader.readAsDataURL(file);
  });
});
</script>
</div>
</div>
@endsection
