<!DOCTYPE html>
<html>
<head>
    <title>Google Text-to-Speech API demo</title>

    <meta charset="utf-8" />

    <style type="text/css">
        #error {
            margin: 1em 0;
            color: #f00;
            font-weight: bold;
        }
        footer {
            margin-top: 5em;
        }
    </style>
</head>

<body>

<h1>Demo of Google Text-to-Speech API</h1>

<div id="tts_demo"></div>

<div id="error"></div>


<footer>
    <p>Source: <a href="https://github.com/hiddentao/google-tts">https://github.com/hiddentao/google-tts</a></p>
    <p>Developed by <a href="http://www.hiddentao.com/archives/2012/04/01/google-tts-a-javascript-api-for-google-text-to-speech-engine/">Ramesh Nair</a>, based on code by <a href="http://weston.ruter.net/projects/google-tts/">Weston Ruter</a>.</p>
</footer>

<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script type="text/javascript" src="google-tts.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        if (window.GoogleTTS) {
           $("#error").text("Sorry, the google-tts script couldn't be loaded.");
           return;
        } else {
           var HTML = '\
            <div> \
                <label for="demo_language">Language:</label> \
                <select id="demo_language"> \
                    <option value="" disabled="disabled">(Select language)</option> \
                </select> \
            </div> \
            <div> \
                <label for="demo_text">Text:</label> \
                <input type="text" size="30" id="demo_text" value=""> \
            </div> \
            <button id="demo_play">Play!</button> \
            ';
          $("#tts_demo").html(HTML);
        }

        var googleTts = new window.GoogleTTS();

        // setup language options
        $.each(googleTts.languages(), function(key, value) {
            $('#demo_language').append('<option value="' + key + '">' + value + '</option>');
        });

        // play
        $("#demo_play").click(function() {
            googleTts.play($("#demo_text").val(), $("#demo_language").val(), function(err) {
                if (err) {
                    alert(err.toString());
                }
            });
        });

        // defaults
        $("#demo_language").val('zh-CN');
        $("#demo_text").val('??');
    });
</script>


</body>
</html>