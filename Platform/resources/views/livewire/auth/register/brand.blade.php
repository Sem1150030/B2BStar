<div class="min-h-screen flex items-center justify-center py-13 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-gray-50 to-gray-100">
    <div class="w-full max-w-xl space-y-8">
        <div class="text-center">
            <a href="/" class="inline-flex items-center gap-2">
                <span class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-600 text-white font-bold text-lg shadow-sm">B2B</span>
            </a>
            <h2 class="mt-6 text-3xl font-bold tracking-tight text-gray-900">Brand Registration</h2>
            <p class="mt-2 text-sm text-gray-600">Already have an account?
                <a href="/auth/login" class="font-medium text-indigo-600 hover:text-indigo-500">Sign in</a>
            </p>
        </div>

        <div class="rounded-2xl bg-white p-8 shadow-sm ring-1 ring-gray-200/70">
            @if (session()->has('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
            @endif
            <form action="{{ route('register.brand.action') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <div class="mt-1">
                            <input type="text" name="name" required placeholder="Brand name" class="block w-full rounded-md border-0 bg-white/50 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset placeholder:text-gray-400 focus:outline-none sm:text-sm ring-gray-300 focus:ring-2 focus:ring-indigo-600" />
                        </div>
                        @error('name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email address</label>
                        <div class="mt-1">
                            <input type="email" name="email" required placeholder="you@company.com" class="block w-full rounded-md border-0 bg-white/50 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset placeholder:text-gray-400 focus:outline-none sm:text-sm ring-gray-300 focus:ring-2 focus:ring-indigo-600" />
                        </div>
                        @error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <div class="mt-1">
                            <input type="text" name="phone" required placeholder="Phone number" class="block w-full rounded-md border-0 bg-white/50 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset placeholder:text-gray-400 focus:outline-none sm:text-sm ring-gray-300 focus:ring-2 focus:ring-indigo-600" />
                        </div>
                        @error('phone')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Finance Email</label>
                        <div class="mt-1">
                            <input type="email" name="finance_email" required placeholder="finance@company.com" class="block w-full rounded-md border-0 bg-white/50 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset placeholder:text-gray-400 focus:outline-none sm:text-sm ring-gray-300 focus:ring-2 focus:ring-indigo-600" />
                        </div>
                        @error('finance_email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Motto</label>
                        <div class="mt-1">
                            <input type="text" name="motto" placeholder="Brand motto (optional)" class="block w-full rounded-md border-0 bg-white/50 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset placeholder:text-gray-400 focus:outline-none sm:text-sm ring-gray-300 focus:ring-2 focus:ring-indigo-600" />
                        </div>
                        @error('motto')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <div class="mt-1">
                            <textarea name="description" placeholder="Describe your brand (optional)" rows="3" class="block w-full rounded-md border-0 bg-white/50 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset placeholder:text-gray-400 focus:outline-none sm:text-sm ring-gray-300 focus:ring-2 focus:ring-indigo-600"></textarea>
                        </div>
                        @error('description')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="mt-1">
                            <input type="password" name="password" required placeholder="••••••••" class="block w-full rounded-md border-0 bg-white/50 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset placeholder:text-gray-400 focus:outline-none sm:text-sm ring-gray-300 focus:ring-2 focus:ring-indigo-600" />
                        </div>
                        @error('password')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                        <div class="mt-1">
                            <input type="password" name="password_confirmation" required placeholder="••••••••" class="block w-full rounded-md border-0 bg-white/50 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset placeholder:text-gray-400 focus:outline-none sm:text-sm ring-gray-300 focus:ring-2 focus:ring-indigo-600" />
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit" class="group relative flex w-full justify-center rounded-md bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white shadow hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
