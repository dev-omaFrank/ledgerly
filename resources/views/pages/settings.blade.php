{{-- Business Profile Settings Page --}}
<x-app-layout>
    <x-auth-navbar :userInitials="$userInitials"/>

    <div x-data="{ sidebarOpen: false }" class="flex min-h-screen bg-gradient-to-br from-slate-50 to-slate-100">
        <x-mobile-toggle-button />
        
        <div class="flex-1 p-4 sm:p-6 lg:p-8 space-y-6">
            <div class="max-w-4xl mx-auto space-y-8">
                
                <!-- Page Header -->
                <div>
                    <h1 class="text-3xl sm:text-4xl font-bold text-slate-900">Business Profile</h1>
                    <p class="text-slate-600 mt-2 text-sm sm:text-base">Manage your business information and account details</p>
                </div>

                <!-- Success Message -->
                @if(session('success'))
                    <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-lg flex items-start gap-3">
                        <svg class="h-5 w-5 text-emerald-600 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-emerald-900">Success</p>
                            <p class="text-sm text-emerald-700 mt-1">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <!-- Business Profile Form -->
                <form action="/business/create-business-profile" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Business Profile Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 sm:p-8 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center gap-3 mb-6">
                            <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h2 class="text-xl sm:text-2xl font-bold text-slate-900">Business Information</h2>
                        </div>
                        <p class="text-slate-600 text-sm mb-6">This information will appear on your invoices and business documents.</p>

                        <div class="space-y-6">
                            <!-- Logo Upload Section -->
                            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6">
                                <div id="imagePreview" class="h-24 w-24 rounded-lg bg-slate-100 border-2 border-dashed border-slate-300 flex flex-col items-center justify-center text-slate-400 cursor-pointer hover:bg-slate-50 transition-colors flex-shrink-0">
                                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    <span class="text-[10px] font-bold uppercase mt-1">Logo</span>
                                </div>

                                <div class="flex-1">
                                    <h4 class="text-sm font-semibold text-slate-900">Business Logo <span class="text-xs text-slate-500 font-normal">(Optional)</span></h4>
                                    <p class="text-xs text-slate-600 mt-1">PNG, JPG up to 2MB. Recommended size 400x400px.</p>

                                    <div class="mt-4 flex flex-col sm:flex-row gap-2">
                                        <input type="file" accept="image/*" name="businessLogo" id="fileInput" class="text-xs px-4 py-2 border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors font-medium cursor-pointer">
                                        <button type="button" id="removeBtn" class="text-xs px-4 py-2 text-red-600 border border-red-200 hover:bg-red-50 transition-colors font-medium rounded-lg">Remove</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Fields Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6 border-t border-slate-200">

                                <!-- Business Name (Full Width) -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-slate-900 mb-2">Business Name *</label>
                                    <input type="text" name="businessName" value="{{ old('businessName') }}" placeholder="Enter your business name" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all text-slate-900 placeholder-slate-400">
                                    @error('businessName')
                                        <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18.169 12.476l-7.889-7.889a1 1 0 10-1.414 1.414L15.756 12l-6.89 6.89a1 1 0 001.414 1.414l7.889-7.889a1 1 0 000-1.414z" clip-rule="evenodd" /></svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Email Address -->
                                <div>
                                    <label class="block text-sm font-semibold text-slate-900 mb-2">Email Address *</label>
                                    <input type="email" name="businessEmail" value="{{ old('businessEmail') }}" placeholder="business@example.com" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all text-slate-900 placeholder-slate-400">
                                    @error('businessEmail')
                                        <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18.169 12.476l-7.889-7.889a1 1 0 10-1.414 1.414L15.756 12l-6.89 6.89a1 1 0 001.414 1.414l7.889-7.889a1 1 0 000-1.414z" clip-rule="evenodd" /></svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Phone Number -->
                                <div>
                                    <label class="block text-sm font-semibold text-slate-900 mb-2">Phone Number *</label>
                                    <input type="tel" name="businessPhoneNo" value="{{ old('businessPhoneNo') }}" placeholder="+234 (555) 000-0000" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all text-slate-900 placeholder-slate-400">
                                    @error('businessPhoneNo')
                                        <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18.169 12.476l-7.889-7.889a1 1 0 10-1.414 1.414L15.756 12l-6.89 6.89a1 1 0 001.414 1.414l7.889-7.889a1 1 0 000-1.414z" clip-rule="evenodd" /></svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Address (Full Width) -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-slate-900 mb-2">Business Address *</label>
                                    <textarea name="businessAddress" placeholder="123 Business Lane, Suite 100&#10;City, State 12345" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all text-slate-900 placeholder-slate-400 h-24 resize-none">{{ old('businessAddress') }}</textarea>
                                    @error('businessAddress')
                                        <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18.169 12.476l-7.889-7.889a1 1 0 10-1.414 1.414L15.756 12l-6.89 6.89a1 1 0 001.414 1.414l7.889-7.889a1 1 0 000-1.414z" clip-rule="evenodd" /></svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Business Account Details Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 sm:p-8 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center gap-3 mb-6">
                            <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0l.879-.659m-3.172-2.351a3 3 0 112.4 0m-5.007-3.788a3 3 0 111.946-5.666m15.482 16.313A20.94 20.94 0 0112 3.75c-9.003 0-16.658 5.343-20.583 13.111M2.3 21h19.4" />
                            </svg>
                            <h2 class="text-xl sm:text-2xl font-bold text-slate-900">Account Details</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <!-- Currency Selection -->
                            <div>
                                <label class="block text-sm font-semibold text-slate-900 mb-2">Default Currency *</label>
                                <select name="currency" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all text-slate-900 bg-white">
                                    <option value="NGN" {{ old('currency') == 'NGN' ? 'selected' : '' }}>NGN (Nigerian Naira)</option>
                                    <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>USD (US Dollar)</option>
                                    <option value="GBP" {{ old('currency') == 'GBP' ? 'selected' : '' }}>GBP (British Pound)</option>
                                    <option value="EUR" {{ old('currency') == 'EUR' ? 'selected' : '' }}>EUR (Euro)</option>
                                </select>
                            </div>

                            <!-- Spacer for alignment -->
                            <div></div>

                            <!-- Bank Details Section (Full Width) -->
                            <div class="md:col-span-2 space-y-6 pt-6 border-t border-slate-200">
                                <div class="flex items-center gap-2 mb-4">
                                    <svg class="h-5 w-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 3h18M3.75 6h16.5v12a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V6z" />
                                    </svg>
                                    <h3 class="text-sm font-semibold text-slate-900">Bank Information</h3>
                                </div>

                                <!-- Bank Name -->
                                <div>
                                    <label class="block text-sm font-semibold text-slate-900 mb-2">Bank Name *</label>
                                    <input type="text" name="bank_name" value="{{ old('bank_name') }}" placeholder="e.g., First Bank of Nigeria" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all text-slate-900 placeholder-slate-400">
                                    @error('bank_name')
                                        <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18.169 12.476l-7.889-7.889a1 1 0 10-1.414 1.414L15.756 12l-6.89 6.89a1 1 0 001.414 1.414l7.889-7.889a1 1 0 000-1.414z" clip-rule="evenodd" /></svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Account Name -->
                                <div>
                                    <label class="block text-sm font-semibold text-slate-900 mb-2">Account Name *</label>
                                    <input type="text" name="account_name" value="{{ old('account_name') }}" placeholder="Name on bank account" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all text-slate-900 placeholder-slate-400">
                                    @error('account_name')
                                        <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18.169 12.476l-7.889-7.889a1 1 0 10-1.414 1.414L15.756 12l-6.89 6.89a1 1 0 001.414 1.414l7.889-7.889a1 1 0 000-1.414z" clip-rule="evenodd" /></svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Account Number -->
                                <div>
                                    <label class="block text-sm font-semibold text-slate-900 mb-2">Account Number *</label>
                                    <input type="text" name="account_number" value="{{ old('account_number') }}" placeholder="Your bank account number" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all text-slate-900 placeholder-slate-400">
                                    @error('account_number')
                                        <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18.169 12.476l-7.889-7.889a1 1 0 10-1.414 1.414L15.756 12l-6.89 6.89a1 1 0 001.414 1.414l7.889-7.889a1 1 0 000-1.414z" clip-rule="evenodd" /></svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Bank Code -->
                                <div>
                                    <label class="block text-sm font-semibold text-slate-900 mb-2">Bank Code <span class="text-xs text-slate-500 font-normal">(Optional)</span></label>
                                    <input type="text" name="bank_code" value="{{ old('bank_code') }}" placeholder="e.g., 011" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all text-slate-900 placeholder-slate-400">
                                    @error('bank_code')
                                        <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18.169 12.476l-7.889-7.889a1 1 0 10-1.414 1.414L15.756 12l-6.89 6.89a1 1 0 001.414 1.414l7.889-7.889a1 1 0 000-1.414z" clip-rule="evenodd" /></svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <!-- Submit Button -->
                        <div class="mt-8 pt-6 border-t border-slate-200 flex flex-col sm:flex-row gap-3 sm:justify-end">
                            <button type="reset" class="px-6 py-2.5 border border-slate-300 text-slate-700 font-semibold rounded-lg hover:bg-slate-50 transition-colors duration-200">
                                Reset
                            </button>
                            <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 active:bg-blue-800 transition-colors duration-200 shadow-sm flex items-center justify-center gap-2">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Save Business Profile
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script>
        const preview = document.querySelector("#imagePreview");
        const fileInput = document.querySelector('#fileInput');
        const removeBtn = document.querySelector('#removeBtn');

        fileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            const allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg'];

            if (file) {
                const fileName = file.name;
                const fileExtension = fileName.split('.').pop().toLowerCase();

                if (allowedExtensions.includes(fileExtension)) {
                    const reader = new FileReader();

                    reader.onload = function(event) {
                        preview.style.backgroundImage = `url('${event.target.result}')`;
                        preview.style.backgroundSize = 'cover';
                        preview.style.backgroundPosition = 'center';
                        preview.querySelectorAll('svg, span').forEach(el => el.style.display = 'none');
                        preview.style.borderStyle = 'solid';
                    };

                    reader.readAsDataURL(file);
                } else {
                    alert('Invalid file type. Please upload PNG, JPG, WebP, GIF, or SVG.');
                    e.target.value = "";
                }
            }
        });

        removeBtn.addEventListener('click', (e) => {
            e.preventDefault();
            preview.style.backgroundImage = '';
            preview.style.borderStyle = 'dashed';
            preview.querySelectorAll('svg, span').forEach(el => el.style.display = '');
            fileInput.value = '';
        });
    </script>

</x-app-layout>
