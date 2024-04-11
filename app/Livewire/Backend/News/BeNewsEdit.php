<?php

namespace App\Livewire\Backend\News;

use App\Models\News;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Livewire\Backend\Traits\GetImgUrl\WithGetImgUrl;

class BeNewsEdit extends Component
{

    use WithGetImgUrl,
        WithFileUploads;

    // 獲取資料
    public $id; // 頁面id

    public $news;

    public $title;
    public $slug;
    public $orderNum;
    public $img;
    public $body;
    public $imgPath;
    public $uploadImg;


    // 初始化只會在第一次載入時執行
    public function mount()
    {        // 判斷是新增還是編輯
        if ($this->id === "add") {
            $this->news = new News();
            // 新增時預設排序為1
            $this->orderNum = 1;
        } else {
            // 編輯時取得model資料，判斷是否存在
            $this->news = News::findOrFail($this->id);
            $this->slug = $this->news->slug;
            $this->orderNum = $this->news->order_num;
            $this->title = $this->news->title;
            $this->body = $this->news->body;
            $this->img = $this->news->pic;
        }
    }


    // 保存資料
    public function save()
    {
        $this->validate([
            "slug" => "required",
            "orderNum" => "required",
            "title" => "required",
            "body" => "required",
        ], [
            "slug.required" => "請填寫網址",
            "orderNum.required" => "請填寫排序",
            "title.required" => "請填寫標題",
            "body.required" => "請填寫內文",
        ]);

        // 判斷有沒有上傳圖片
        if ($this->uploadImg) {
            // 只驗證圖片
            $this->validateOnly('img', [
                'uploadImg' => 'image|max:1024',
            ]);
            // 年月日當資料夾
            $dirName = date('Ymd');
            // 獲取副檔檔名後，變更檔名成亂數再組裝
            $extension = $this->uploadImg->getClientOriginalExtension();
            $fileName = Str::uuid() . "-image" . '.' . $extension;
            // 檔案路徑賦予給imgPath
            $this->imgPath = $this->uploadImg->storePubliclyAs($dirName, $fileName, 'public');
        }


        // 如果是add就是新增，如果是model id就是更新
        // 判斷是新增還是編輯
        if ($this->id === "add") {
            // create方法新增資料....
            News::create([
                'slug' => $this->slug,
                'order_num' => $this->orderNum,
                'title' => $this->title,
                'body' => $this->body,
                'pic' => $this->imgPath, // 將圖片路徑設置為上傳圖片的路徑
            ]);

            // 閃訊跟轉址到列表
            session()->flash('message', '文章已新增！');
            return redirect()->route('admin.newsshow');
        } else {
            // 編輯操作
            $this->news->update([
                'slug' => $this->slug,
                'order_num' => $this->orderNum,
                'title' => $this->title,
                'body' => $this->body,
                // 如果有上傳新的圖片，則更新圖片路徑
                'pic' => $this->uploadImg ? $this->imgPath : $this->news->pic,
            ]);

            // 閃訊跟轉址到列表
            session()->flash('message', '文章已新增！');
            return redirect()->route('admin.newsshow');
        }
    }

    public function render()
    {
        return view('livewire.backend.news.be-news-edit', [
            'news' => News::all()
        ]);
    }
}
