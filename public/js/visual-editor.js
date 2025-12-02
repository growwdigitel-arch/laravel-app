document.addEventListener('DOMContentLoaded', function () {
    const saveButton = document.getElementById('save-visual-changes');
    const isEmbedded = new URLSearchParams(window.location.search).get('embedded') === 'true';

    // Hide internal controls if embedded
    if (isEmbedded && saveButton) {
        const visualEditorControls = document.getElementById('visual-editor-controls');
        if (visualEditorControls) {
            visualEditorControls.style.display = 'none';
        }
    }

    // Expose save function globally
    window.saveVisualChanges = function () {
        return new Promise((resolve, reject) => {
            const editableElements = document.querySelectorAll('[data-setting-key]');
            const changes = {};

            editableElements.forEach(element => {
                const key = element.getAttribute('data-setting-key');
                let value;

                if (element.tagName === 'IMG') {
                    value = element.getAttribute('src');
                } else {
                    value = element.innerText.trim();
                }

                changes[key] = value;
            });

            // Send to backend
            fetch('/admin/settings/ajax-update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(changes)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        resolve(data);
                    } else {
                        reject(data.message || 'Unknown error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    reject(error);
                });
        });
    };

    if (saveButton) {
        saveButton.addEventListener('click', function () {
            // Show loading state
            const originalText = saveButton.innerHTML;
            saveButton.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Saving...
            `;
            saveButton.disabled = true;

            window.saveVisualChanges()
                .then(() => {
                    // Show success state
                    saveButton.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Saved!
                    `;
                    saveButton.classList.remove('bg-green-600', 'hover:bg-green-700');
                    saveButton.classList.add('bg-green-500', 'hover:bg-green-600');

                    setTimeout(() => {
                        saveButton.innerHTML = originalText;
                        saveButton.disabled = false;
                        saveButton.classList.add('bg-green-600', 'hover:bg-green-700');
                        saveButton.classList.remove('bg-green-500', 'hover:bg-green-600');
                    }, 2000);
                })
                .catch(error => {
                    alert('Failed to save changes: ' + error);
                    saveButton.innerHTML = originalText;
                    saveButton.disabled = false;
                });
        });
    }
});
