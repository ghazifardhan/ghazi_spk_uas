<?php

namespace Petruk\Framework;

use Illuminate\Database\Capsule\Manager as Capsule;

class UploadFile {

    public function uploadFile($file) {
        
        $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/storage/uploads/';

        $upload = move_uploaded_file($file['fileTempPath'], $uploadPath . $file['fileName']);

        if ($upload) {
            $data['filePath'] = 'uploads/' . $file['fileName'];
        } else {
            $data['filePath'] = NULL;
        }

        return $data;
    }

}