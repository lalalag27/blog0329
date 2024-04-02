<?php

namespace App\Livewire\Backend\News;

use App\Models\News;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Locked;
use Illuminate\Support\Facades\Route;
use App\Livewire\Backend\Traits\WithChildPage;
use App\Livewire\Backend\Traits\Search\WithSearch;
use App\Livewire\Backend\Traits\WithFilterAndSort;
use App\Livewire\Backend\Traits\GetImgUrl\WithGetImgUrl;
use App\Livewire\Backend\Traits\Selectable\WithSelectable;

class BeNewsShow extends Component
{
    use WithPagination, // 分頁 
        WithSearch, // 搜尋
        WithSelectable, // 選擇
        WithChildPage, // 子頁面
        WithGetImgUrl, // 預設圖片
        WithFilterAndSort; // 篩選排序


    // 1.model資料相關
    public $traitsModel;  // 綁定model給Traits使用
    public $currentRouteName;  // 當前路由
    public $currentCount = ''; // 當前筆數


    // 2.Dialog開關
    public $showFilter = false; // 篩選開關
    public $showOrderNumEdit = false; // 排序開關
    public $showEdit = false; // 編輯開關
    public $editTitle = '編輯'; // 設定打開新增或編輯視窗的時候的標題


    // 3.選取的id請使用Locked把id鎖起來，避免被修改
    #[Url]
    #[Locked]
    public $selectId = '';


    // 4.資料編輯或新增
    #[Rule("required|max:255|unique:product_categories,title")]
    public $categoryTitle = ''; // 分類名稱
    #[Rule('required|max:99999|numeric')]
    public $orderNum = ''; // 排序


    // 初始化只會在第一次載入時執行
    public function mount()
    {
        // 綁定當前路由
        $this->currentRouteName = Route::currentRouteName();
    }


    // 打開新增或編輯視窗
    public function openEditDialog($id = 'add')
    {
        // 獲取選擇id
        $this->selectId = $id;
        // 設定標題文字
        $id == 'add' ? $this->editTitle = '新增' : $this->editTitle = '編輯';
        // 如果是新增就不用撈資料
        $id == 'add' ? $this->categoryTitle = '' : $this->categoryTitle = News::find($id)->title;
        // 打開視窗
        $this->showEdit = true;
    }



    // 打開排序視窗
    public function openOrderNumEditDialog($id)
    {
        // 獲取模組id
        $this->orderNum = News::find($id)->order_num;
        // 獲取選擇id
        $this->selectId = $id;
        // 打開視窗
        $this->showOrderNumEdit = true;
    }


    // 更新排序
    public function updateOrderNum()
    {
        // 驗證
        $this->validateOnly('orderNum');
        //如果是管理員才可以更新
        // Auth::user() && Example::find($this->selectId)->update(['order_num' => $this->orderNum]);
        
        News::find($this->selectId)->update(['order_num' => $this->orderNum]);
        // 關閉視窗
        $this->showOrderNumEdit = false;
        // 顯示成功訊息
        session()->flash('flash.banner', '更新完畢');
        // 重新導向
        redirect()->route('admin.newsshow');
    }


    // 狀態開關
    public function toggleActive($id)
    {
        // if (Contact::user()) {
            // 獲取模組
            $contact = News::find($id);
            // 切換狀態
            $contact->is_active = !$contact->is_active;
            // 儲存
            $contact->save();
        // }
    }


    //  任何查詢條件如:排序,篩選,搜尋,分類都在這裡處理
    public function getQueryBuilderProperty()
    {
        return $this->filterByConditions(News::class)
            ->when(
                // 當有搜尋時
                $this->search,
                fn($query, $search) =>
                $query->where(
                    // 記得要更換搜尋欄位
                    function ($query) use ($search) {
                        $query->where('title', 'like', '%' . $search . '%');
                        // ->orWhere('content', 'like', '%' . $search . '%');
                    }
                )
            );
    }
    // 建立資料庫是用看要get()還是paginate()
    public function getDbmsProperty()
    {
        return $this->queryBuilder->paginate(3);
    }

    public function render()
    { // 當前筆數，隨操作會變動
        $this->currentCount = $this->dbms->count();
        // 要重新持久化一次model(不然下個請求會是空的會變成404)
        $this->traitsModel = News::first();
        return view('livewire.backend.news.be-news-show', [
            'news' => $this->dbms,
        ]);
    }
}
