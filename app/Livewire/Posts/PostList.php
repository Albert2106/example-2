<?php

namespace App\Livewire\Posts;

use App\Contracts\PostRepositoryInterface;
use App\DTOs\PostData;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class PostList extends Component
{
    private const PER_PAGE  = 6;
    private const MAX_ITEMS = 60;

    public string $search  = '';
    public array  $items   = [];
    public bool   $hasMore = true;

    private PostRepositoryInterface $repository;

    public function boot(PostRepositoryInterface $repository): void
    {
        $this->repository = $repository;
    }

    public function mount(): void
    {
        $this->loadMore();
    }

    public function loadMore(): void
    {
        if (count($this->items) >= self::MAX_ITEMS) {
            $this->hasMore = false;
            return;
        }

        $batch = $this->repository->getPaginated(count($this->items), self::PER_PAGE + 1);

        if (empty($batch)) {
            $this->hasMore = false;
            return;
        }

        $hasMore = count($batch) > self::PER_PAGE;
        $batch   = array_slice($batch, 0, self::PER_PAGE);

        $this->items = array_merge(
            $this->items,
            array_map(fn(PostData $post): array => $post->toArray(), $batch),
        );

        $this->hasMore = $hasMore && count($this->items) < self::MAX_ITEMS;
    }

    #[Computed]
    public function filteredItems(): array
    {
        if ($this->search === '') {
            return $this->items;
        }

        return array_map(
            fn(PostData $post): array => $post->toArray(),
            $this->repository->search($this->search),
        );
    }

    #[Computed]
    public function filteredCount(): int
    {
        return count($this->filteredItems);
    }

    public function selectPost(int $id): void
    {
        $post = $this->repository->getById($id)?->toArray();

        if ($post) {
            $this->dispatch('post-selected', post: $post);
        }
    }

    public function render(): View
    {
        return view('livewire.posts.post-list');
    }
}
