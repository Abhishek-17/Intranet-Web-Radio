<?php

// Convert Words (text) to Speech (MP3)
// ------------------------------------

// Google Translate API cannot handle strings > 100 characters
   $words = substr($_GET['words'], 0, 100);

// Replace the non-alphanumeric characters 
// The spaces in the sentence are replaced with the Plus symbol
   $words = urlencode($_GET['words']);

// Name of the MP3 file generated using the MD5 hash
   $file  = md5($words);
  
// Save the MP3 file in this folder with the .mp3 extension 
   $file = &quot;audio/&quot; . $file . &quot;.mp3&quot;;

// If the MP3 file exists, do not create a new request
   if (!file_exists($file)) {
     $mp3 = file_get_contents(
        'http://translate.google.com/translate_tts?q=' . $words;
     file_put_contents($file, $mp3);
   }
?>

// Embed the MP3 file using the AUDIO tag of HTML5
<audio controls=&quot;controls&quot; autoplay=&quot;autoplay&quot;>
  <source src=&quot;<? echo $file; ?>&quot; type=&quot;audio/mp3&quot; />
</audio>


-----------------------------------

<?php

 class TextToSpeech {
 public $mp3data;
 function __construct($text="") {
        $text = trim($text);
        if(!empty($text)) {
            $text = urlencode($text);
            $this->mp3data = file_get_contents("http://translate.google.com/translate_tts?q={$text}");
        }
    }
 
    function setText($text) {
        $text = trim($text);
        if(!empty($text)) {
            $text = urlencode($text);
            $this->mp3data = file_get_contents("http://translate.google.com/translate_tts?q={$text}");
            return $mp3data;
        } else { return false; }
    }
 
    function saveToFile($filename) {
        $filename = trim($filename);
        if(!empty($filename)) {
            return file_put_contents($filename,$this->mp3data);
        } else { return false; }
    }
 
}

$data="Hello, I am testing the API.";

$tts = new TextToSpeech();
$tts->setText($data);
$tts->saveToFile("masnun.mp3");

?>

<audio controls="controls">
  <source src="masnun.mp3" type="audio/mpeg" />
  Your browser does not support the audio element.
</audio>