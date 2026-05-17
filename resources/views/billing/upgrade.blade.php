<!-- Payment/Upgrade Page - Copy and paste into your Blade file -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upgrade to Pro - Ledgerly</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-3K0N15VKRE"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-3K0N15VKRE');
    </script>

    <style>
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-in {
            animation: slideIn 0.3s ease-out;
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .payment-input {
            transition: all 0.2s ease;
        }

        .payment-input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 to-slate-100">
    <!-- Navigation -->
    <nav class="sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-slate-200/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-2">
                    <div class="h-8 w-8 rounded-lg bg-blue-600 flex items-center justify-center">
                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                        </svg>
                    </div>
                    <span class="text-lg font-bold text-slate-900">Ledgerly</span>
                </div>
                <a href="{{ route('pages.dashboard') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">
                    Back to Dashboard
                </a>
            </div>
        </div>
    </nav>

    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl sm:text-5xl font-bold text-slate-900 mb-4">Upgrade to Pro</h1>
                <p class="text-xl text-slate-600">Unlock unlimited invoices and premium features</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column: Plan Details -->
                <div class="lg:col-span-2">
                    <!-- Current Plan Info -->
                    <div class="bg-white rounded-2xl p-8 border border-slate-200 mb-8">
                        <h2 class="text-2xl font-bold text-slate-900 mb-6">Your Current Plan</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="p-4 bg-slate-50 rounded-lg border border-slate-200">
                                <p class="text-sm text-slate-600 font-medium">Current Plan</p>
                                <p class="text-2xl font-bold text-slate-900 mt-1">Free</p>
                                <p class="text-sm text-slate-600 mt-2">₦0/month</p>
                            </div>
                            <div class="p-4 bg-slate-50 rounded-lg border border-slate-200">
                                <p class="text-sm text-slate-600 font-medium">Invoices Used</p>
                                <p class="text-2xl font-bold text-slate-900 mt-1">{{ $invoices->count() }}/3</p>
                                <div class="mt-3 w-full bg-slate-200 rounded-full h-2">
                                    <?php $percentageValue = ($invoices->count() / 3) * 100?>
                                    <div class="bg-blue-600 h-2 rounded-full" style="{{ $percentageValue }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Plan Comparison -->
                    <div class="bg-white rounded-2xl p-8 border border-slate-200">
                        <h2 class="text-2xl font-bold text-slate-900 mb-6">What You'll Get</h2>
                        <x-pro-features/>
                    </div>
                </div>

                <!-- Right Column: Payment Form -->
                <div class="lg:col-span-1">
                    <!-- Price Card -->
                    <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl p-8 text-white mb-8 card-hover">
                        <h3 class="text-2xl font-bold mb-2">Pro Plan</h3>
                        <div class="mb-6">
                            <span class="text-5xl font-bold">₦2500</span>
                            <span class="text-blue-100 ml-2">/month</span>
                        </div>
                        <p class="text-blue-100 text-sm mb-6">Billed monthly. Cancel anytime.</p>
                        <div class="space-y-3 text-sm">
                            <div class="flex items-center gap-2">
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span>Unlimited invoices</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span>Personalised template</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span>Early access to new features</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span>Priority support</span>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Form -->
                    <div class="bg-white rounded-2xl p-8 border border-slate-200 card-hover">
                        <h3 class="text-xl font-bold text-slate-900 mb-6">Payment Details</h3>
                        
                        <form action="{{ route('payments.initialize') }}" method="POST" class="space-y-5">
                            @csrf

                            <!-- Card Holder Name -->
                            <div>
                                <label for="cardholder" class="block text-sm font-semibold text-slate-900 mb-2">Cardholder Name</label>
                                <input 
                                    type="text" 
                                    id="cardholder" 
                                    name="cardholder_name" 
                                    required 
                                    class="payment-input w-full px-4 py-3 rounded-lg border border-slate-300 outline-none placeholder-slate-400"
                                    placeholder="John Doe"
                                >
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-semibold text-slate-900 mb-2">Email Address</label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    value="{{ auth()->user()->email ?? '' }}"
                                    required 
                                    class="payment-input w-full px-4 py-3 rounded-lg border border-slate-300 outline-none placeholder-slate-400"
                                    placeholder="you@example.com"
                                    readonly
                                >
                            </div>

                            <!-- Card Number -->
                            <div>
                                <label for="card" class="block text-sm font-semibold text-slate-900 mb-2">Card Number</label>
                                <input 
                                    type="text" 
                                    id="card" 
                                    name="card_number" 
                                    required 
                                    maxlength="19"
                                    class="payment-input w-full px-4 py-3 rounded-lg border border-slate-300 outline-none placeholder-slate-400"
                                    placeholder="1234 5678 9012 3456"
                                >
                            </div>

                            <!-- Expiry & CVV -->
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="expiry" class="block text-sm font-semibold text-slate-900 mb-2">Expiry Date</label>
                                    <input 
                                        type="text" 
                                        id="expiry" 
                                        name="expiry_date" 
                                        required 
                                        maxlength="5"
                                        class="payment-input w-full px-4 py-3 rounded-lg border border-slate-300 outline-none placeholder-slate-400"
                                        placeholder="MM/YY"
                                    >
                                </div>
                                <div>
                                    <label for="cvv" class="block text-sm font-semibold text-slate-900 mb-2">CVV</label>
                                    <input 
                                        type="number" 
                                        id="cvv" 
                                        name="cvv" 
                                        required 
                                        maxlength="4"
                                        class="payment-input w-full px-4 py-3 rounded-lg border border-slate-300 outline-none placeholder-slate-400"
                                        placeholder="123"
                                    >
                                </div>

                                <div style="display: none">
                                    <label for="amount" class="block text-sm font-semibold text-slate-900 mb-2">Amount</label>
                                    <input 
                                        id="amount" 
                                        name="amount" 
                                        required 
                                        value="2500"
                                        maxlength="4"
                                        class="payment-input w-full px-4 py-3 rounded-lg border border-slate-300 outline-none placeholder-slate-400"
                                    >
                                </div>
                            </div>

                            <!-- Billing Address -->
                            {{-- <div>
                                <label for="address" class="block text-sm font-semibold text-slate-900 mb-2">Billing Address</label>
                                <input 
                                    type="text" 
                                    id="address" 
                                    name="billing_address" 
                                    required 
                                    class="payment-input w-full px-4 py-3 rounded-lg border border-slate-300 outline-none placeholder-slate-400"
                                    placeholder="123 Main St"
                                >
                            </div>

                            <!-- City, State, ZIP -->
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="city" class="block text-sm font-semibold text-slate-900 mb-2">City</label>
                                    <input 
                                        type="text" 
                                        id="city" 
                                        name="city" 
                                        required 
                                        class="payment-input w-full px-4 py-3 rounded-lg border border-slate-300 outline-none placeholder-slate-400"
                                        placeholder="New York"
                                    >
                                </div>
                                <div>
                                    <label for="zip" class="block text-sm font-semibold text-slate-900 mb-2">ZIP Code</label>
                                    <input 
                                        type="text" 
                                        id="zip" 
                                        name="zip_code" 
                                        required 
                                        class="payment-input w-full px-4 py-3 rounded-lg border border-slate-300 outline-none placeholder-slate-400"
                                        placeholder="10001"
                                    >
                                </div>
                            </div> --}}



                            <!-- Terms Checkbox -->
                            <label class="flex items-start gap-3 cursor-pointer">
                                <input 
                                    type="checkbox" 
                                    name="terms" 
                                    required
                                    class="w-4 h-4 rounded border-slate-300 text-blue-600 mt-1"
                                >
                                <span class="text-sm text-slate-600">
                                    I agree to the billing terms and authorize this charge
                                </span>
                            </label>

                            <!-- Submit Button -->
                            <button 
                                type="submit" 
                                class="w-full py-3 px-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center justify-center gap-2"
                            >
                                <svg  xmlns="http://www.w3.org/2000/svg" width="24" height="24"  
                                    fill="currentColor" viewBox="0 0 24 24" >
                                    <!--Boxicons v3.0.8 https://boxicons.com | License  https://docs.boxicons.com/free-->
                                    <path d="M21 8H7c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h14c.55 0 1-.45 1-1V9c0-.55-.45-1-1-1m-1 8c-1.1 0-2 .9-2 2h-8c0-1.1-.9-2-2-2v-4c1.1 0 2-.9 2-2h8c0 1.1.9 2 2 2z"></path><path d="M18 4H3c-.55 0-1 .45-1 1v11h2V6h14zm-4 8a2 2 0 1 0 0 4 2 2 0 1 0 0-4"></path>
                                </svg>
                                Pay with card                            </button>

                            <button 
                                type="button" 
                                class="w-full py-3 px-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center justify-center gap-2"
                            >
                                <svg  xmlns="http://www.w3.org/2000/svg" width="24" height="24"  
                                    fill="currentColor" viewBox="0 0 24 24" >
                                    <!--Boxicons v3.0.8 https://boxicons.com | License  https://docs.boxicons.com/free-->
                                    <path d="M20.56 3.17c-.29-.2-.67-.23-.99-.08l-17 8.01a.999.999 0 0 0 .03 1.82L8 15.28V22l5.84-4.17 4.76 2.08c.13.06.26.08.4.08.18 0 .36-.05.52-.15a.99.99 0 0 0 .48-.79l1-15c.02-.35-.14-.69-.43-.89Zm-2.47 14.34-5.21-2.28L16 9l-7.65 4.25-2.93-1.28 13.47-6.34-.79 11.89Z"></path>
                                </svg>
                                Pay via bank transfer
                            </button>

                            <!-- Security Info -->
                            <div class="flex items-center justify-center gap-2 pt-4 border-t border-slate-200">
                                <svg class="h-4 w-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-xs text-slate-600">Secure payment powered by <b>PayStack</b></span>
                            </div>
                        </form>

                        <!-- Error Messages -->
                        @if ($errors->any())
                            <div class="mt-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                                <p class="text-sm font-semibold text-red-900 mb-2">Payment failed</p>
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li class="text-sm text-red-700">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    <!-- Money Back Guarantee -->
                    {{-- <div class="mt-8 p-4 bg-green-50 border border-green-200 rounded-lg text-center">
                        <p class="text-sm text-green-900">
                            <strong>30-day money-back guarantee</strong><br>
                            Not satisfied? Get a full refund.
                        </p>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="border-t border-slate-200 bg-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col sm:flex-row items-center justify-between">
                <p class="text-sm text-slate-600">© 2024 Ledgerly. All rights reserved.</p>
                <div class="flex gap-6 mt-4 sm:mt-0">
                    <a href="#" class="text-sm text-slate-600 hover:text-slate-900 transition-colors">Privacy</a>
                    <a href="#" class="text-sm text-slate-600 hover:text-slate-900 transition-colors">Terms</a>
                    <a href="#" class="text-sm text-slate-600 hover:text-slate-900 transition-colors">Support</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
<div>
    <!-- The whole future lies in uncertainty: live immediately. - Seneca -->
</div>
