<div>
    <!-- Fixed top navigation bar -->
    <header class="fixed top-0 inset-x-0 z-50 bg-gray-800 shadow-sm">
    <div class="mx-auto max-w-7xl px-2 sm:px-4 lg:divide-y lg:divide-white/10 lg:px-8">
        <div class="relative flex h-16 justify-between">
        <div class="relative z-10 flex px-2 lg:px-0">
            <div class="flex shrink-0 items-center">
            <a href="/" class="inline-flex items-center gap-2">
				<span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-800 text-white font-bold text-sm text-lg shadow-sm">B2B</span>
			</a>
          </div>
        </div>
        <div class="relative z-0 flex flex-1 items-center justify-center px-2 sm:absolute sm:inset-0">
            <div class="grid w-full grid-cols-1 sm:max-w-xs">
            <input name="search" placeholder="Search" aria-label="Search" class="col-start-1 row-start-1 block w-full rounded-md border-0 bg-white/5 py-1.5 pl-10 pr-3 text-white outline outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
            <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="pointer-events-none col-start-1 row-start-1 ml-3 size-5 self-center text-gray-400">
                <path d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" fill-rule="evenodd" />
            </svg>
            </div>
        </div>
        <div class="relative z-10 flex items-center lg:hidden">
            <!-- Mobile menu button -->
            <button type="button" command="--toggle" commandfor="mobile-menu" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-white/5 hover:text-gray-300 focus:outline-2 focus:-outline-offset-1 focus:outline-indigo-500">
            <span class="absolute -inset-0.5"></span>
            <span class="sr-only">Open menu</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 [[aria-expanded='true']_&]:hidden">
                <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 [&:not([aria-expanded='true']_*)]:hidden">
                <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            </button>
        </div>
        <div class="hidden lg:relative lg:z-10 lg:ml-4 lg:flex lg:items-center">
            <!-- Language selector (native details) -->
            <div x-data="{ open: false }" class="relative mr-4">
                <!-- Trigger -->
                <button @click="open = !open"
                    class="inline-flex items-center gap-1 rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:text-white hover:bg-white/5 focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                    <span class="uppercase">{{ strtoupper($currentLocale ?? app()->getLocale()) }}</span>
                    <svg viewBox="0 0 20 20" fill="currentColor"
                        class="size-4 transition-transform"
                        :class="{ 'rotate-180': open }">
                        <path fill-rule="evenodd"
                            d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <!-- Dropdown -->
                <div x-show="open"
                    @click.outside="open = false"
                    x-transition
                    class="absolute left-0 mt-2 w-40 origin-top-left rounded-md bg-white p-1 text-sm shadow-lg ring-1 ring-black/5 z-50">
                    @foreach($languages as $code => $label)
                        @php($active = ($currentLocale ?? app()->getLocale()) === $code)
                        <a href="/lang/{{ $code }}"
                        wire:click.prevent="switchLocale('{{ $code }}')"
                        class="block rounded px-2 py-1.5 hover:bg-gray-100 {{ $active ? 'font-semibold text-indigo-600' : 'text-gray-700' }}"
                        role="menuitem">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            </div>

            <button type="button" class="relative shrink-0 rounded-full p-1 text-gray-400 hover:text-white focus:outline-2 focus:outline-offset-2 focus:outline-indigo-500">
            <span class="absolute -inset-1.5"></span>
            <span class="sr-only">View notifications</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                <path d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            </button>

            <!-- Profile dropdown -->
            @if(Auth::check())
                <div x-data="{ open: false }" class="relative ml-4 shrink-0">
                    <button @click="open = !open"
                        class="relative flex rounded-full focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 focus-visible:ring-offset-2">
                        <span class="sr-only">Open user menu</span>
                        <img class="size-8 rounded-full bg-gray-800"
                            src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                            alt="User avatar">
                    </button>

                    <!-- Dropdown menu -->
                    <div x-show="open"
                        @click.outside="open = false"
                        x-transition
                        class="absolute right-0 mt-2 w-48 rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none z-50">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your Profile</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                        <form method="POST" action="{{ route('logout.action') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Sign out
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="ml-4 shrink-0">
                    <a href="/auth/login" class="inline-flex items-center rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">Sign in</a>
                </div>
            @endif
        </div>
        </div>
    <nav aria-label="Global" class="hidden lg:flex lg:space-x-8 lg:py-2">
    <a href="#" aria-current="page" class="inline-flex items-center rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white">@lang('common.dashboard')</a>
    <a href="#" class="inline-flex items-center rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">@lang('common.team')</a>
    <a href="#" class="inline-flex items-center rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">@lang('common.projects')</a>
    <a href="#" class="inline-flex items-center rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">@lang('common.calendar')</a>
    </nav>
    </div>

    <el-disclosure id="mobile-menu" hidden class="lg:hidden [&:not([hidden])]:contents">
        <nav aria-label="Global">
        <div class="space-y-1 px-2 pb-3 pt-2">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-white/5 hover:text-white" -->
            <a href="#" aria-current="page" class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white">Dashboard</a>
            <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Team</a>
            <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Projects</a>
            <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Calendar</a>
        </div>
        <div class="border-t border-white/10 pb-3 pt-4">
            <div class="flex items-center px-4">
            @if(Auth::check())
                <div class="shrink-0">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="size-10 rounded-full bg-gray-800 outline-1 -outline-offset-1 outline-white/10" />
                </div>
            @endif
            <div class="ml-3">
                <div class="text-base font-medium text-white">Tom Cook</div>
                <div class="text-sm font-medium text-gray-400">tom@example.com</div>
            </div>
            <button type="button" class="relative ml-auto shrink-0 rounded-full p-1 text-gray-400 hover:text-white focus:outline-2 focus:outline-offset-2 focus:outline-indigo-500">
                <span class="absolute -inset-1.5"></span>
                <span class="sr-only">View notifications</span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                <path d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
            </div>
            <div class="mt-3 space-y-1 px-2">
            <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white">Your profile</a>
            <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white">Settings</a>
            <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white">Sign out</a>
            <div class="pt-2 mt-2 border-t border-white/10">
                <p class="px-3 pb-1 text-xs uppercase tracking-wide text-gray-500">@lang('common.language')</p>
                @foreach($languages as $code => $label)
                    @php($active = ($currentLocale ?? app()->getLocale()) === $code)
                    <a href="/lang/{{ $code }}" wire:click.prevent="switchLocale('{{ $code }}')" class="block rounded-md px-3 py-2 text-sm font-medium hover:bg-white/5 {{ $active ? 'text-indigo-400' : 'text-gray-300' }}">{{ $label }}</a>
                @endforeach
            </div>
            </div>
        </div>
        </nav>
    </el-disclosure>
    </header>

</div>
