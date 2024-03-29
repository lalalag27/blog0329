<?php

namespace App\Livewire\Backend\Traits\ImageUploads;

use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

trait WithImageUploads
{
    use WithFileUploads;

    public $tmpPhotos = [];
    public $tmpPhotoAlt = [];
    public $tmpPhotoOrderNum = [];
    public $idModel;
    public $uploadModel;
    public $uploadNum;
    public $validateTmpPhotos;

    public $maxFileSize = 3;
    public $maxFilesNum = 2;


    // 設定上傳圖片
    public function fileUploadsModel($idModel, $uploadModel,  $maxFileSize = 3, $maxFilesNum = 5)
    {
        $this->idModel = $idModel; // 綁定主要資料model
        $this->uploadModel = $uploadModel; // 綁定上傳資料model
        $this->maxFileSize = $maxFileSize; // 設定上傳圖片大小
        $this->maxFilesNum = $maxFilesNum; // 設定上傳圖片數量
    }


    // 監聽暫存圖片並交給驗證validateTmpPhotos($photos)做處理
    public function updatedTmpPhotos()
    {
        $this->tmpPhotos = $this->validateTmpPhotos($this->tmpPhotos);
    }


    // 驗證暫存圖片
    public function validateTmpPhotos($photos)
    {
        foreach ($photos as $index => $photo) {
            // 驗證大小如果超過就移除
            if ($photo->getSize() > $this->maxFileSize * 1024 * 1024) {
                $this->addError('tmpPhotos', '檔案大小不得超過 ' . $this->maxFileSize . 'MB');
                unset($photos[$index]);
            }
            // 不可以超過最大數量
            if (count($photos) > $this->maxFilesNum) {
                $this->addError('tmpPhotos', '一次上傳' . $this->maxFilesNum . '張');
                // 刪除最後一張預覽圖片
                array_pop($photos);
            }
        }
        return $photos;
    }


    // 刪除暫存圖片
    public function removeTmpPhoto($index)
    {
        // 刪除預覽圖片
        unset($this->tmpPhotos[$index]);
        $this->tmpPhotos = array_values($this->tmpPhotos);
        // 刪除預覽圖片 alt
        unset($this->tmpPhotoAlt[$index]);
        $this->tmpPhotoAlt = array_values($this->tmpPhotoAlt);
        // 刪除預覽圖片排序
        unset($this->tmpPhotoOrderNum[$index]);
        $this->tmpPhotoOrderNum = array_values($this->tmpPhotoOrderNum);
    }


    // 上傳儲存圖片
    private function uploadTmpPhoto($photo)
    {
        // 驗證暫存圖片字段
        $this->validate([
            'tmpPhotos.*' => ['image', 'max:1024'],
            'tmpPhotoAlt.*' => ['max:10'],
            'tmpPhotoOrderNum.*' => ['max:999999', 'numeric'],
        ]);
        // 驗證圖片過關
        $this->validateTmpPhotos = true;
        // 設定圖片資料夾
        $folderName = Carbon::now()->format('Ymd');
        // 儲存圖片路徑 /public/fileUpload/日期(20210801)/圖片名稱
        $path = $photo->store('fileUpload' . '/' . $folderName, 'public');
        return $path;
    }


    // 暫存圖片數據合併
    public function mergeTmpPhotoData($modelIdKey = 'product_id', $imagePathKey = 'image_path', $imageAltKey = 'image_alt', $orderNumKey = 'order_num')
    {
        // 合併圖片數據
        $imageInfo = [];
        // 如果有暫存圖片執行圖片合併
        if ($this->tmpPhotos) {
            // 循環暫存圖片
            foreach ($this->tmpPhotos as $index => $tmpPhoto) {
                // 驗證暫存圖片並上傳到storage
                $path = $this->uploadTmpPhoto($tmpPhoto);
                // 建立圖片數據
                $imageInfo[] = [
                    // 產品id
                    $modelIdKey => $this->id == 'add' ? $this->idModel::latest()->first()->id : $this->id,
                    // 圖片路徑
                    $imagePathKey => $path,
                    // 圖片alt
                    $imageAltKey => $this->tmpPhotoAlt[$index] ?? '',
                    // 圖片排序 如果沒有輸入排序就給0
                    $orderNumKey => $this->tmpPhotoOrderNum[$index]  !== '' ? $this->tmpPhotoOrderNum[$index] : 0,
                ];
            }
        }

        // 回傳圖片數據
        return $imageInfo;
    }


    // 儲存圖片
    public function saveTmpImagesToDatabase()
    {
        // 獲取圖片數據
        $imageInfo = $this->mergeTmpPhotoData();

        if ($imageInfo) {
            // 創建圖片數據並插入資料庫
            foreach ($imageInfo as $image) {
                $this->uploadModel::create($image);
            }
        }
        // 清空暫存圖片
        $this->tmpPhotos = [];
        $this->tmpPhotoAlt = [];
        $this->tmpPhotoOrderNum = [];
    }
}
