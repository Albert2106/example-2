<div>
    <flux:modal name="post-detail" class="max-w-lg w-full">
        @if($post)
            <div class="flex items-start justify-between mb-4">
                <flux:text class="text-xs text-zinc-400">{{ $post['date'] }}</flux:text>
            </div>

            <flux:heading size="lg" class="mb-3 leading-snug">
                {{ $post['title'] }}
            </flux:heading>

            <flux:separator class="my-4" />

            <flux:text class="leading-relaxed text-zinc-600 dark:text-zinc-300">
                {{ $post['excerpt'] }}
            </flux:text>

            <flux:text class="mt-4 leading-relaxed text-zinc-600 dark:text-zinc-300">
                Это демонстрационный контент. В реальном приложении здесь будет полный текст публикации,
                загруженный из базы данных по идентификатору поста.
            </flux:text>

            <div class="flex justify-end gap-2 mt-6">
                <flux:modal.close>
                    <flux:button variant="ghost">Закрыть</flux:button>
                </flux:modal.close>
                <flux:button variant="primary" icon="bookmark">Сохранить</flux:button>
            </div>
        @endif
    </flux:modal>
</div>
