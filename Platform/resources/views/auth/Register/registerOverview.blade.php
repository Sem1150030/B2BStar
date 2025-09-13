@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
        <h1 class="text-3xl font-bold mb-8">{{t('auth.register.overview.titles')}}</h1>
        <div class="flex flex-col md:flex-row gap-8 w-full max-w-3xl">
            <!-- Brand Option -->
            <a href="{{ route('register.brand') }}" class="flex-1 bg-white rounded-xl shadow-lg p-8 flex flex-col items-center hover:bg-blue-50 transition">
                <div class="text-5xl mb-4">🏢</div>
                <h2 class="text-2xl font-semibold mb-2">{{t ('auth.register.overview.title.brand')}}</h2>
                <p class="text-gray-600 text-center">{{t ('auth.register.overview.description.brand')}}</p>
            </a>
            <!-- Retailer Option -->
            <a href="{{ route('register.retailer') }}" class="flex-1 bg-white rounded-xl shadow-lg p-8 flex flex-col items-center hover:bg-green-50 transition">
                <div class="text-5xl mb-4">🛒</div>
                <h2 class="text-2xl font-semibold mb-2">{{t ('auth.register.overview.title.retailer')}}</h2>
                <p class="text-gray-600 text-center">{{t ('auth.register.overview.description.retailer')}}</p>
            </a>
        </div>
    </div>
@endsection
