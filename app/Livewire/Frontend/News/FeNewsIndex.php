<?php

namespace App\Livewire\Frontend\News;

use App\Livewire\Backend\Traits\GetImgUrl\WithGetImgUrl;
use App\Models\News;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.guest')]
class FeNewsIndex extends Component
{
    use WithGetImgUrl;
    public $news;
    //傳入網址參數
    protected $queryString = ['news'];

    public function getNewsProperty()
    {

        return News::all();

        // dd(News::all());
        // 使用 query 方法查詢
        // return News::query()
        //     ->orderBy('id', 'asc') // 利用id升序排列
        //     ->get() ; 
    }


    public function render()
    {
        // 使用 getNewsProperty 
        $this->news = $this->getNewsProperty();
        // dd($this->news);
        return view('livewire.frontend.news.fe-news-index', [
            'news' => $this->news,
        ]);
    }
}
