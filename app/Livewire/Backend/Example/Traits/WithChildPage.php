<?php
// 務必要注意namespace路徑是否正確
namespace App\Livewire\Backend\Product\Traits;

trait WithChildPage
{
    public $childPages = [
        ['name' => '範本列表', 'routeName' => 'admin-example.show'],
        ['name' => '範本建立分類', 'routeName' => 'admin-example-category.show'],
    ];
}
