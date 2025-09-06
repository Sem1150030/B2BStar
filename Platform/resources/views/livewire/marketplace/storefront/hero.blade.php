<section class="relative overflow-hidden bg-gradient-to-b from-white via-white to-slate-50">
	<!-- Subtle pattern / background accents -->
	<div class="pointer-events-none absolute inset-0 select-none" aria-hidden="true">
		<div class="absolute top-[-6rem] left-1/2 h-[28rem] w-[28rem] -translate-x-1/2 rounded-full bg-indigo-100/40 blur-3xl"></div>
		<div class="absolute bottom-[-4rem] right-[-4rem] h-80 w-80 rounded-full bg-emerald-100/50 blur-2xl"></div>
	</div>

	<div class="relative mx-auto max-w-7xl px-6 pt-20 pb-24 sm:pt-28 lg:pt-36 lg:pb-32">
		<div class="grid gap-12 lg:grid-cols-12 lg:gap-16 items-start">
			<!-- Left column -->
			<div class="lg:col-span-7 xl:col-span-6">
				<h1 class="text-3xl font-semibold tracking-tight text-slate-900 sm:text-5xl leading-tight">
					Discover & purchase <span class="bg-gradient-to-r from-indigo-500 to-emerald-500 bg-clip-text text-transparent">wholesale products</span> from curated suppliers
				</h1>
				<p class="mt-6 text-base sm:text-lg text-slate-600 leading-relaxed max-w-xl">
					A neutral B2B marketplace where retailers and buyers source new lines, manage volume pricing, and build reliable supplier relationships—without back‑and‑forth chaos.
				</p>

				<!-- Search -->
				<div class="mt-8 max-w-xl">
					<label for="hero-search" class="sr-only">Search products</label>
					<div class="relative">
						<input id="hero-search" type="text" placeholder="Search products, brands, categories…" class="w-full rounded-xl border border-slate-300 bg-white/70 px-5 py-3 pr-14 text-sm placeholder-slate-400 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition" />
						<div class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-slate-400">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18a7.5 7.5 0 006.15-3.35z" /></svg>
						</div>
					</div>

					<p class="mt-2 text-xs text-slate-400">Search becomes instant (Livewire) once wired.</p>
				</div>

				<!-- CTAs -->
				<div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center" data-flux-button-group>
					<flux:button variant="primary" color="indigo" icon="bars-3" href="#catalog" as="a">Browse Catalog</flux:button>
					<flux:button variant="outline" icon="plus" href="#supplier-onboarding" as="a">Become a Supplier</flux:button>
					<flux:button variant="subtle" color="indigo" icon-trailing="arrow-right" href="#request-demo" as="a">Request Demo</flux:button>
				</div>

				<!-- Trust metrics -->
				<div class="mt-10 flex flex-wrap gap-2">
					<flux:badge color="emerald" size="sm" variant="solid" icon="shield-check">Verified Brands</flux:badge>
					<flux:badge color="indigo" size="sm" variant="solid" icon="adjustments-horizontal">Low MOQs</flux:badge>
					<flux:badge color="amber" size="sm" variant="solid" icon="currency-euro">Tiered Pricing</flux:badge>
					<flux:badge color="rose" size="sm" variant="solid" icon="calendar">Net Terms</flux:badge>
					<flux:badge color="emerald" size="sm" variant="solid" icon="document-text">Central POs</flux:badge>
				</div>

				<!-- Brand logos -->
				<div class="mt-12">
					<p class="text-[11px] uppercase tracking-wide text-slate-500 mb-3">Sample supplier set</p>
					<div class="flex flex-wrap items-center gap-3">
						@php $brands = ['Nordic','PureLeaf','Arcwood','Silica','Auralux','TerraCo']; @endphp
						@foreach($brands as $b)
							<div class="flex h-10 w-24 items-center justify-center rounded-md border border-slate-200 bg-white text-[11px] font-semibold tracking-wide text-slate-600 shadow-sm">{{ $b }}</div>
						@endforeach
					</div>
				</div>
			</div>

			<!-- Right column: sample product / layout preview -->
			<div class="lg:col-span-5 xl:col-span-6 hidden lg:block">
				<div class="relative mx-auto w-full max-w-xl">
					<div class="grid grid-cols-3 gap-4">
						@php
							$cards = [
								['title' => 'Organic Soy Candle','price' => '€7.80','badge' => 'Eco'],
								['title' => 'Recycled Notebook','price' => '€2.10','badge' => 'Stationery'],
								['title' => 'Herbal Hand Cream','price' => '€4.50','badge' => 'Beauty'],
								['title' => 'Bamboo Cutlery Set','price' => '€3.20','badge' => 'Home'],
								['title' => 'Gourmet Olive Oil','price' => '€9.40','badge' => 'Gourmet'],
								['title' => 'Kids Wooden Puzzle','price' => '€5.60','badge' => 'Kids'],
							];
						@endphp
						@foreach($cards as $c)
							<div class="group relative rounded-xl border border-slate-200 bg-white p-3 shadow-sm hover:shadow-md transition">
								<div class="aspect-square w-full rounded-lg bg-gradient-to-br from-slate-100 to-slate-50 flex items-center justify-center text-slate-300 text-xs font-medium">IMG</div>
								<div class="mt-2 flex items-start justify-between gap-2">
									<p class="text-[11px] font-medium text-slate-700 leading-tight line-clamp-2">{{ $c['title'] }}</p>
									<flux:badge size="sm" color="indigo" variant="subtle" class="shrink-0">{{ $c['badge'] }}</flux:badge>
								</div>
								<p class="mt-1 text-[11px] text-slate-500">From <span class="font-semibold text-slate-700">{{ $c['price'] }}</span></p>
							</div>
						@endforeach
					</div>
					<div class="pointer-events-none absolute -inset-x-4 -bottom-6 h-24 bg-gradient-to-t from-white"></div>
				</div>
			</div>
		</div>
	</div>
</section>

