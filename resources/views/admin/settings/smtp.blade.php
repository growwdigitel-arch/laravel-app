@extends('layouts.admin')

@section('content')
    <h2 class="text-3xl font-bold text-gray-800 mb-6">SMTP Settings</h2>

    <div class="max-w-4xl mx-auto">
        <form action="{{ route('admin.settings.smtp.update') }}" method="POST">
            @csrf
            
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="smtp_host" class="block text-sm font-medium text-gray-700 mb-1">SMTP Host</label>
                            <input type="text" name="smtp_host" id="smtp_host" value="{{ $smtpHost }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border" placeholder="e.g. smtp.gmail.com">
                        </div>
                        <div>
                            <label for="smtp_port" class="block text-sm font-medium text-gray-700 mb-1">SMTP Port</label>
                            <input type="text" name="smtp_port" id="smtp_port" value="{{ $smtpPort }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border" placeholder="e.g. 587">
                        </div>
                        <div>
                            <label for="smtp_username" class="block text-sm font-medium text-gray-700 mb-1">SMTP Username</label>
                            <input type="text" name="smtp_username" id="smtp_username" value="{{ $smtpUsername }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border">
                        </div>
                        <div>
                            <label for="smtp_password" class="block text-sm font-medium text-gray-700 mb-1">SMTP Password</label>
                            <input type="password" name="smtp_password" id="smtp_password" value="{{ $smtpPassword }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border">
                        </div>
                        <div>
                            <label for="smtp_encryption" class="block text-sm font-medium text-gray-700 mb-1">Encryption</label>
                            <select name="smtp_encryption" id="smtp_encryption" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border">
                                <option value="tls" {{ $smtpEncryption === 'tls' ? 'selected' : '' }}>TLS</option>
                                <option value="ssl" {{ $smtpEncryption === 'ssl' ? 'selected' : '' }}>SSL</option>
                                <option value="" {{ empty($smtpEncryption) ? 'selected' : '' }}>None</option>
                            </select>
                        </div>
                        <div>
                            <label for="smtp_from_address" class="block text-sm font-medium text-gray-700 mb-1">From Address</label>
                            <input type="email" name="smtp_from_address" id="smtp_from_address" value="{{ $smtpFromAddress }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border" placeholder="e.g. no-reply@example.com">
                        </div>
                        <div>
                            <label for="smtp_from_name" class="block text-sm font-medium text-gray-700 mb-1">From Name</label>
                            <input type="text" name="smtp_from_name" id="smtp_from_name" value="{{ $smtpFromName }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border" placeholder="e.g. ChatterGlow Support">
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 text-right">
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 font-medium shadow-sm transition-all">
                        Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
