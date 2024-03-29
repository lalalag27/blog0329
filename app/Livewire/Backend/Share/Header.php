<?php

namespace App\Livewire\Backend\Share;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Route;

class Header extends Component
{

    public $menu = [
        [
            "title" => "個人資料",
            "routeName" => "profile.show",
            "showMenu" => true,
        ],
        [
            "title" => "Home",
            "routeName" => "dashboard",
            "showMenu" => true,
        ],
    ];

    public $title = '';
    public $currentRouteName;

    #[On('onMount')]
    public function mount()
    {
        $this->currentRouteName = Route::currentRouteName();

        foreach ($this->menu as $item) {
            if ($item['routeName'] == Route::currentRouteName()) {
                $this->title = $item['title'];
            }
        }
    }

    public function render()
    {
        return view('livewire.backend.share.header');
    }
}
