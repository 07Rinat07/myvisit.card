<?php

function resize_and_crop($source_image_path, $thumbnail_image_path, $result_width, $result_height)
{
    if (!file_exists($source_image_path)) {
        return false;
    }

    $image_info = getimagesize($source_image_path);
    if (!$image_info) {
        return false; // Файл не является изображением
    }

    list($source_width, $source_height, $source_type) = $image_info;

    // Создаем изображение в зависимости от типа
    switch ($source_type) {
        case IMAGETYPE_GIF:
            $source_gdim = imagecreatefromgif($source_image_path);
            break;
        case IMAGETYPE_JPEG:
            $source_gdim = imagecreatefromjpeg($source_image_path);
            break;
        case IMAGETYPE_PNG:
            $source_gdim = imagecreatefrompng($source_image_path);
            break;
        default:
            return false; // Неподдерживаемый тип изображения
    }

    if (!$source_gdim) {
        return false; // Ошибка при создании исходного изображения
    }

    // Вычисляем пропорции изображений
    $source_aspect_ratio = $source_width / $source_height;
    $desired_aspect_ratio = $result_width / $result_height;

    // Определяем размеры временного изображения
    if ($source_aspect_ratio > $desired_aspect_ratio) {
        $temp_height = $result_height;
        $temp_width = (int) ($result_height * $source_aspect_ratio);
    } else {
        $temp_width = $result_width;
        $temp_height = (int) ($result_width / $source_aspect_ratio);
    }

    // Создаем временное изображение
    $temp_gdim = imagecreatetruecolor($temp_width, $temp_height);
    if (!$temp_gdim) {
        imagedestroy($source_gdim);
        return false; // Ошибка при создании временного изображения
    }

    // Изменение размера изображения
    imagecopyresampled(
        $temp_gdim,
        $source_gdim,
        0,
        0,
        0,
        0,
        $temp_width,
        $temp_height,
        $source_width,
        $source_height
    );

    // Обрезаем изображение до нужного размера
    $x0 = ($temp_width - $result_width) / 2;
    $y0 = ($temp_height - $result_height) / 2;

    $desired_gdim = imagecreatetruecolor($result_width, $result_height);
    if (!$desired_gdim) {
        imagedestroy($source_gdim);
        imagedestroy($temp_gdim);
        return false; // Ошибка при создании результирующего изображения
    }

    imagecopy(
        $desired_gdim,
        $temp_gdim,
        0,
        0,
        $x0,
        $y0,
        $result_width,
        $result_height
    );

    // Сохраняем изображение
    if (!imagejpeg($desired_gdim, $thumbnail_image_path, 90)) {
        imagedestroy($source_gdim);
        imagedestroy($temp_gdim);
        imagedestroy($desired_gdim);
        return false; // Ошибка при сохранении изображения
    }

    // Очистка памяти
    imagedestroy($source_gdim);
    imagedestroy($temp_gdim);
    imagedestroy($desired_gdim);

    return true;
}

function resize_no_crop($source_image_path, $thumbnail_image_path, $result_width, $result_height)
{
    if (!file_exists($source_image_path)) {
        return false;
    }

    $image_info = getimagesize($source_image_path);
    if (!$image_info) {
        return false; // Файл не является изображением
    }

    list($source_width, $source_height, $source_type) = $image_info;

    // Создаем изображение в зависимости от типа
    switch ($source_type) {
        case IMAGETYPE_GIF:
            $source_gdim = imagecreatefromgif($source_image_path);
            break;
        case IMAGETYPE_JPEG:
            $source_gdim = imagecreatefromjpeg($source_image_path);
            break;
        case IMAGETYPE_PNG:
            $source_gdim = imagecreatefrompng($source_image_path);
            break;
        default:
            return false; // Неподдерживаемый тип изображения
    }

    if (!$source_gdim) {
        return false; // Ошибка при создании исходного изображения
    }

    // Вычисляем пропорции изображений
    $source_aspect_ratio = $source_width / $source_height;
    $desired_aspect_ratio = $result_width / $result_height;

    // Определяем размеры временного изображения
    if ($source_aspect_ratio > $desired_aspect_ratio) {
        $temp_width = $result_width;
        $temp_height = (int) ($result_width / $source_aspect_ratio);
    } else {
        $temp_height = $result_height;
        $temp_width = (int) ($result_height * $source_aspect_ratio);
    }

    // Создаем временное изображение
    $temp_gdim = imagecreatetruecolor($temp_width, $temp_height);
    if (!$temp_gdim) {
        imagedestroy($source_gdim);
        return false; // Ошибка при создании временного изображения
    }

    // Изменение размера изображения
    imagecopyresampled(
        $temp_gdim,
        $source_gdim,
        0,
        0,
        0,
        0,
        $temp_width,
        $temp_height,
        $source_width,
        $source_height
    );

    // Создаем результирующее изображение
    $desired_gdim = imagecreatetruecolor($result_width, $result_height);
    if (!$desired_gdim) {
        imagedestroy($source_gdim);
        imagedestroy($temp_gdim);
        return false; // Ошибка при создании результирующего изображения
    }

    // Заполняем фон белым цветом
    $white = imagecolorallocate($desired_gdim, 255, 255, 255);
    imagefill($desired_gdim, 0, 0, $white);

    // Копируем изображение на результирующее полотно
    $x0 = ($result_width - $temp_width) / 2;
    $y0 = ($result_height - $temp_height) / 2;

    imagecopy(
        $desired_gdim,
        $temp_gdim,
        $x0,
        $y0,
        0,
        0,
        $temp_width,
        $temp_height
    );

    // Сохраняем изображение
    if (!imagejpeg($desired_gdim, $thumbnail_image_path, 90)) {
        imagedestroy($source_gdim);
        imagedestroy($temp_gdim);
        imagedestroy($desired_gdim);
        return false; // Ошибка при сохранении изображения
    }

    // Очистка памяти
    imagedestroy($source_gdim);
    imagedestroy($temp_gdim);
    imagedestroy($desired_gdim);

    return true;
}