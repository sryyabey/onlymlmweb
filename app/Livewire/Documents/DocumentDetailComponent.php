<?php

namespace App\Livewire\Documents;

use App\Models\DocCategory;
use App\Models\DocContent;
use App\Models\DocTag;
use Livewire\Component;

class DocumentDetailComponent extends Component
{
    public DocContent $content;

    public function mount(string $slug): void
    {
        $this->content = DocContent::query()
            ->with(['categories', 'tags'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
    }

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

        $relatedContents = DocContent::query()
            ->where('is_active', true)
            ->whereKeyNot($this->content->getKey())
            ->where(function ($query) {
                $query->whereHas('categories', function ($categoryQuery) {
                    $categoryQuery->whereIn('doc_categories.id', $this->content->categories->pluck('id'));
                })->orWhereHas('tags', function ($tagQuery) {
                    $tagQuery->whereIn('doc_tags.id', $this->content->tags->pluck('id'));
                });
            })
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->limit(6)
            ->get();

        return view('livewire.documents.document-detail-component', [
            'categories' => $categories,
            'tags' => $tags,
            'relatedContents' => $relatedContents,
        ]);
    }
}
