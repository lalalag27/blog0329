<?php

namespace App\Livewire\Frontend\News;

use Livewire\Component;
use Livewire\Attributes\Layout;
#[Layout('components.layouts.guest')]
class FeNewsShow extends Component
{
    public function render()
    {
        return view('livewire.frontend.news.fe-news-show');
    }
}
