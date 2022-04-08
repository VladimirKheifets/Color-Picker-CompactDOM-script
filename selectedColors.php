<?
echo <<<HTML
<style>
.allColors{width:320px}
.title{font-size: 18px;line-height: 25px;margin-bottom: 20px;}
.post{
	border:1px solid #000000;
	margin:10 0 10 0;
	padding:10px;
	text-align:center}
</style>
<div style="allColors">
<div class='title'>PHP script selectedColors.php<br>
AJAX Post Request was<br>reseived from index.html</div>
HTML;
foreach($_POST as $key=>$value)
echo <<<HTML
<div  class = 'post' style="background-color:$value">
\$_POST['$key'] = $value
</div>
HTML;
?>
</div>