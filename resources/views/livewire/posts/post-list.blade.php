<div class="max-w-6xl mx-auto px-4 sm:px-6">

    {{-- Заголовок и поиск --}}
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
        <div>
            <flux:heading size="xl">Публикации</flux:heading>
            <flux:text class="mt-1 text-zinc-500 dark:text-zinc-400">
                Показано: <flux:badge size="sm" color="blue">{{ $this->filteredCount }}</flux:badge>
                @if($search !== '')
                    по запросу «{{ $search }}»
                @else
                    из {{ count($items) }} загруженных
                @endif
            </flux:text>
        </div>

        <flux:input
            wire:model.live.debounce.300ms="search"
            placeholder="Поиск по публикациям..."
            icon="magnifying-glass"
            clearable
            class="w-full sm:w-72"
        />
    </div>

    {{-- Сетка карточек --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($this->filteredItems as $item)
            <flux:card
                wire:key="post-{{ $item['id'] }}"
                class="flex flex-col gap-3 cursor-pointer hover:shadow-md transition-all hover:-translate-y-0.5"
                wire:click="selectPost({{ $item['id'] }})"
            >
                <div class="flex items-center justify-between">
                    <flux:text class="text-xs text-zinc-400">{{ $item['date'] }}</flux:text>
                </div>

                <flux:heading size="base" class="leading-snug">{{ $item['title'] }}</flux:heading>

                <flux:text class="text-sm text-zinc-500 dark:text-zinc-400 flex-1 line-clamp-3">
                    {{ $item['excerpt'] }}
                </flux:text>

                <flux:separator />

                <div class="flex justify-end">
                    <flux:button size="sm" variant="ghost" icon-trailing="arrow-right">
                        Читать
                    </flux:button>
                </div>
            </flux:card>
        @empty
            <div class="col-span-3 flex flex-col items-center justify-center py-20 text-zinc-400">
                <flux:icon name="document-magnifying-glass" class="size-12 mb-3" />
                <flux:heading size="sm" class="text-zinc-400">Ничего не найдено</flux:heading>
                <flux:text class="text-sm mt-1">Попробуйте изменить поисковый запрос</flux:text>
            </div>
        @endforelse
    </div>

    {{-- Sentinel для wire:intersect (lazy loading) --}}
    @if($hasMore && $search === '')
        <div
            wire:key="sentinel-{{ count($items) }}"
            wire:intersect="loadMore"
            class="flex items-center justify-center py-12 gap-3 text-zinc-400"
        >
            <flux:icon name="arrow-path" class="size-5 animate-spin" />
            <flux:text class="text-sm">Загружаем ещё...</flux:text>
        </div>
    @elseif($search === '')
        <div class="flex justify-center py-10">
            <flux:badge variant="pill" color="zinc">Все публикации загружены</flux:badge>
        </div>
    @endif

    {{-- Компонент деталей (слушает событие post-selected) --}}
    <livewire:posts.post-detail />

</div>
