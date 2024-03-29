<?php

namespace App\Livewire\Backend\Traits\Selectable;


use Illuminate\Support\Facades\Auth;


trait WithSelectable
{
    // 選取
    public $selected = []; // 單選取
    public $selectedAll = false; //全部資料選取
    public $selectedPage = false;  // 頁面資料選取
    public $selectedAllNum = 0; // 全部資料數量



    // 操作
    public $showBulkAll = false; // 批量刪除開關

    // 初始化
    public function mountWithSelectable()
    {
        $this->selectedAllNum = $this->queryBuilder->count();
    }


    // 更新選取
    public function updatedSelected()
    {
        if (count($this->selected) == $this->dbms->count() && count($this->selected) != $this->selectedAllNum) {
            $this->selectedPage = true;
        } elseif (count($this->selected) == $this->selectedAllNum) {
            $this->selectedAll = true;
            $this->selectedPage = true;
        } else {
            $this->selectedPage = false;
            $this->selectedAll = false;
        }
    }


    // 頁面的全選
    public function updatedSelectedPage()
    {
        if ($this->selectedPage && !$this->selectedAll) {
            $this->selected = $this->dbms->pluck('id')->map(function ($id) {
                return $id;
            });
        } else {
            $this->selected = [];
            $this->selectedPage = false;
            $this->selectedAll = false;
        }
    }


    // 包括其他頁面的全選
    public function updatedSelectedAll()
    {
        if ($this->selectedAll) {
            $this->selected = $this->queryBuilder->get()->pluck('id')->map(function ($id) {
                return $id;
            });
            $this->selectedPage = true;
        }
    }


    // 批量啟用狀態
    public function activeSelected($field)
    {
        if (Auth::user()) {
            $this->traitsModel->whereIn('id', $this->selected)->update([$field => true]);
            $this->reset('selected', 'selectedAll', 'selectedPage');
            $this->showBulkAll = false;
            session()->flash('flash.banner', '狀態更新成功');
            redirect(request()->header('Referer'));
        }
    }


    // 批量停用狀態
    public function closeSelected($field)
    {
        if (Auth::user()) {
            $this->traitsModel->whereIn('id', $this->selected)->update([$field => false]);
            $this->reset('selected', 'selectedAll', 'selectedPage');
            $this->showBulkAll = false;
            session()->flash('flash.banner', '狀態更新成功');
            redirect(request()->header('Referer'));
        }
    }


    // 批量刪除
    public function deleteSelected()
    {
        if (Auth::user()) {
            $this->traitsModel->whereIn('id', $this->selected)->delete();
            $this->reset('selected', 'selectedAll', 'selectedPage');
            $this->showBulkAll = false;
            session()->flash('flash.banner', '刪除成功');
            redirect(request()->header('Referer'));
        }
    }
}
