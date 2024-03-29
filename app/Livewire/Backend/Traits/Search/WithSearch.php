<?php

namespace App\Livewire\Backend\Traits\Search;

use Livewire\Attributes\Url;

trait WithSearch
{
    // 搜尋並且在網址上顯示
    #[Url]
    public $search = '';

    // 觸發搜尋
    public function goSearch()
    {
        $this->resetPage();
    }
}
