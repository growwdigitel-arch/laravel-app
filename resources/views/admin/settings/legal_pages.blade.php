@extends('layouts.admin')

@section('content')
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Legal Pages</h2>

    <div class="max-w-6xl mx-auto">
        <form id="legal-form" action="{{ route('admin.settings.legal-pages.update') }}" method="POST">
            @csrf
            
            <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <!-- Privacy Policy Card -->
                    <div class="border rounded-xl p-6 text-center hover:shadow-lg transition-all group bg-white">
                        <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2">Privacy Policy</h4>
                        <p class="text-xs text-gray-500 mb-4 line-clamp-2">{{ Str::limit($privacyPolicy, 50) }}</p>
                        <button type="button" onclick="openLegalModal('privacy_policy', 'Privacy Policy')" class="w-full py-2 px-4 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 font-medium text-sm transition-colors">
                            Edit Content
                        </button>
                        <textarea name="privacy_policy" id="privacy_policy" class="hidden">{{ $privacyPolicy }}</textarea>
                    </div>

                    <!-- Terms of Service Card -->
                    <div class="border rounded-xl p-6 text-center hover:shadow-lg transition-all group bg-white">
                        <div class="w-14 h-14 bg-purple-50 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2">Terms of Service</h4>
                        <p class="text-xs text-gray-500 mb-4 line-clamp-2">{{ Str::limit($termsOfService, 50) }}</p>
                        <button type="button" onclick="openLegalModal('terms_of_service', 'Terms of Service')" class="w-full py-2 px-4 bg-purple-50 text-purple-600 rounded-lg hover:bg-purple-100 font-medium text-sm transition-colors">
                            Edit Content
                        </button>
                        <textarea name="terms_of_service" id="terms_of_service" class="hidden">{{ $termsOfService }}</textarea>
                    </div>

                    <!-- Refund Policy Card -->
                    <div class="border rounded-xl p-6 text-center hover:shadow-lg transition-all group bg-white">
                        <div class="w-14 h-14 bg-green-50 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2">Refund Policy</h4>
                        <p class="text-xs text-gray-500 mb-4 line-clamp-2">{{ Str::limit($refundPolicy, 50) }}</p>
                        <button type="button" onclick="openLegalModal('refund_policy', 'Refund Policy')" class="w-full py-2 px-4 bg-green-50 text-green-600 rounded-lg hover:bg-green-100 font-medium text-sm transition-colors">
                            Edit Content
                        </button>
                        <textarea name="refund_policy" id="refund_policy" class="hidden">{{ $refundPolicy }}</textarea>
                    </div>

                    <!-- Cancellation Policy Card -->
                    <div class="border rounded-xl p-6 text-center hover:shadow-lg transition-all group bg-white">
                        <div class="w-14 h-14 bg-red-50 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-900 mb-2">Cancellation Policy</h4>
                        <p class="text-xs text-gray-500 mb-4 line-clamp-2">{{ Str::limit($cancellationPolicy, 50) }}</p>
                        <button type="button" onclick="openLegalModal('cancellation_policy', 'Cancellation Policy')" class="w-full py-2 px-4 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 font-medium text-sm transition-colors">
                            Edit Content
                        </button>
                        <textarea name="cancellation_policy" id="cancellation_policy" class="hidden">{{ $cancellationPolicy }}</textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Full Screen Modal -->
    <div id="legal-modal" class="fixed inset-0 z-[100] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm transition-opacity" onclick="closeLegalModal()"></div>

        <!-- Modal Panel -->
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all w-[90%] h-[85vh] flex flex-col">
                    <!-- Header -->
                    <div class="bg-white px-6 py-4 border-b border-gray-200 flex items-center justify-between flex-shrink-0">
                        <h3 class="text-xl font-bold text-gray-900" id="modal-title">Edit Content</h3>
                        <button type="button" onclick="closeLegalModal()" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                            <span class="sr-only">Close</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Content -->
                    <div class="flex-grow p-6 bg-gray-50 overflow-hidden">
                        <textarea id="modal-textarea" class="w-full h-full p-6 border-0 rounded-xl bg-white shadow-inner focus:ring-2 focus:ring-indigo-500 resize-none text-base leading-relaxed font-mono" placeholder="Enter your content here..."></textarea>
                    </div>

                    <!-- Footer -->
                    <div class="bg-white px-6 py-4 border-t border-gray-200 flex items-center justify-end gap-3 flex-shrink-0">
                        <button type="button" onclick="closeLegalModal()" class="rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Cancel
                        </button>
                        <button type="button" onclick="saveLegalModal()" class="rounded-lg border border-transparent bg-indigo-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentFieldId = null;

        function openLegalModal(fieldId, title) {
            currentFieldId = fieldId;
            document.getElementById('modal-title').innerText = 'Edit ' + title;
            document.getElementById('modal-textarea').value = document.getElementById(fieldId).value;
            document.getElementById('legal-modal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeLegalModal() {
            document.getElementById('legal-modal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            currentFieldId = null;
        }

        function saveLegalModal() {
            if (currentFieldId) {
                document.getElementById(currentFieldId).value = document.getElementById('modal-textarea').value;
                document.getElementById('legal-form').submit();
            }
        }
    </script>
@endsection
