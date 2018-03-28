<!DOCTYPE html>
<html>

    <head>
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Maven+Pro" />
        <link type="text/css" rel="stylesheet" href="/assets/css/style.css"/>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js" integrity="sha384-feJI7QwhOS+hwpX2zkaeJQjeiwlhOP+SdQDqhgvvo1DsjtiSQByFdThsxO669S2D" crossorigin="anonymous"></script>
        <script src="/assets/js/chart.js"></script>
        <script src="/assets/js/utils.js"></script>
    </head>

    <body>
    <div class="section">
        <?php
            isset($site_url)?$site_url = str_replace("%3A%2F%2F","://",$_POST['site_url']):$site_url = "https://www.willows-consulting.com/";
            $strategy = "desktop";
        ?>
        <div class="container">
            <div class="row>">
                <div class="col-sm-7 col-sm-offset-2">
                    <h2>
                        <br/><br/>
                        <b>SEO:</b> Rankings
                        <br/>
                    </h2>
                    <form onsubmit="myFunction()" method="post" action="index.php">
                        <div class="form-group">
                            <input value="<?= $site_url ?>" name="site_url" placeholder="Please enter your url (https://example.com)" type="url" class="form-control" id="site_url">
                        </div>
                        <div class="form-group">
                            <select name="strategy" class="form-control" id="strategy">
                                <option <?= ($strategy === "desktop")?"selected":""?> value="desktop">Desktop</option>
                                <option <?= ($strategy === "mobile")?"selected":""?> value="mobile">Mobile</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>

                </div>
            </div>
           

             <?php
                
            ?>
        </div>
    </div>
    
    <script>
        var alexa_rank = <?= $rank ?>;
        var google_page_insight_rank = <?=$array_insights['ruleGroups']['SPEED']['score'] ? $array_insights['ruleGroups']['SPEED']['score'] : 0?>;
        var social_media_audience = <?=$likes + $followedBy ? $likes + $followedBy : 0?>;
		
        $.ajax({ 
            url: 'index.php',
            data: {function2call: 'getEmployeesList', otherkey:otherdata},
            type: 'post',
            success: function(output) {
                        alert(output);
                    }
            });

	</script>

    <?php 
    
        if(isset($_POST['getranks']) && !empty($_POST['getranks'])) {
            $function2call = $_POST['getranks'];
            switch($function2call) {
                case 'allofthem' : dostuff();break;
                case 'other' : // do something;break;
                // other cases
            }
        }

        public function dostuff(){

            $api_key = "AIzaSyBlL2LAkKph5z4X6azb99kWIMyFvFYiAsY";
            $site_url = str_replace("%3A%2F%2F","://",$_POST['site_url']);
            $strategy = $_POST['strategy'];
            $url = "http://data.alexa.com/data?cli=10&dat=snbamz&url=" . str_replace("%3A%2F%2F","://",$_POST['site_url']);
            $insight_url = "https://www.googleapis.com/pagespeedonline/v4/runPagespeed?url=" . str_replace("%3A%2F%2F","://",$_POST['site_url']) . "&strategy=" . $_POST['strategy'] . "&key=".$api_key;
            $xmlstr = simplexml_load_file($url);
            $rank=isset($xmlstr->SD[1]->POPULARITY)?$xmlstr->SD[1]->POPULARITY->attributes()->TEXT:0;
            $content_insights = file_get_contents($insight_url);
            $array_insights = json_decode($content_insights, true);

            $object_url = "https://www.facebook.com/54971236771/"; // or by id
            
                $ch = curl_init("https://www.facebook.com/v2.5/plugins/like.php?locale=en_US&href=".$object_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_USERAGENT, 'Chrome');
                $html = curl_exec($ch);
            
                preg_match("/and ([0-9,.]+?) others/", $html, $match);
                $likes = floatval(str_replace(array(',','.'), '', $match[1]));
            
                echo $likes . "<br/><br/>";

                echo $rank  . "<br/><br/>";

                $otherPage = 'google';
                $response = file_get_contents("https://www.instagram.com/$otherPage/?__a=1");
                if ($response !== false) {
                    $data = json_decode($response, true);
                    if ($data !== null) {
                        $followedBy = $data['graphql']['user']['edge_followed_by']['count'];
                        echo $followedBy;
                    }
                }
        }

    ?>



    </body>

</html>