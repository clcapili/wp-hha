<?php
    function lever_data() {

        $data = getDataWithAuthorizationBearer(
            'https://api.lever.co/v0/postings/hhaexchange?group=team&mode=json', 
            'QCWEBRhjUFefftS-xikX'
        );
        
        print_r($data);
        
        exit();
    }

    add_action('wp_ajax_lever_data',        'lever_data');
    add_action('wp_ajax_nopriv_lever_data', 'lever_data');
        
    function getDataWithAuthorizationBearer($url, $token) {
        
        $cookie = tmpfile();
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.140 Safari/537.36 Edge/18.17763');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer ' . $token));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        return curl_exec($ch);
        //
    }
?>
