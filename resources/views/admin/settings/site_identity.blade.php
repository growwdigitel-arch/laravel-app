@extends('layouts.admin')

@section('content')
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Site Identity</h2>

    <div class="max-w-4xl mx-auto">
        <form action="{{ route('admin.settings.site-identity.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6 space-y-6">
                    <div>
                        <label for="site_title" class="block text-sm font-medium text-gray-700 mb-1">Site Title</label>
                        <input type="text" name="site_title" id="site_title" value="{{ $siteTitle }}" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border"
                            placeholder="e.g. MyVoiceApp">
                    </div>
                    <div>
                        <label for="site_logo" class="block text-sm font-medium text-gray-700 mb-1">Site Logo</label>
                        <input type="file" name="site_logo" id="site_logo" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        @if($siteLogo)
                            <div class="mt-2">
                                <img src="{{ asset($siteLogo) }}" alt="Current Logo" class="h-12 w-auto object-contain">
                            </div>
                        @endif
                    </div>
                    <div>
                        <label for="footer_get_in_touch" class="block text-sm font-medium text-gray-700 mb-1">Footer "Get in Touch" Text</label>
                        <textarea name="footer_get_in_touch" id="footer_get_in_touch" rows="5" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border"
                            placeholder="Enter footer contact text here...">{{ $footerGetInTouch }}</textarea>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 text-right">
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 font-medium shadow-sm transition-all">
                        Save Changes
                    </button>
                </div>
            </div>
        </form>
        <div class="mt-12">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-800">Visual Editor</h3>
        </div>
        
        <!-- Preview Card Trigger -->
        <div class="group relative cursor-pointer rounded-xl overflow-hidden border-2 border-dashed border-gray-300 hover:border-indigo-500 transition-all duration-300 bg-gray-50 hover:bg-white shadow-sm hover:shadow-md" onclick="openVisualEditor()">
            <div class="aspect-w-16 aspect-h-9 w-full h-64 relative overflow-hidden">
                <!-- Thumbnail Image -->
                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80" alt="Home Page Preview" class="w-full h-full object-cover opacity-50 group-hover:opacity-75 transition-opacity duration-300 filter blur-[1px] group-hover:blur-0">
                
                <!-- Overlay Content -->
                <div class="absolute inset-0 flex items-center justify-center bg-black/10 group-hover:bg-black/0 transition-colors">
                    <div class="text-center p-6 bg-white/90 backdrop-blur-sm rounded-xl shadow-lg transform group-hover:scale-105 transition-transform duration-300">
                        <div class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 mb-1">Launch Visual Editor</h4>
                        <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Click to Edit Home Page</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Visual Editor Modal -->
    <div id="visual-editor-modal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-90 transition-opacity backdrop-blur-sm"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-2xl transition-all sm:w-[95%] h-[95vh] flex flex-col">
                    
                    <!-- Modal Header -->
                    <div class="bg-white px-4 py-3 sm:px-6 border-b border-gray-200 flex items-center justify-between">
                        <h3 class="text-lg font-semibold leading-6 text-gray-900" id="modal-title">Visual Editor</h3>
                        <div class="flex items-center gap-3">
                            <button type="button" onclick="saveVisualChanges(false)" class="inline-flex justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                Save
                            </button>
                            <button type="button" onclick="saveVisualChanges(true)" class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Save & Close
                            </button>
                            <button type="button" onclick="closeVisualEditor()" class="text-gray-400 hover:text-gray-500 ml-4">
                                <span class="sr-only">Close</span>
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Modal Body (Iframe) -->
                    <div class="flex-1 bg-gray-100 relative">
                        <div id="loading-spinner" class="absolute inset-0 flex items-center justify-center bg-white z-20">
                            <svg class="animate-spin h-10 w-10 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                        <iframe id="visual-editor-frame" class="w-full h-full border-0" title="Visual Editor"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openVisualEditor() {
            const modal = document.getElementById('visual-editor-modal');
            const iframe = document.getElementById('visual-editor-frame');
            const spinner = document.getElementById('loading-spinner');
            
            modal.classList.remove('hidden');
            spinner.style.display = 'flex';
            
            // Load iframe content only when opening modal
            iframe.src = "{{ route('home', ['edit_mode' => 'true', 'embedded' => 'true']) }}";
            
            iframe.onload = function() {
                spinner.style.display = 'none';
            };
        }

        function closeVisualEditor() {
            const modal = document.getElementById('visual-editor-modal');
            const iframe = document.getElementById('visual-editor-frame');
            
            modal.classList.add('hidden');
            iframe.src = 'about:blank'; // Clear iframe to stop media/scripts
        }

        function saveVisualChanges(closeAfterSave) {
            const iframe = document.getElementById('visual-editor-frame');
            
            if (iframe.contentWindow && iframe.contentWindow.saveVisualChanges) {
                // Show saving state on buttons (optional enhancement)
                
                iframe.contentWindow.saveVisualChanges()
                    .then(data => {
                        if (closeAfterSave) {
                            closeVisualEditor();
                            // Optional: Show global success toast
                        }
                        // Optional: Show success feedback in modal
                    })
                    .catch(error => {
                        alert('Failed to save changes: ' + error);
                    });
            } else {
                alert('Editor is not ready yet.');
            }
        }
    </script>
</div>
@endsection
