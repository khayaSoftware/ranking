<!DOCTYPE html>
<html>

    <head>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js" integrity="sha384-feJI7QwhOS+hwpX2zkaeJQjeiwlhOP+SdQDqhgvvo1DsjtiSQByFdThsxO669S2D" crossorigin="anonymous"></script>
    </head>

    <body>
    <div class="section">
        <div class="container">
            <div class="row>">
                <div class="col-sm-7 col-sm-offset-2">
                    <h2>
                        <br/><br/>
                        <b>SEO:</b> Rankings
                    </h2>
                    <form role="form" action="index.php">
                        <div class="form-group">
                            <input name="site_url" placeholder="Please enter your url (https://example.com)" type="url" class="form-control" id="site_url">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>

                </div>
            </div>

        </div>
    </div>

    <?php
            if(isset($REQUEST['site_url'])){
                $url = "http://data.alexa.com/data?cli=10&dat=snbamz&url=" . $REQUEST['site_url'];
                $xmlstr = simplexml_load_file($url);

                foreach($xmlstr->attributes() as $a => $b)
                {
                    echo $a,'="',$b,"\"\n";
                    echo '<br/><br/>';
                }
                foreach($xmlstr->children()->attributes() as $a => $b)
                {
                    echo $a,'="',$b,"\"\n";
                    echo '<br/><br/>';
                }
            }


    ?>%3A%2F%2F

    <?php
        if(isset($REQUEST['site_url'])) {
            var_dump($xmlstr->children()->children());
        }
    ?>


    <style>
        .form-control {
            border: none !important;
            border-bottom: 1px solid #ced4da !important;
            border-radius: 0rem;
        }
        .form-control:focus {
            border-color: #fff !important;
        }
    </style>

    </body>

</html>