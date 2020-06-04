<?php
    function startsWith ($string, $startString) 
    { 
        $len = strlen($startString); 
        return (substr($string, 0, $len) === $startString); 
    } 
    if ($argc == 2) {
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $html = file_get_contents($argv[1]);
        $html = curl_exec($c);
        if (curl_error($c)) {
            echo "Wrong url!\n";
            exit();
        }
        curl_close($c);
        $dom = new DOMDocument;
        $dom->loadHTML($html);
        $url = parse_url($argv[1], PHP_URL_HOST);
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $image) {
            $image = $image->getAttribute("src");
            if (!startsWith($image, "https://"))
                $image = $argv[1].$image;
            if (file_exists($url) === 0 && is_dir($url === 0))
                mkdir($url);
            file_put_contents($url."/".(end(explode("/", $image))));
        }
    }
?>
