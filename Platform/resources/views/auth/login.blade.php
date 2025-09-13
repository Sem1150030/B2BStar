@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center py-13 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-gray-50 to-gray-100">
	<div class="w-full max-w-md space-y-8">
		<div class="text-center">
			<a href="/" class="inline-flex items-center gap-2">
				<span class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-600 text-white font-bold text-lg shadow-sm">B2B</span>
			</a>
			<h2 class="mt-6 text-3xl font-bold tracking-tight text-gray-900">Sign in to your account</h2>
			<p class="mt-2 text-sm text-gray-600">Or
				<a href="/auth/register" class="font-medium text-indigo-600 hover:text-indigo-500">Sign Up</a>
			</p>
		</div>

		<div class="rounded-2xl bg-white p-8 shadow-sm ring-1 ring-gray-200/70">
			<form action="{{ route('login.action') }}" method="POST" class="space-y-6" novalidate>
				@csrf
				<!-- Email -->
				<div>
					<label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
					<div class="mt-1">
						@php($emailError = $errors->has('email'))
						<input id="email" name="email" type="email" autocomplete="email" required placeholder="you@company.com" value="{{ old('email') }}" class="block w-full rounded-md border-0 bg-white/50 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset placeholder:text-gray-400 focus:outline-none sm:text-sm {{ $emailError ? 'ring-red-400 focus:ring-2 focus:ring-red-500' : 'ring-gray-300 focus:ring-2 focus:ring-indigo-600' }}" />
					</div>
					@error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
				</div>

				<!-- Password -->
				<div>
					<div class="flex items-center justify-between">
						<label for="password" class="block text-sm font-medium text-gray-700">Password</label>
						<a href="#" class="text-xs font-medium text-indigo-600 hover:text-indigo-500">Forgot?</a>
					</div>
					<div class="mt-1">
						@php($passwordError = $errors->has('password'))
						<input id="password" name="password" type="password" autocomplete="current-password" required placeholder="••••••••" class="block w-full rounded-md border-0 bg-white/50 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset placeholder:text-gray-400 focus:outline-none sm:text-sm {{ $passwordError ? 'ring-red-400 focus:ring-2 focus:ring-red-500' : 'ring-gray-300 focus:ring-2 focus:ring-indigo-600' }}" />
					</div>
					@error('password')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
				</div>

				<!-- Remember -->
				<div class="flex items-center justify-between">
					<label class="flex items-center gap-2 text-sm text-gray-700">
						<input type="checkbox" name="remember" value="1" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" {{ old('remember') ? 'checked' : '' }}>
						<span>Remember me</span>
					</label>
				</div>

				<!-- Submit Button -->
				<div>
					<button type="submit" class="group relative flex w-full justify-center rounded-md bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white shadow hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition">
						<span class="absolute inset-y-0 left-0 flex items-center pl-3">
							<svg class="h-5 w-5 text-indigo-200 group-hover:text-white transition" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M10 2a6 6 0 0 0-6 6v2.586L2.293 13.293a1 1 0 0 0 1.414 1.414L6 12.414V8a4 4 0 1 1 8 0v4.414l2.293 2.293a1 1 0 0 0 1.414-1.414L16 10.586V8a6 6 0 0 0-6-6Z"/></svg>
						</span>
						Sign in
					</button>
				</div>

				<!-- Divider -->
				<div class="relative text-center">
					<span class="relative z-10 bg-white px-2 text-xs font-medium text-gray-400">Or continue with</span>
					<span class="absolute left-0 top-1/2 h-px w-full -translate-y-1/2 bg-gray-200"></span>
				</div>

				<!-- Social (placeholder) -->
				<div class="grid grid-cols-3 gap-3">
					<button type="button" class="inline-flex w-full items-center justify-center gap-2 rounded-md border border-gray-300 bg-white px-2 py-2 text-xs font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
						<svg viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4"><path d="M12 2C6.477 2 2 6.486 2 12.017 2 17.01 5.657 21.128 10.438 22v-7.027H7.898v-2.956h2.54V9.845c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.261c-1.243 0-1.63.773-1.63 1.562v1.873h2.773l-.443 2.956h-2.33V22C18.343 21.128 22 17.01 22 12.017 22 6.486 17.523 2 12 2Z"/></svg>
						<span class="sr-only">Facebook</span>
					</button>
					<button type="button" class="inline-flex w-full items-center justify-center gap-2 rounded-md border border-gray-300 bg-white px-2 py-2 text-xs font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
						<svg viewBox="0 0 24 24" class="h-4 w-4" fill="currentColor"><path d="M20.283 10.356h-8.327v3.451h4.792c-.207 1.125-.833 2.077-1.781 2.712v2.258h2.873c1.68-1.547 2.649-3.825 2.649-6.529 0-.626-.057-1.23-.164-1.892z"/><path d="M11.956 21.5c2.394 0 4.401-.783 5.867-2.133l-2.873-2.258c-.782.525-1.783.848-2.994.848-2.3 0-4.245-1.548-4.939-3.63H4.03v2.288A9.544 9.544 0 0 0 11.956 21.5z"/><path d="M7.017 12c0-.626.103-1.23.288-1.818V7.894H4.03A9.503 9.503 0 0 0 2.5 12c0 1.568.371 3.053 1.03 4.106l2.774-2.288A4.967 4.967 0 0 1 7.017 12z"/><path d="M11.956 7.032c1.307 0 2.48.451 3.407 1.307l2.559-2.559C16.357 4.62 14.35 3.75 11.956 3.75A9.544 9.544 0 0 0 4.03 7.894l2.774 2.288c.694-2.082 2.639-3.63 4.939-3.63z"/></svg>
						<span class="sr-only">Google</span>
					</button>
					<button type="button" class="inline-flex w-full items-center justify-center gap-2 rounded-md border border-gray-300 bg-white px-2 py-2 text-xs font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
						<svg viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4"><path d="M12 2.25c-5.376 0-9.75 4.374-9.75 9.75 0 4.302 2.79 7.952 6.654 9.26.486.09.666-.21.666-.47 0-.23-.01-.99-.014-1.797-2.707.587-3.277-1.146-3.277-1.146-.442-1.125-1.08-1.425-1.08-1.425-.883-.603.067-.59.067-.59.976.068 1.488 1.002 1.488 1.002.868 1.487 2.276 1.058 2.83.81.088-.63.34-1.058.618-1.301-2.162-.246-4.432-1.081-4.432-4.814 0-1.064.38-1.933 1.002-2.614-.102-.247-.435-1.24.096-2.583 0 0 .816-.261 2.677.998a9.29 9.29 0 0 1 2.438-.328 9.28 9.28 0 0 1 2.438.328c1.861-1.259 2.675-.998 2.675-.998.533 1.343.2 2.336.098 2.583.624.681 1.001 1.55 1.001 2.614 0 3.743-2.274 4.565-4.443 4.806.35.301.66.893.66 1.8 0 1.298-.013 2.343-.013 2.662 0 .262.178.566.67.469A9.756 9.756 0 0 0 21.75 12c0-5.376-4.374-9.75-9.75-9.75Z"/></svg>
						<span class="sr-only">GitHub</span>
					</button>
				</div>
			</form>
		</div>

		<p class="text-center text-xs text-gray-500">By continuing, you agree to our <a href="#" class="underline decoration-dotted hover:text-gray-700">Terms</a> & <a href="#" class="underline decoration-dotted hover:text-gray-700">Privacy Policy</a>.</p>
	</div>
</div>
@endsection
