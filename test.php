<?php

    if(isset($_POST) && !empty($_POST)) {
        //var_dump($_POST['site_url']);
        //var_dump($_POST['strategy']);
        //var_dump($_POST['fb_url']);
        //var_dump($_POST['ig_url']);
        $site_url = $_POST['site_url'];
        $strategy = $_POST['strategy'];
        $facebook = $_POST['facebook_url'];
        $instagram = $_POST['instagram_url'];

        dostuff($site_url, $strategy, $facebook, $instagram);
        
    }
    //dostuff("https://www.nasa.gov/","desktop","https://www.facebook.com/NASA/","https://www.instagram.com/nasa");
    function dostuff($site_url, $strategy, $facebook, $instagram){
        $api_key = "AIzaSyBlL2LAkKph5z4X6azb99kWIMyFvFYiAsY";

        $url = "http://data.alexa.com/data?cli=10&dat=snbamz&url=" . $site_url;
        $insight_url = "https://www.googleapis.com/pagespeedonline/v4/runPagespeed?url=" . $site_url . "&strategy=" . $strategy . "&key=".$api_key;
        $xmlstr = simplexml_load_file($url);
        $rank=isset($xmlstr->SD[1]->POPULARITY)?(int)$xmlstr->SD[1]->POPULARITY->attributes()->TEXT:0;
        $content_insights = file_get_contents($insight_url);
        $array_insights = json_decode($content_insights, true);

        $ch = curl_init("https://www.facebook.com/v2.5/plugins/like.php?locale=en_US&href=".$facebook);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Chrome');
        $html = curl_exec($ch);
        preg_match("/and ([0-9A-Za-z.,]+?) others/", $html, $match);
        $likes = floatval(str_replace(array(',','.'), '', $match[1]));

        $response = file_get_contents($instagram."/?__a=1");
        if ($response !== false) {
            $data = json_decode($response, true);
            if ($data !== null) {
                $followedBy = $data['graphql']['user']['edge_followed_by']['count'];
            }
        }

        $google_insight = $array_insights['ruleGroups']['SPEED']['score'] ? $array_insights['ruleGroups']['SPEED']['score'] : 0; 

        echo json_encode(array("alexa_rank"=>$rank, "google_page_insight_rank"=>$google_insight, 'social_media_audience'=> $likes + $followedBy));
    }

?>