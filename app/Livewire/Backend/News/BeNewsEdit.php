<?php

namespace App\Livewire\Backend\News;

use App\Models\News;
use Livewire\Component;

class BeNewsEdit extends Component
{
    // 獲取資料
    public $id; // 頁面id
    public $title;
    public $slug;
    public $body;
    public $is_active;

    // 初始化只會在第一次載入時執行
    public function mount($id)
    {
        $this->id = $id;

        // 獲取編輯資料 model id就是資料
        if ($this->id) {
            $this->title = '';
            $this->slug = '';
            $this->body = '';
            $this->is_active = '';
        } else {

        }
    }

     // 保存資料
    public function save()
    {
        
        // 如果是add就是新增，如果是model id就是更新
        if ($this->id) {
             // 更新資料
            News::find($this->id)->update([
                'title' => $this->title,
                'slug' => $this->slug,
                'body' => $this->email,
                'is_active' => $this->is_active,
            ]);
            session()->flash('flash.banner', '編輯成功');
            redirect()->route('admin.newsedit');
        } else {
           
        }
    }

    public function render()
    {
        return view('livewire.backend.news.be-news-edit',[
            'news' => News::all(), // 獲取所有分類
        ]);
    }
}
