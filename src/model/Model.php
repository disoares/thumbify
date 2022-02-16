<?php

namespace App\model;

class Model
{
    function uploadFile($file)
    {

        $json = array();
        $json['status'] = 'success';

        if ($file['size'] > 0 && $file['size'] < 3248256) {

            if (!move_uploaded_file($file['tmp_name'], TEMP_PATH . $file['name'])) {
                $json['status'] = 'error';
                $json['message'] = 'Oops... There was an error.';
            } else {
                $json['name'] = $file['name'];
            }
        } else {
            $json['status'] = 'error';
            $json['message'] = 'Sorry... your image is very large.';
        }

        return json_encode($json);
    }

    function resizeImage($image, $max_width)
    {
        $json = array();
        $json['status'] = 'success';

        $info = pathinfo($image);
        $ext = $info['extension'];

        $new_file_name = $info['filename'] . '_resized_' . $max_width . 'px.' . $ext;
        $modified_filename = TEMP_PATH . $new_file_name;

        list($old_width, $old_heihgt) = getimagesize($image);

        // calculate proportions
        $ratio = (100 * $max_width / $old_width) / 100;
        $new_width = $max_width;
        $new_height = $ratio * $old_heihgt;

        $new_image = imagecreatetruecolor($new_width, $new_height);

        switch ($ext) {
            case 'png':
                $old_image = imagecreatefrompng($image);
                imagealphablending($new_image, false);
                imagesavealpha($new_image, true);
                imagecolortransparent($new_image);
                break;
            case 'jpeg':
            case 'jpg':
                $old_image = imagecreatefromjpeg($image);
                break;
            case 'gif':
                $old_image = imagecreatefromgif($image);
                break;
        }

        imagecopyresampled($new_image, $old_image, 0, 0, 0, 0, $new_width, $new_height, $old_width, $old_heihgt);

        switch ($ext) {
            case 'png':
                imagepng($new_image, $modified_filename);
                break;
            case 'jpeg':
            case 'jpg':
                imagejpeg($new_image, $modified_filename);
                break;
            case 'gif':
                imagegif($new_image, $modified_filename);
                break;
        }

        imagedestroy($new_image);
        imagedestroy($old_image);

        $json['filename'] = $new_file_name;
        return json_encode($json);
    }

    function cropImage($path, $image){
        $json = array();
        $json['status'] = 'success';

        $toBeUploaded = $image['tmp_name'];        
        $info = pathinfo($path);
        $newFile = $info['filename'] . "_cropped_" . date('s') . ".png";

        if (!move_uploaded_file($toBeUploaded, TEMP_PATH . $newFile)) {
            $json['status'] = 'error';
            $json['message'] = 'Oops... Houve um erro.';
        } else {
            $json['filename'] = $newFile;
        }

        return json_encode($json);

    }

    function deleteFiles()
    {
        $timezone = new \DateTimeZone('America/Sao_Paulo');

        $files = scandir(TEMP_PATH);

        foreach ($files as $file) {

            if (!in_array($file, array('.', '..'))) {
                $filename = TEMP_PATH . $file;

                $file_time = new \DateTime();
                $file_time->setTimestamp(filemtime($filename));

                $cur_time = new \DateTime('now', $timezone);

                $interval = $cur_time->diff($file_time);
                $diff_in_minutes = ($interval->h * 60) + $interval->i;

                if ($diff_in_minutes > 15) {
                    unlink($filename);
                }
            }
        }
    }
}
