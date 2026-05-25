<!-- Onboarding Modal Component -->
<div x-data="{
    step: 1,
    totalSteps: 4,
    show: {{ auth()->user()->needs_onboarding ? 'true' : 'false' }},
    
    nextStep() { 
        if (this.step < this.totalSteps) {
            this.step++;
        } else {
            this.completeOnboarding(); 
        }
    },
    
    prevStep() { 
        if (this.step > 1) this.step--; 
    },
    
    close() { 
        this.show = false; 
    },

    completeOnboarding() {
        fetch('/user/complete-onboarding', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(() => {
            this.show = false;
        }).catch(() => {
            this.show = false; 
        });
    }
}" 
x-show="show" 
x-cloak
@open-onboarding.window="show = true; step = 1"
class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6"
x-transition:enter="transition ease-out duration-300" 
x-transition:enter-start="opacity-0"
x-transition:enter-end="opacity-100" 
x-transition:leave="transition ease-in duration-200"
x-transition:leave-start="opacity-100" 
x-transition:leave-end="opacity-0">

    <!-- Backdrop -->
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="close()"></div>

    <!-- Modal Content -->
    <div class="relative bg-white rounded-3xl shadow-2xl max-w-lg w-full overflow-hidden transform transition-all"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0">

        <!-- Close Button -->
        <button @click="close()"
            class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 transition-colors z-10">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Progress Bar -->
        <div class="absolute top-0 left-0 w-full h-1.5 bg-slate-100">
            <div class="h-full bg-blue-600 transition-all duration-500 ease-out"
                :style="`width: ${(step / totalSteps) * 100}%`"></div>
        </div>

        <div class="p-8 pt-12">
            <!-- Step 1: Welcome -->
            <div x-show="step === 1" x-transition:enter="transition ease-out duration-300 delay-100"
                x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0">
                <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-7.714 2.143L11 21l-2.286-6.857L1 12l7.714-2.143L11 3z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-3">Welcome to Ledgerly!</h3>
                <p class="text-slate-600 mb-6 leading-relaxed">We're excited to help you streamline your invoicing.
                    Let's take a quick 1-minute tour to get you set up for success.</p>
                <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                    <p class="text-sm text-slate-500 italic">"The best way to predict the future is to create it."
                        <br><em>- Let's start creating your first invoice today.</em></p>
                </div>
            </div>

            <!-- Step 2: Business Profile -->
            <div x-show="step === 2" x-transition:enter="transition ease-out duration-300 delay-100"
                x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0">
                <div class="w-16 h-16 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 mb-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-3">Set Up Your Business</h3>
                <p class="text-slate-600 mb-6 leading-relaxed">First, head over to <b>Business Profile</b> to add your
                    business name, logo, and bank details. This information will appear on every invoice you send.</p>
                <ul class="space-y-3">
                    <li class="flex items-center text-sm text-slate-600">
                        <svg class="w-5 h-5 text-emerald-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        Upload your professional logo (optional)
                    </li>
                    <li class="flex items-center text-sm text-slate-600">
                        <svg class="w-5 h-5 text-emerald-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        Set your default currency
                    </li>
                </ul>
            </div>

            <!-- Step 3: Clients & Invoices -->
            <div x-show="step === 3" x-transition:enter="transition ease-out duration-300 delay-100"
                x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0">
                <div class="w-16 h-16 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 mb-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-3">Manage Your Clients</h3>
                <p class="text-slate-600 mb-6 leading-relaxed">Add your clients once and reuse them for all future
                    invoices. You can track how much each client has been billed directly from the <b>Clients</b> tab.
                </p>
                <div
                    class="flex items-center p-4 bg-amber-50 rounded-xl border border-amber-100 text-amber-800 text-sm">
                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Pro Tip: You can import clients via CSV to save time!
                </div>
            </div>

            <!-- Step 4: Dashboard & Analytics -->
            <div x-show="step === 4" x-transition:enter="transition ease-out duration-300 delay-100"
                x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0">
                <div class="w-16 h-16 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600 mb-6">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-3">Track Your Growth</h3>
                <p class="text-slate-600 mb-6 leading-relaxed">Your <b>Dashboard</b> gives you a bird's-eye view of
                    your revenue, outstanding payments, and active clients. Stay on top of your business health in
                    real-time.</p>
                {{-- <div class="space-y-2">
                    <div class="h-2 w-full bg-slate-100 rounded-full overflow-hidden">
                        <progress class="h-full bg-blue-500 w-3/4"></progress>
                    </div>
                    <div class="flex justify-between text-xs text-slate-400 font-medium">
                        <span>REVENUE TRACKING</span>
                        <span>75% COMPLETE</span>
                    </div>
                </div> --}}
            </div>

            <!-- Footer Actions -->
            <div class="mt-10 flex items-center justify-between">
                <button @click="prevStep()" x-show="step > 1"
                    class="text-sm font-semibold text-slate-500 hover:text-slate-800 transition-colors">
                    Back
                </button>
                <div x-show="step === 1"></div>

                <div class="flex items-center gap-2">
                    <template x-for="i in totalSteps">
                        <div class="w-1.5 h-1.5 rounded-full transition-all duration-300"
                            :class="step === i ? 'w-4 bg-blue-600' : 'bg-slate-200'"></div>
                    </template>
                </div>

                <button @click="nextStep()"
                    class="inline-flex items-center justify-center px-6 py-2.5 bg-blue-600 text-white text-sm font-bold rounded-xl hover:bg-blue-700 transition-all shadow-lg shadow-blue-100">
                    <span x-text="step === totalSteps ? 'Get Started' : 'Next Step'"></span>
                    <svg x-show="step < totalSteps" class="w-4 h-4 ml-2" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
