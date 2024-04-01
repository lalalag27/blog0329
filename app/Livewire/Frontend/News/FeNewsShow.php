<?php

namespace App\Livewire\Frontend\News;

use App\Models\News;
use Livewire\Component;
use Livewire\Attributes\Layout;
#[Layout('components.layouts.guest')]
class FeNewsShow extends Component
{
    public $slug;


    public function getnewsProperty()
    {
        // return ArticleCategory::all();
        return News::query()
            ->when($this->slug, function ($query) {
                $query->where('slug', $this->slug);
            })
            ->first();
    }
    public function render()
    {
        return view('livewire.frontend.news.fe-news-show',[
            'news' => $this->news,
        ]);
    }
}
