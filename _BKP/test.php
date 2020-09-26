<!DOCTYPE html>
<html lang="pt" dir="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- Jquery and Ajax Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>mova</title>
</head>

<body>

<iframe src="https://findfb.id/" width="100%" height="500" id="filecontainer"></iframe>

<div class="paste">
  .
</div>

<div class="butt" onclick="getFrameContents()">
  butt
</div>

<form id="demoForm" action="#">

    <p>
        <input name="button1" type="button" value="Button 1">
        <input name="button2" type="button" value="Button 2">
        <input name="button3" type="button" value="Button 3">
        <input name="button4" type="button" value="Button 4">
    </p>

    <p>Display: <input type="text" name="display" size="30" readonly="readonly"></p>

</form>

<script>

/*
$( document ).ready(function() {
  $("#filecontainer").contents().find("input[name=url]").click(function(){
      alert('ads');
  });
});
*/



    // $("#filecontainer").contents().find(".section-title").html("changed");

    function getFrameContents(){

     //var ifitem = $("#filecontainer").contents().find("section-title").html();
     //alert(ifitem);

     //$(".paste").html(form);
   }
</script>

<script>

var ifrm = document.getElementById('filecontainer');
var win = ifrm.contentWindow; // reference to iframe's window
// reference to document in iframe
//var doc = ifrm.contentDocument? ifrm.contentDocument: ifrm.contentWindow.document;
// reference to form named 'demoForm' in iframe
var form = doc.getElementById('faqs');


   document.getElementById('filecontainer').onload = function() {

    // get reference to form to attach button onclick handlers
    var form = document.getElementById('demoForm');

    // set height of iframe and display value
    form.elements.button3.onclick = function() {
        var re = /[^-a-zA-Z!,'?\s]/g; // to filter out unwanted characters
        var ifrm = document.getElementById('filecontainer');
        // reference to document in iframe
        var doc = ifrm.contentDocument? ifrm.contentDocument: ifrm.contentWindow.document;
        // get reference to greeting text box in iframed document
        //var fld = doc.forms['.finder-form'].elements['name="url"'];
        //var val = fld.value('lll');
        // display value in text box
        this.form.elements.display.value = 'The greeting is: ';
    }

}

</script>




</body>
