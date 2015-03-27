<!DOCTYPE HTML>
<html>
<body>
<h1>In this demonstration:<br />
>tts is done on server side (i.e by using Google-translate server)<br/>
>then the audio received from Google-translate server is saved on your server (local/production)<br />
>and then that saved audio is played through that saved file on this webpage.</h1>
<h3>
Tested with:
Chrome v21 [Working],
Firefox v14 [Not Working, firefox does not support mp3 audio format playback],
IE v9[Working]
</h3>
<hr />
<form method="POST" style="font-size:25px">
Text to convert : <input name="txt" type="text" /><br />
Filename to save (without the extension) : <input name="filename" type="text" /><br />
Convert text to speech : <input name="submit" type="submit" value="Convert" />
</form>

<?php
if (isset($_POST['txt']) && isset($_POST['filename']))
{
	$text=htmlentities($_POST['txt']);
	$filename=$_POST['filename'].'.mp3';
	
	$querystring = http_build_query(array(
		//you can try other language codes here like en-english,hi-hindi,es-spanish etc
		"tl" => "en",
		"q" => $text
	));
	
	if ($soundfile = file_get_contents("http://translate.google.com/translate_tts?".$querystring))
	{
		file_put_contents($filename,$soundfile);
		echo ('
			<audio autoplay="autoplay" controls="controls">
			<source src="'.$filename.'" type="audio/mp3" />
			</audio>
			<br />
			Saved mp3 location : '.dirname(__FILE__).'\\'.$filename.'
			<br />
			Saved mp3 uri : <a href="'.$filename.'">'.$_SERVER['SERVER_NAME'].'/webtts/'.$filename.'</a>'
		);
	}
	else echo("<br />Audio could not be saved");
}
?>
</body>
</html>