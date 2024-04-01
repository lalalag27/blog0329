<?php

// 務必要注意namespace路徑是否正確
namespace App\Livewire\Backend\Traits;

use Livewire\Attributes\Url;

trait WithFilterAndSort
{
    // 篩選功能
    #[Url]
    public $startDate = ''; // 開始日期
    #[Url]
    public $endDate = ''; // 結束日期
    #[Url]
    public $statusActive = ''; // 狀態
    public $filterMessage = ''; // 篩選錯誤訊息

    // 選擇排序
    #[Url]
    public $orderBy = ['order' => 'DESC', 'sortField' => 'created_at']; //預設排序
    public $orderByItems = [
        ['name' => '建立日期:舊 - 新', 'order' => 'ASC', 'sortField' => 'created_at'],
        ['name' => '建立日期:新 - 舊', 'order' => 'DESC', 'sortField' => 'created_at'],
        ['name' => '排序:小 - 大', 'order' => 'ASC', 'sortField' => 'order_num'],
        ['name' => '排序:大 - 小', 'order' => 'DESC', 'sortField' => 'order_num'],
    ]; //條件在這裡新增




    // 觸發篩選條件，這裡主要用來做判斷
    public function filter()
    {
        if ($this->startDate > $this->endDate) {
            $this->filterMessage = '開始日期不可大於結束日期';
        } else {
            $this->filterMessage = '';
            $this->showFilter = false;
            $this->resetPage();
        }
    }


    // 調用時傳入想要重置的值如:'search', 'startDate', 'endDate'來調用
    public function goRest(...$field)
    {
        $this->reset($field);
        $this->resetPage();
    }


    // 條件篩選狀態
    public function filterByConditions($model, $withModels = [])
    {
        return $model::query()
            ->with($withModels)
            ->when(
                // 當有開始日期時
                $this->startDate,
                fn ($query, $data) =>
                $query->whereDate('created_at', '>=', $data)
            )
            ->when(
                // 當有結束日期時
                $this->endDate,
                fn ($query, $data) =>
                $query->whereDate('created_at', '<=', $data)
            )
            ->when(
                // 當有狀態時
                $this->statusActive !== null && $this->statusActive !== '',
                fn ($query) =>
                $query->where('is_active', $this->statusActive)
            )
            ->when(
                $this->orderBy,
                function ($query) {
                    // array_column()獲取$this->orderByItems只有sortField的array
                    $validSortFields = array_column($this->orderByItems, 'sortField');
                    // 預設排序欄位
                    $defaultSortField = 'created_at';
                    // in_array()判斷$this->orderBy是否有在排序欄位array
                    $sortField = in_array($this->orderBy['sortField'], $validSortFields) ? $this->orderBy['sortField'] : $defaultSortField;
                    // 判斷ORDER是否為ASC或DESC
                    $order = $this->orderBy['order'] === 'ASC' ? 'ASC' : 'DESC';
                    $query->orderBy($sortField, $order);
                }
            );
    }
}
