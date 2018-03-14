<!DOCTYPE html>
<html>

    <head>
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Maven+Pro" />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js" integrity="sha384-feJI7QwhOS+hwpX2zkaeJQjeiwlhOP+SdQDqhgvvo1DsjtiSQByFdThsxO669S2D" crossorigin="anonymous"></script>
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
            if(isset($_POST['site_url'])&&isset($_POST['strategy'])):
                $api_key = "AIzaSyBlL2LAkKph5z4X6azb99kWIMyFvFYiAsY";
                $site_url = str_replace("%3A%2F%2F","://",$_POST['site_url']);
                $strategy = $_POST['strategy'];
                $url = "http://data.alexa.com/data?cli=10&dat=snbamz&url=" . str_replace("%3A%2F%2F","://",$_POST['site_url']);
                $insight_url = "https://www.googleapis.com/pagespeedonline/v4/runPagespeed?url=" . str_replace("%3A%2F%2F","://",$_POST['site_url']) . "&strategy=" . $_POST['strategy'] . "&key=".$api_key;
                $xmlstr = simplexml_load_file($url);
                $content_insights = file_get_contents($insight_url);
                $array_insights = json_decode($content_insights, true);
                ?>
            <div class="row">
                <div class="col-sm-7 col-sm-offset-2">
                    <h3>
                        <br/><br/>
                        Results for <?= $array_insights['title'] ?>
                    </h3>

                    <hr/>

                    <table class="table table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Version</th>
                            <th>URL</th>
                            <th>Home</th>
                            <th>AID</th>
                            <th>IDN</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <?php
                            foreach($xmlstr->attributes() as $a => $b):
                                ?>
                                <td><?= $b ?></td>
                            <?php
                            endforeach;
                            ?>
                        </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Owner</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <?php
                            foreach($xmlstr->children()[1] as $child):
                                foreach($child->attributes() as $key => $value ):
                                    ?>
                                    <td><?= $value ?></td>
                                <?php
                                endforeach;
                            endforeach;

                            ?>
                        </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Rankings</th>
                            <th>Source</th>
                            <th>Reach Rank</th>
                            <th>Rank Delta</th>
                            <th>Country Code</th>
                            <th>Country Name</th>
                            <th>Country Rank</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <?php
                            if(isset($xmlstr)):
                                foreach($xmlstr->children()[2] as $child):
                                    foreach($child->attributes() as $key => $value ):
                                        ?>
                                        <td><?= $value ?></td>
                                    <?php
                                    endforeach;
                                endforeach;
                            endif;
                            ?>
                        </tr>
                        </tbody>
                    </table>

                    <hr/>

                    <div class="row">
                        <div class="col-sm-7 col-sm-offset-2">
                            <h3>
                                <b>Optimisation:</b>


                            </h3>
                            <p class="lead">Score: <?=$array_insights['ruleGroups']['SPEED']['score'] ?>/100</p>
                            <p class="lead">Guidelines:</p>
                            <p id="optimisation"></p>
                            <div style="display: none" id="alert" class="alert alert-success"></div>
                        </div>
                    </div>

                </div>
            </div>


            <?php
                endif;
             ?>
        </div>
    </div>

    <style>
        h1 {
            font-family: "Maven Pro";
            font-size: 24px;
            font-style: normal;
            font-variant: normal;
            font-weight: 500;
            line-height: 26.4px;
        }
        h3 {
            font-family: "Maven Pro";
            font-size: 14px;
            font-style: normal;
            font-variant: normal;
            font-weight: 500;
            line-height: 15.4px;
        }
        p {
            font-family: "Maven Pro";
            font-size: 14px;
            font-style: normal;
            font-variant: normal;
            font-weight: 400;
            line-height: 20px;
        }
        blockquote {
            font-family: "Maven Pro";
            font-size: 21px;
            font-style: normal;
            font-variant: normal;
            font-weight: 400;
            line-height: 30px;
        }
        pre {
            font-family: "Maven Pro";
            font-size: 13px;
            font-style: normal;
            font-variant: normal;
            font-weight: 400;
            line-height: 18.5714px;
        }
        *{
            font-family: "Maven Pro",Arial,sans-serif !important;
        }
        .form-control {
            border: none !important;
            border-bottom: 1px solid #ced4da !important;
            border-radius: 0rem;
        }
        .form-control:focus {
            border-color: #fff !important;
        }

        select {
            border: none !important;
            border-bottom: 1px solid #ced4da !important;
        }

        button{
            border-radius: 0px !important;
        }
    </style>

    <script>
        // Specify your actual API key here:
        var API_KEY = 'AIzaSyBlL2LAkKph5z4X6azb99kWIMyFvFYiAsY';

        // Specify the URL you want PageSpeed results for here:
        var URL_TO_GET_RESULTS_FOR = "<?= $site_url; ?>";

        var API_URL = 'https://www.googleapis.com/pagespeedonline/v4/runPagespeed?';
        var CHART_API_URL = 'http://chart.apis.google.com/chart?';

        // Object that will hold the callbacks that process results from the
        // PageSpeed Insights API.
        var callbacks = {}

        // Invokes the PageSpeed Insights API. The response will contain
        // JavaScript that invokes our callback with the PageSpeed results.
        function runPagespeed() {
            var s = document.createElement('script');
            s.type = 'text/javascript';
            s.async = true;
            var query = [
                'url=' + URL_TO_GET_RESULTS_FOR,
                'callback=runPagespeedCallbacks',
                'key=' + API_KEY,
            ].join('&');
            s.src = API_URL + query;
            console.log(s.src);
            document.head.insertBefore(s, null);
        }

        // Our JSONP callback. Checks for errors, then invokes our callback handlers.
        function runPagespeedCallbacks(result) {
            if (result.error) {
                var errors = result.error.errors;
                for (var i = 0, len = errors.length; i < len; ++i) {
                    if (errors[i].reason == 'badRequest' && API_KEY == 'yourAPIKey') {
                        alert('Please specify your Google API key in the API_KEY variable.');
                    } else {
                        // NOTE: your real production app should use a better
                        // mechanism than alert() to communicate the error to the user.
                        alert(errors[i].message);
                    }
                }
                return;
            }

            // Dispatch to each function on the callbacks object.
            for (var fn in callbacks) {
                var f = callbacks[fn];
                if (typeof f == 'function') {
                    callbacks[fn](result);
                }
            }
        }

        // Invoke the callback that fetches results. Async here so we're sure
        // to discover any callbacks registered below, but this can be
        // synchronous in your code.
        setTimeout(runPagespeed, 0);

        callbacks.displayTopPageSpeedSuggestions = function(result) {
            var optimisation = document.getElementById("optimisation");
            var alert = document.getElementById("alert");
            var results = [];
            var ruleResults = result.formattedResults.ruleResults;
            for (var i in ruleResults) {
                var ruleResult = ruleResults[i];
                // Don't display lower-impact suggestions.

                if (ruleResult.ruleImpact < 3.0) continue;
                results.push({name: ruleResult.localizedRuleName,
                    impact: ruleResult.ruleImpact});
            }
            results.sort(sortByImpact);
            var ul = document.createElement('ul');
            for (var i = 0, len = results.length; i < len; ++i) {
                var r = document.createElement('li');
                r.innerHTML = results[i].name;
                //ul.insertBefore(r, optimisation);
                optimisation.appendChild(r);
            }
            if (ul.hasChildNodes()) {
                //document.body.insertBefore(ul, optimisation);
                optimisation.appendChild(ul);
            } else {
                var div = document.createElement('div');
                div.innerHTML = 'No high impact suggestions. Good job!';
                //document.body.insertBefore(div, optimisation);
                alert.style.setProperty("display","block","");
                alert.appendChild(div);
            }
        };

        // Helper function that sorts results in order of impact.
        function sortByImpact(a, b) { return b.impact - a.impact; }
    </script>


    </body>

</html>