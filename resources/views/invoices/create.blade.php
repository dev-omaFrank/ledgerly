<x-app-layout>
    <x-auth-navbar :userInitials="$userInitials"/>

    <div x-data="appLayout()" class="flex min-h-screen bg-gradient-to-br from-slate-50 to-slate-100">
        <x-mobile-toggle-button />
        
        <div class="flex-1 p-4 sm:p-6 lg:p-8 space-y-6">

            <!-- Page Header -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div>
                    <h1 class="text-3xl sm:text-4xl font-bold text-slate-900">Create Invoice</h1>
                    <p class="text-slate-600 mt-1">Fill in the details below to create a new invoice</p>
                </div>
            </div>

            <form action="{{ route('invoices.create.post') }}" method="post" class="space-y-6">
                @csrf
                
                {{-- GLOBAL ERROR BLOCK --}}
                @if ($errors->any())
                    <div class="p-4 bg-red-50 border-l-4 border-red-500 rounded-lg shadow-sm">
                        <div class="flex items-start gap-3">
                            <svg class="h-5 w-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <h3 class="text-sm font-semibold text-red-900 mb-2">Please fix the following errors:</h3>
                                <ul class="text-red-800 text-sm space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li class="flex items-center gap-2">
                                            <span class="inline-block w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                                            {{ $error }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    <!-- LEFT SIDE -->
                    <div class="lg:col-span-2 space-y-6">

                        <!-- Invoice Details Card -->
                        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-shadow duration-200">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="p-2 bg-blue-100 rounded-lg">
                                    <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.66V6.75a9 9 0 015.25-1.526c.055 0 .11 0 .162.01.868-.021 1.713.211 2.406.673a2.25 2.25 0 012.25 2.25v12.75c0 1.141-.901 2.112-2.064 2.192m-7.889-14.071A8.973 8.973 0 0112 15.75c2.9 0 5.461 1.04 7.5 2.75m0 0A8.973 8.973 0 0112 20.25c-2.9 0-5.461-1.04-7.5-2.75" />
                                    </svg>
                                </div>
                                <h2 class="text-lg font-semibold text-slate-900">Invoice Details</h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                <!-- Client Select -->
                                <div>
                                    <label class="block text-sm font-semibold text-slate-900 mb-2">Send to: Client Name</label>
                                    <select name="client_id" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all bg-white text-slate-900 placeholder-slate-400" required>
                                        <option value="">Select a client</option>
                                        @forelse($clients as $client)
                                            <option value="{{ $client->id }}">
                                                {{ $client->client_name }} ({{ $client->client_email }})
                                            </option>
                                        @empty
                                            <option disabled>No clients available</option>
                                        @endforelse
                                    </select>
                                </div>

                                <!-- Business Select -->
                                <div>
                                    <label class="block text-sm font-semibold text-slate-900 mb-2">Sent by: Business Name</label>
                                    <select name="business_id" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all bg-white text-slate-900 placeholder-slate-400" required>
                                        <option value="">Select your business</option>
                                        @forelse($businesses as $business)
                                            <option value="{{ $business->id }}">
                                                {{ $business->business_name }} ({{ $business->business_email }})
                                            </option>
                                        @empty
                                            <option disabled>You have not created any businesses</option>
                                        @endforelse
                                    </select>
                                </div>

                                <!-- Invoice Number -->
                                <div>
                                    <label class="block text-sm font-semibold text-slate-900 mb-2">Invoice Number</label>
                                    <input type="text" name="invoice_number" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all bg-white text-slate-900 placeholder-slate-400" value="INV-001" required>
                                </div>

                                <!-- Invoice Date -->
                                <div>
                                    <label class="block text-sm font-semibold text-slate-900 mb-2">Invoice Date</label>
                                    <input type="date" name="issue_date" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all bg-white text-slate-900 placeholder-slate-400" value="{{ date('Y-m-d') }}" required>
                                </div>

                                <!-- Due Date -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-slate-900 mb-2">Due Date</label>
                                    <input type="date" name="due_date" class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all bg-white text-slate-900 placeholder-slate-400" value="{{ date('Y-m-d', strtotime('+14 days')) }}" required>
                                </div>

                            </div>
                        </div>

                        <!-- Line Items Card -->
                        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow duration-200">

                            <div class="px-6 py-4 border-b border-slate-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-gradient-to-r from-slate-50 to-white">
                                <div class="flex items-center gap-3">
                                    <div class="p-2 bg-blue-100 rounded-lg">
                                        <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 01-1.125-1.125M3.375 19.5h0c0 .621.504 1.125 1.125 1.125m17.25-17.25h0c.621 0 1.125.504 1.125 1.125m0 0A1.125 1.125 0 0021 4.875m-9 3h.008v.008H12v-.008m0 0a1.125 1.125 0 110-2.25 1.125 1.125 0 010 2.25zm0 0H9.375m0 0a1.125 1.125 0 110-2.25 1.125 1.125 0 010 2.25zm0 0H5.625m0 0a1.125 1.125 0 110-2.25 1.125 1.125 0 010 2.25zm12 0h.008v.008H17.625v-.008m0 0a1.125 1.125 0 110-2.25 1.125 1.125 0 010 2.25z" />
                                        </svg>
                                    </div>
                                    <h2 class="text-lg font-semibold text-slate-900">Line Items</h2>
                                </div>

                                <button type="button"
                                        @click="addItem"
                                        class="w-full sm:w-auto px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 active:bg-blue-800 transition-colors duration-200 flex items-center justify-center gap-2 shadow-sm">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    Add Item
                                </button>
                            </div>

                            <div class="p-6 overflow-x-auto">
                                <table class="min-w-full">

                                    <thead>
                                        <tr class="border-b-2 border-slate-200 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">
                                            <th class="py-3 pr-4">Description</th>
                                            <th class="py-3 px-4 w-20 text-center">Qty</th>
                                            <th class="py-3 px-4 w-28 text-right">Price</th>
                                            <th class="py-3 px-4 w-28 text-right">Total</th>
                                            <th class="py-3 w-12 text-center">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody class="divide-y divide-slate-100">
                                        <template x-for="(item, index) in items" :key="index">
                                            <tr class="hover:bg-blue-50/50 transition-colors duration-150">
                                                <td class="py-4 pr-4">
                                                    <input type="text"
                                                        :name="`items[${index}][description]`"
                                                        x-model="item.description"
                                                        class="w-full px-3 py-2 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all text-slate-900 placeholder-slate-400"
                                                        placeholder="Item description"
                                                        required>
                                                </td>

                                                <td class="py-4 px-4">
                                                    <input type="number"
                                                        :name="`items[${index}][quantity]`"
                                                        x-model.number="item.quantity"
                                                        class="w-full px-3 py-2 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all text-center text-slate-900 placeholder-slate-400"
                                                        min="1"
                                                        required>
                                                </td>

                                                <td class="py-4 px-4">
                                                    <input type="number"
                                                        :name="`items[${index}][price]`"
                                                        x-model.number="item.price"
                                                        class="w-full px-3 py-2 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all text-right text-slate-900 placeholder-slate-400"
                                                        step="1"
                                                        min="0"
                                                        required>
                                                </td>

                                                <td class="py-4 px-4 text-right">
                                                    <span class="text-sm font-bold text-blue-600"
                                                        x-text="formatCurrency(item.quantity * item.price)">
                                                    </span>
                                                </td>

                                                <td class="py-4 text-center">
                                                    <button type="button"
                                                            @click="removeItem(index)"
                                                            class="text-slate-400 hover:text-red-600 active:text-red-700 transition-colors duration-200 font-medium text-sm p-1 hover:bg-red-50 rounded">
                                                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>

                                </table>

                                <!-- Empty State -->
                                <template x-if="items.length === 0">
                                    <div class="text-center py-12">
                                        <svg class="h-12 w-12 text-slate-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m0 0C5.25 5.547 8.694 5 12 5c3.306 0 6.75.547 8.25 1.375" />
                                        </svg>
                                        <p class="text-slate-500 font-medium">No items added yet</p>
                                        <p class="text-slate-400 text-sm mt-1">Click "Add Item" to start adding line items</p>
                                    </div>
                                </template>
                            </div>
                        </div>

                    </div>

                    <!-- RIGHT SIDE (Summary) -->
                    <div class="space-y-6">

                        <!-- Summary Card -->
                        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-shadow duration-200 sticky top-6">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="p-2 bg-blue-100 rounded-lg">
                                    <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0l.879-.659m-3.172-2.819a3 3 0 00-4.457-2.066M9 7h.008v.008H9V7zm5 0h.008v.008H14V7zm4 6h.008v.008h-.008v-.008zm-12 0h.008v.008H7v-.008z" />
                                    </svg>
                                </div>
                                <h2 class="text-lg font-semibold text-slate-900">Summary</h2>
                            </div>

                            <div class="space-y-4">

                                <!-- Subtotal -->
                                <div class="flex justify-between items-center pb-4 border-b border-slate-200">
                                    <span class="text-sm font-medium text-slate-600">Subtotal</span>
                                    <span class="text-sm font-semibold text-slate-900"
                                        x-text="formatCurrency(getSubtotal())">NGN 0.00</span>
                                    <input type="hidden"
                                        name="subtotal"
                                        :value="getSubtotal().toFixed(2)">
                                </div>

                                <!-- Tax -->
                                <div class="flex justify-between items-center pb-4 border-b border-slate-200">
                                    <label class="text-sm font-medium text-slate-600">Tax (%)</label>
                                    <input type="number"
                                        name="tax"
                                        x-model.number="taxRate"
                                        class="w-20 px-3 py-1.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all text-right text-slate-900 text-sm"
                                        step="0.01"
                                        min="0">
                                </div>

                                <!-- Discount -->
                                <div class="flex justify-between items-center pb-4 border-b border-slate-200">
                                    <label class="text-sm font-medium text-slate-600">Discount (NGN)</label>
                                    <input type="number"
                                        name="discount"
                                        x-model.number="discount"
                                        class="w-24 px-3 py-1.5 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all text-right text-slate-900 text-sm"
                                        step="0.01"
                                        min="0">
                                </div>

                                <!-- Total -->
                                <div class="pt-4 flex justify-between items-center bg-gradient-to-r from-blue-50 to-blue-50/50 p-4 rounded-lg border border-blue-200">
                                    <span class="font-bold text-slate-900">Total</span>
                                    <span class="text-2xl font-bold text-blue-600"
                                        x-text="formatCurrency(getTotal())">NGN 0.00</span>
                                    <input type="hidden"
                                        name="total"
                                        :value="getTotal().toFixed(2)">
                                </div>

                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-8 space-y-3">
                                <button type="submit" class="w-full px-4 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 active:bg-blue-800 transition-colors duration-200 shadow-sm flex items-center justify-center gap-2">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    Save Invoice
                                </button>

                                {{-- <button type="button"
                                        class="w-full px-4 py-3 border-2 border-slate-300 text-slate-900 font-semibold rounded-lg hover:bg-slate-50 active:bg-slate-100 transition-colors duration-200 flex items-center justify-center gap-2">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C6.5 6.253 2 10.998 2 17s4.5 10.747 10 10.747c5.5 0 10-4.998 10-10.747S17.5 6.253 12 6.253z" />
                                    </svg>
                                    Preview PDF
                                </button> --}}
                            </div>
                        </div>

                        <!-- Notes & Terms Card -->
                        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-shadow duration-200">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="p-2 bg-blue-100 rounded-lg">
                                    <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.66V6.75a9 9 0 015.25-1.526c.055 0 .11 0 .162.01.868-.021 1.713.211 2.406.673a2.25 2.25 0 012.25 2.25v12.75c0 1.141-.901 2.112-2.064 2.192m-7.889-14.071A8.973 8.973 0 0112 15.75c2.9 0 5.461 1.04 7.5 2.75m0 0A8.973 8.973 0 0112 20.25c-2.9 0-5.461-1.04-7.5-2.75" />
                                    </svg>
                                </div>
                                <h3 class="text-sm font-semibold text-slate-900">Notes & Terms</h3>
                            </div>
                            <textarea name="notes" class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all bg-white text-slate-900 placeholder-slate-400 resize-none"
                                    placeholder="Additional notes for the client..." rows="6"></textarea>
                        </div>

                    </div>

                </div>

                <!-- Hidden Inputs -->
                <input type="hidden" id="currency" name="currency" :value="currency" />
                <input type="hidden" id="status" name="status" value="draft" />
            </form>

        </div>
    </div>

    <script>
    function appLayout() {
        return {
            currency: 'NGN',
            sidebarOpen: false,
            items: [{ description: '', quantity: 1, price: 0 }],
            taxRate: 10,
            discount: 0,

            addItem() {
                this.items.push({ description: '', quantity: 1, price: 0 });
            },

            removeItem(index) {
                if (this.items.length > 1) {
                    this.items.splice(index, 1);
                } else {
                    alert('You must have at least one line item');
                }
            },

            getSubtotal() {
                return this.items.reduce((sum, item) => 
                    sum + (item.quantity * item.price), 0);
            },

            getTotal() {
                return this.getSubtotal() +
                       (this.getSubtotal() * (this.taxRate / 100)) -
                       this.discount;
            },

            formatCurrency(amount) {
                return new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: this.currency
                }).format(amount);
            }
        }
    }
    </script>

</x-app-layout>
