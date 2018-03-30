<!DOCTYPE html>
<html>

    <head>
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Raleway" />
        <link type="text/css" rel="stylesheet" href="/assets/css/style.css"/>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js" integrity="sha384-feJI7QwhOS+hwpX2zkaeJQjeiwlhOP+SdQDqhgvvo1DsjtiSQByFdThsxO669S2D" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="/assets/js/countUp.js"></script>
        <link rel="stylesheet/scss" type="text/css" href="/assets/css/style.scss">
        <link rel="shortcut icon" href="https://www.willows-consulting.com/wp-content/uploads/2017/08/favdark.png" type="image/x-icon" />
        <!--<script src="/assets/js/demo.js"></script>-->
    </head>

    <body>


    <div id="details" class="section">
        
        <div class="container">
            <div class="row">
                <div class="col-sm-7 col-sm-offset-2">
                    <br/><br/><br/>
                    <!--<h2>
                        <br/><br/>
                        <b>SEO:</b> Rankings
                        <br/>
                    </h2>-->
                    <form id="ranksform" method="post" action="test.php">
                        <div class="form-group">
                            <input name="site_url" placeholder="Url (https://example.com)" type="text" class="form-control" id="site_url">
                        </div>
                        <div class="form-group">
                            <input name="company_name" placeholder="Company name" type="text" class="form-control" id="company_name">
                        </div>
                        <div class="form-group">
                            <input name="email_address" placeholder="Email address" type="email" class="form-control" id="email_address">
                        </div>
                        <div class="form-group">
                            <input name="e_commerce_area" placeholder="Area of e-commerce" type="text" class="form-control" id="e_commerce_area">
                        </div>
                        <div class="form-group">
                            <input name="company_number" placeholder="Company number (digits only)" type="digits" class="form-control" id="company_number">
                        </div>
                        <div class="form-group">
                            <input name="twitter_url" placeholder="Twitter url" type="text" class="form-control" id="twitter_url">
                        </div>
                        <div class="form-group">
                            <input name="facebook_url" placeholder="Facebook url" type="text" class="form-control" id="facebook_url">
                        </div>
                        <div class="form-group">
                            <input name="snapchat_url" placeholder="Snapchat url" type="text" class="form-control" id="snapchat_url">
                        </div>
                        <div class="form-group">
                            <input name="pinterest_url" placeholder="Pinterest url" type="text" class="form-control" id="pinterest_url">
                        </div>
                        <div class="form-group">
                            <input name="instagram_url" placeholder="Instagram url" type="text" class="form-control" id="instagram_url">
                        </div>
                        <div class="form-group">
                            <select name="strategy" class="form-control" id="strategy">
                                <option value="desktop">Desktop</option>
                                <option value="mobile">Mobile</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>                    
            </div>
        </div>

        <div class="row">
            <hr/>
        </div>
    </div>

   <div id="loader" class="section" style="padding-top: 40px; padding-bottom: 40px;">
        <div class="container">
            <div class="row">
                <div class="sk-three-bounce">
                    <div class="sk-child sk-bounce1"></div>
                    <div class="sk-child sk-bounce2"></div>
                    <div class="sk-child sk-bounce3"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="results" class="section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 id="comp_name"></h1>
                    <p id="area_e_com"></p>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-sm-4">
                    <h1 id="alexa_counter">0</h1>
                    <p>World Ranking</p>
                </div>
                <div class="col-sm-4">
                    <h1><b id="google_counter">0</b>/100</h1>
                    <p>Optimization</p>
                </div>
                <div class="col-sm-4">
                    <h1 id="social_counter">0</h1>
                    <p>Total Social Media Audience</p>
                </div>
                <div class="col-sm-12">
                    <h1><i class="fa fa-refresh"></i></h1>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.sk-three-bounce').hide();
            $('#results').hide();
        });
        //$('input[name="site_url"]').attr('value')


        function getFormData($form){
            var unindexed_array = $form.serializeArray();
            var indexed_array = {};

            $.map(unindexed_array, function(n, i){
                indexed_array[n['name']] = n['value'];
            });

            return indexed_array;
        }

        $("#ranksform").ajaxForm({ 
            url: 'test.php',
            data: $("form").serialize(),
            type: 'post',
            beforeSubmit:function(result) {
                        $('.sk-three-bounce').show();
                        var company_name = getFormData($('form')).company_name;
                        var e_commerce_area = getFormData($('form')).e_commerce_area;
                        $('#details').slideUp();
                        console.log(getFormData($('form')).company_name);
                        console.log(getFormData($('form')).e_commerce_area);
                      
                        //console.log("Here");
                    },
            success: function(result) {
                        $('#comp_name').html(company_name);
                        $('#area_e_com').html(e_commerce_area);
                        $('.sk-three-bounce').hide();
                        //countUp(count);
                        var obj = jQuery.parseJSON(result);
                        $('#results').fadeIn();
                        countUp(obj.alexa_rank, obj.google_page_insight_rank, obj.social_media_audience);
                        //alert(result);
                    }
            });
            
        function countUp(alexa_rank, google_page_insight_rank, social_media_audience){
            var easingFn = function (t, b, c, d) {
            var ts = (t /= d) * t;
            var tc = ts * t;
            return b + c * (tc * ts + -5 * ts * ts + 10 * tc + -10 * ts + 5 * t);
            }
            var options = {
              useEasing: true, 
              easingFn: easingFn, 
              useGrouping: true, 
              separator: ',', 
              decimal: '.', 
            };
            var alexa_counter = new CountUp('alexa_counter', 0, alexa_rank, 0, 2.5, options);
            var google_counter = new CountUp('google_counter', 0, google_page_insight_rank, 0, 2.5, options);
            var social_counter = new CountUp('social_counter', 0, social_media_audience, 0, 2.5, options);
            if (!alexa_counter.error || !google_counter || !social_counter) {
                alexa_counter.start();
                google_counter.start();
                social_counter.start();
            } else {
              console.error(alexa_counter.error);
            }
        }
              
    </script>
    
    </body>

</html>