<?php

use Illuminate\Support\Facades\Log;
use Modules\Admins\Entities\AdminMenus;

if (function_exists('menu_admins')) {
    function menu_admins()
    {
        return AdminMenus::with('roles')->parentId(0)->active()->get();
    }
}

if (!defined('COLORS')) {
    define('COLORS', [
        'primary' => '#0d6efd',
        'danger' => '#dc3545',
        'success' => '#198754',
        'info' => '#0dcaf0',
        'secondary' => '#6c757d',
        'light' => '#f8f9fa',
        'dark' => '#212529',
        'warning' => '#ffc107'
    ]);
}

if (!function_exists('showLog')) {
    function showLog(\Throwable $th)
    {
        Log::error([
            'file' => $th->getFile(),
            'line' => $th->getLine(),
            'message' => $th->getMessage()
        ]);
    }
}

if (!function_exists('convertNumberToWords')) {
    function convertNumberToWords($number)
    {
        $hyphen = ' ';
        $conjunction = '  ';
        $separator = ' ';
        $negative = 'âm ';
        $decimal = ' phẩy ';
        $dictionary = array(
            0 => 'không',
            1 => 'một',
            2 => 'hai',
            3 => 'ba',
            4 => 'bốn',
            5 => 'năm',
            6 => 'sáu',
            7 => 'bảy',
            8 => 'tám',
            9 => 'chín',
            10 => 'mười',
            11 => 'mười một',
            12 => 'mười hai',
            13 => 'mười ba',
            14 => 'mười bốn',
            15 => 'mười năm',
            16 => 'mười sáu',
            17 => 'mười bảy',
            18 => 'mười tám',
            19 => 'mười chín',
            20 => 'hai mươi',
            30 => 'ba mươi',
            40 => 'bốn mươi',
            50 => 'năm mươi',
            60 => 'sáu mươi',
            70 => 'bảy mươi',
            80 => 'tám mươi',
            90 => 'chín mươi',
            100 => 'trăm',
            1000 => 'ngàn',
            1000000 => 'triệu',
            1000000000 => 'tỷ',
            1000000000000 => 'nghìn tỷ',
            1000000000000000 => 'ngàn triệu triệu',
            1000000000000000000 => 'tỷ tỷ'
        );
        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int)$number < 0) || (int)$number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error('convertNumberToWords only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING);
            return false;
        }

        if ($number < 0) {
            return $negative . convertNumberToWords(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens = ((int)($number / 10)) * 10;
                $units = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . convertNumberToWords($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int)($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = convertNumberToWords($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= convertNumberToWords($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }
}
// function remove tag in DB
if (!function_exists('remove_tag_script')) {
    function remove_tag_script($html)
    {
        $str1 = str_replace("<script", "&lt;script", $html);
        $str = str_replace("</script>", "&lt;/script&gt;", $str1);
        return $str;
    }
}

if (!function_exists('generateRandomString')) {
    function generateRandomString($length = 10,  $is_number = false)
    {
        if ($is_number == true) {
            $length -= 1;
            return ($length > 0) ? random_int(1, 9) . substr(str_shuffle(str_repeat($x = '0123456789', ceil($length / strlen($x)))), 1, $length) : '';
        }
        return ($length > 0) ? substr(str_shuffle(str_repeat($x = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length) : '';
    }
}

if (!function_exists('remove_all_file')) {
    function remove_all_file($glob)
    {
        $files = $glob;
        foreach ($files as $file) { // iterate files
            if (is_file($file)) {
                unlink($file); // delete file
            }
        }
    }
}
if (!function_exists('rrmdir')) {
    function rrmdir($dir)
    {
        if (is_dir($dir)) {
            $files = scandir($dir);
            foreach ($files as $file) {
                if ($file != "." && $file != "..") {
                    if (filetype($dir . "/" . $file) == "dir") rrmdir($dir . "/" . $file);
                    else unlink($dir . "/" . $file);
                }
            }
            reset($files);
            rmdir($dir);
        }
    }
}

if (!function_exists('unlink')) {
    function unlink($file_path)
    {
        if (is_file("$file_path")) {
            return unlink("$file_path");
        }
        return false;
    }
}
if (!function_exists('copydir')) {
    function copydir($from_dir, $to_dir)
    {
        if (is_dir($from_dir)) {
            if ($handle = opendir($from_dir)) {
                while (false !== ($file = readdir($handle))) {
                    if ($file != "." && $file != "..") {
                        if (!is_dir($from_dir . '/' . $file)) {
                            copy($from_dir . '/' . $file, $to_dir . '/' . $file);
                        } else {
                            if (!file_exists($to_dir . '/' . $file)) mkdir($to_dir . '/' . $file, 0777, true);
                            copydir($from_dir . '/' . $file, $to_dir . '/' . $file);
                        }
                    }
                }
                closedir($handle);
            }
        }
    }
}

if (!function_exists('createFile')) {
    function createFile($fileName, $content)
    {
        $newFile = fopen($fileName, "w") or die("Unable to open file!");
        fwrite($newFile, $content);
        fclose($newFile);
    }
}

if (!function_exists('createZipArchive')) {
    function createZipArchive($dir_path, $file_path)
    {
        $zip = new \ZipArchive();
        if ($zip->open($file_path, \ZipArchive::CREATE) == TRUE) {
            $zip = zipAddFile($zip, $dir_path);
            $zip->close();
        }
    }
}

if (!function_exists('zipAddFile')) {
    function zipAddFile($zip, $dir, $root_path = '')
    {
        if (is_dir($dir)) {
            if ($handle = opendir($dir)) {
                while (false !== ($file = readdir($handle))) {
                    if ($file != "." && $file != "..") {
                        if (!is_dir($dir . '/' . $file)) {
                            if ($root_path == '') $zip->addFromString($file, file_get_contents($dir . '/' . $file));
                            else $zip->addFromString($root_path . '/' . $file, file_get_contents($dir . '/' . $file));
                        } else {
                            if ($root_path == '') {
                                $zip->addEmptyDir($file);
                                $zip = zipAddFile($zip, $dir . '/' . $file, $file);
                            } else {
                                $zip->addEmptyDir($root_path . '/' . $file);
                                $zip = zipAddFile($zip, $dir . '/' . $file, $root_path . '/' . $file);
                            }
                        }
                    }
                }
                closedir($handle);
            }
        }
        return $zip;
    }
}

if (!function_exists('pushLogServer')) {
    function pushLogServer($options = [])
    {
        try {
            $data = [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'scheme' => 'http',
                'host' => env('PUSHER_HOST'),
                'port' => env('PUSHER_APP_PORT'),
            ];
            $pusher = new \Pusher\Pusher(env('PUSHER_APP_KEY'), env("PUSHER_APP_SECRET"), env('PUSHER_APP_ID'), $data);
            $pusher->trigger($options['channel'], $options['event'], $options['data']);
        } catch (\Throwable $th) {
        }
    }
}

if (!function_exists('get_ip')) {
    function get_ip()
    {
        return $_SERVER['REMOTE_ADDR'] ?? '';
    }
}

if (!function_exists('get_device')) {
    function get_device()
    {
        return $_SERVER['HTTP_USER_AGENT'] ?? '';
    }
}

if (!function_exists('bytesToHuman')) {
    function bytesToHuman($bytes, $fix = 3)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
        for ($i = 0; $bytes >= 1024; $i++) {
            $bytes /= 1024;
        }
        return round($bytes, $fix) . ' ' . $units[$i];
    }
}
