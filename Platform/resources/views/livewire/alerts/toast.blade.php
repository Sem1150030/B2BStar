
<div
@if ($message)
	x-data="{ show: true }"
	x-init="setTimeout(() => show = false, 4000)"
	x-show="show"
	x-transition.opacity.duration.300ms
	class="fixed z-50 top-4 right-4 w-80 max-w-[90vw]"
>
	<div class="pointer-events-auto flex w-full gap-3 rounded-xl border px-4 py-3 shadow-lg text-sm
		@switch($type)
			@case('error') bg-red-600/95 text-white border-red-500 @break
			@case('info') bg-blue-600/95 text-white border-blue-500 @break
			@default bg-emerald-600/95 text-white border-emerald-500
		@endswitch
	">
		<div class="shrink-0 mt-0.5">
			@switch($type)
				@case('error')
					<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 1 1 0-16 8 8 0 0 1 0 16ZM8.707 7.293 10 8.586l1.293-1.293a1 1 0 1 1 1.414 1.414L11.414 10l1.293 1.293a1 1 0 0 1-1.414 1.414L10 11.414l-1.293 1.293a1 1 0 0 1-1.414-1.414L8.586 10 7.293 8.707a1 1 0 1 1 1.414-1.414Z"/></svg>
					@break
				@case('info')
					<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0ZM9 9.5a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H9Zm1-4.25a1.25 1.25 0 1 0 0 2.5 1.25 1.25 0 0 0 0-2.5Z"/></svg>
					@break
				@default
					<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 0 0-1.414 0L8.5 12.086 6.207 9.793A1 1 0 0 0 4.793 11.207l3 3a1 1 0 0 0 1.414 0l7.5-7.5a1 1 0 0 0 0-1.414Z"/></svg>
			@endswitch
		</div>
		<div class="flex-1 leading-snug">{!! $message !!}</div>
		<button type="button" wire:click="dismiss" @click="show = false" class="text-white/80 hover:text-white transition focus:outline-none">
			<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path d="M8.293 9.293 5.586 6.586A1 1 0 0 0 4.172 8l2.707 2.707-2.707 2.707a1 1 0 1 0 1.414 1.414L8.293 12.12l2.707 2.708a1 1 0 0 0 1.414-1.415L9.707 10.707l2.707-2.707A1 1 0 0 0 11 6.586L8.293 9.293Z"/></svg>
			<span class="sr-only">Dismiss</span>
		</button>
	</div>
    @endif
</div>

