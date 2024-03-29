<?php

namespace App\Livewire\Frontend\News;

use Livewire\Component;
use Livewire\Attributes\Layout;
#[Layout('layouts.guest')]
class FeNewsIndex extends Component
{
    public function render()
    {
        return view('livewire.frontend.news.fe-news-index');
    }
}
