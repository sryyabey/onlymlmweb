<?php

namespace App\Livewire\Documents;

use App\Models\DocCategory;
use App\Models\DocContent;
use App\Models\DocTag;
use Livewire\Component;

class DocumentsPageComponent extends Component
{
    public string $search = '';
    public ?int $categoryId = null;
    public ?int $tagId = null;

    public function render()
    {
        $categories = DocCategory::query()
            ->where('is_active', true)
            ->withCount('contents')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $tags = DocTag::query()
            ->where('is_active', true)
            ->withCount('contents')
            ->orderBy('name')
            ->get();

        $contents = DocContent::query()
            ->with(['categories', 'tags'])
            ->where('is_active', true)
            ->when($this->categoryId, function ($query) {
                $query->whereHas('categories', function ($categoryQuery) {
                    $categoryQuery->whereKey($this->categoryId);
                });
            })
            ->when($this->tagId, function ($query) {
                $query->whereHas('tags', function ($tagQuery) {
                    $tagQuery->whereKey($this->tagId);
                });
            })
            ->when($this->search !== '', function ($query) {
                $search = '%' . $this->search . '%';

                $query->where(function ($innerQuery) use ($search) {
                    $innerQuery->where('title', 'like', $search)
                        ->orWhere('excerpt', 'like', $search)
                        ->orWhere('body', 'like', $search);
                });
            })
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->get();

        return view('livewire.documents.documents-page-component', [
            'categories' => $categories,
            'tags' => $tags,
            'contents' => $contents,
        ]);
    }
}
