<?php

namespace App\Livewire\Backend\Product;

use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Auth;


class ProductEdit extends Component
{

    // 獲取資料
    public $id; // 頁面id
    public $editTitle; // 標題

    // 表單字段
    #[Rule(['required', 'max:255'])]
    public $title = '';
    #[Rule(['required', 'max:2000'])]
    public $content = '';
    #[Rule(['required'])]
    public $example_category_id = '';

    // 初始化只會在第一次載入時執行
    public function mount($id)
    {
        // 獲取頁面id，如果是add就是新增，如果是model id就是編輯
        $this->id = $id;
        $this->editTitle = $this->id == 'add' ? '新增' : '編輯';

        // 獲取編輯資料 如果是add就是空值，如果是model id就是資料
        if ($this->id != 'add') {
            $this->title = Example::findorfail($this->id)->title;
            $this->content = Example::findorfail($this->id)->content;
            $this->example_category_id = Example::findorfail($this->id)->example_category_id;
        } else {
            $this->title = '';
            $this->content = '';
            $this->product_category_id = '';
        }
    }

    // 保存資料
    public function save()
    {
        // 驗證字段
        $this->validate([
            'title' => ['required', 'max:255'],
            'content' => ['required', 'max:2000'],
            'example_category_id' => ['required'],
        ]);

        // 如果是add就是新增，如果是model id就是更新
        if ($this->id == 'add') {
            // transaction這個很重要我們是先創資料獲取資料id後再存圖片如果沒成功要rollback不要創資料

            Auth::user() && Example::create([
                'title' => $this->title,
                'content' => $this->content,
                'example_category_id' => $this->example_category_id,
            ]);


            session()->flash('flash.banner', '新增成功');
            redirect()->route('admin-example.show');
        } else {
            // 更新資料
            Auth::user() && Example::find($this->id)->update([
                'title' => $this->title,
                'content' => $this->content,
                'example_category_id' => $this->example_category_id,
            ]);
            session()->flash('flash.banner', '編輯成功');
            redirect()->route('admin-example.show');
        }
    }


    // 渲染
    public function render()
    {
        return view('livewire.backend.example.example-edit', [
            'exampleCategories' => ExampleCategory::all(), // 獲取所有分類
        ]);
    }
}
