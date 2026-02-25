@extends('layouts.user-layout')

@section('title','Update User Profile')

@section('content')
<div class="w-screen h-screen bg-gradient-to-br from-pink-100 via-purple-100 to-rose-100 fixed top-0 left-0 -z-10"></div>
<div class="relative z-0">
<div class="max-w-3xl mx-auto px-4 py-8">
  <div class="text-center mb-8">
    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Update User Profile</h1>
    <p class="text-lg text-gray-600">Update user information and profile picture</p>
  </div>

  <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 md:p-8">
    @if(session('status'))
      <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-800">
        {{ session('status') }}
      </div>
    @endif

<form action="{{ route('profile.updateById', $user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <!-- Profile Picture Section -->
    <div class="bg-pink-50 rounded-lg p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
            <svg class="w-5 h-5 text-pink-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            Profile Picture
        </h3>

        <div class="flex flex-col md:flex-row items-center gap-6">
            <div class="relative">
                <div id="profileCircle" class="w-32 h-32 rounded-full overflow-hidden border-4 border-white shadow-lg flex items-center justify-center {{ $user->profile_picture ? '' : 'bg-gradient-to-br from-pink-400 to-purple-500' }}">
                    @if($user->profile_picture)
                        <img id="previewImage" src="{{ route('profile.photo', ['filename' => basename($user->profile_picture)]) }}" class="w-full h-full object-cover" alt="avatar">
                    @else
                        <img id="previewImage" src="" class="hidden w-full h-full object-cover" alt="avatar">
                        <svg id="defaultIcon" class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    @endif
                </div>

                <div class="absolute -bottom-2 -right-2 bg-pink-500 rounded-full p-2 shadow-lg">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
            </div>

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
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-600 mt-2">Allowed: JPG, PNG, WebP. Maximum file size: 2MB.</p>
            </div>
        </div>
    </div>

    <!-- Personal Information Section -->
    <div class="bg-pink-50 rounded-lg p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
            <svg class="w-5 h-5 text-pink-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            Personal Information
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                <input type="date" name="dob" value="{{ $user->dob ? (is_string($user->dob) ? substr($user->dob, 0, 10) : $user->dob->format('Y-m-d')) : '' }}" class="w-full border border-gray-300 rounded-lg p-3 focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50 transition-colors" />
                @error('dob') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Location (Country / City)</label>
                <input type="text" name="location" value="{{ old('location', $user->location) }}" class="w-full border border-gray-300 rounded-lg p-3 focus:border-pink-500 focus:ring focus:ring-pink-200 focus:ring-opacity-50 transition-colors" />
                @error('location') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror
            </div>

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
            Cancel
        </a>
        <button type="submit" class="px-8 py-3 rounded-full bg-gradient-to-r from-pink-500 to-purple-600 text-white font-semibold hover:from-pink-600 hover:to-purple-700 transition-all transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center">
            Update Profile
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
        </button>
    </div>
</form>
</div>
</div>

<!-- JS for live preview -->
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
            previewImage.classList.add('hidden');
            defaultIcon.classList.remove('hidden');
            profileCircle.classList.add('bg-gradient-to-br', 'from-pink-400', 'to-purple-500');
            fileNameDisplay.textContent = 'No file chosen';
            return;
        }

        fileNameDisplay.textContent = file.name;

        if (file.size > 2 * 1024 * 1024) {
            alert('File size exceeds 2MB. Please choose a smaller image.');
            fileInput.value = '';
            return;
        }

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
