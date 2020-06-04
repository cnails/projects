#!/usr/bin/php
<?php
    function startsWith ($string, $startString) { 
        $len = strlen($startString); 
        return (substr($string, 0, $len) === $startString); 
    } 

    function func ($str) {
        global $url;
        print_r($str);
        $image = $str[1];
        if (!startsWith($image, "https://") && !startsWith($image, "http://"))
            $image = $url.$image;
        $dirname = parse_url($url, PHP_URL_HOST);
        if (!file_exists($dirname) && !is_dir($dirname))
            mkdir($dirname);
        $filename = explode("/", $image);
        $filename = $filename[count($filename) - 1];
        $filename = $dirname."/".$filename;
        if (!is_file($filename)) {
            $file = fopen($filename, "w");
            $content = curl_init($image);
            curl_setopt($content, CURLOPT_FILE, $file);
            curl_exec($content);
            curl_close($content);
            fclose($file);
        }
    }

    if ($argc == 2) {
        $url = $argv[1];
		$c = curl_init($url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $html = curl_exec($c);
        if (curl_error($c)) {
            echo "Wrong url!\n";
            exit();
        }
        curl_close($c);
        preg_replace_callback('/<img.*?src="(.*?)".*?>/', 'func', $html);
    }
?>
