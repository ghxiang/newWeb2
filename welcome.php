<html>
<head>
	<style type="text/css">
		iframe {
			overflow-y: auto
		}
	</style>
</head>

<?php 
require 'Utils.php';

$username="counseling";
$passwd="counseling@0919";
//header("content-type:text/html; charset=utf-8");

//$post_string = "ActivityId=17808";
/*
$post_string = "<?xml version=\"1.0\" encoding=\"utf-8\" ?><soap12:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap12=\"http://www.w3.org/2003/05/soap-envelope\"><soap12:Header><CredentialSoapHeader xmlns=\"http://jii1.ceping.com/\"><UserName>".$username."</UserName><PassWord>".$passwd."</PassWord></CredentialSoapHeader></soap12:Header><soap12:Body><BEISEN_GetActivitys xmlns=\"http://jii1.ceping.com/\" /></soap12:Body></soap12:Envelope>";
*/
$post_string1 = "<?xml version=\"1.0\" encoding=\"utf-8\" ?><soap12:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap12=\"http://www.w3.org/2003/05/soap-envelope\"><soap12:Header><CredentialSoapHeader xmlns=\"http://jii1.ceping.com/\"><UserName>".$username."</UserName><PassWord>".$passwd."</PassWord></CredentialSoapHeader></soap12:Header><soap12:Body><BEISEN_GetActivityTests xmlns=\"http://jii1.ceping.com/\"><activityId>17808</activityId></BEISEN_GetActivityTests></soap12:Body></soap12:Envelope>";

$key = "1111111111111111";
$SN = "16298371";
$myEmail = "ghxiang@gmail.com";
$url = "http://www.xlzx.cn/feedback.php";
$username2 = "ghxiang";
$userSex = "M";
//Email + SignName + Url + UserName + UserSex
$sourceInfo = $myEmail.$username.$url.$username2.$userSex;

$post_string2 = "<?xml version=\"1.0\" encoding=\"utf-8\" ?><soap12:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap12=\"http://www.w3.org/2003/05/soap-envelope\"><soap12:Header><CredentialSoapHeader xmlns=\"http://jii1.ceping.com/\"><UserName>".$username."</UserName><PassWord>".$passwd."</PassWord></CredentialSoapHeader></soap12:Header><soap12:Body><BEISEN_GetResultBySn xmlns=\"http://jii1.ceping.com/\" ><sn>".$SN."</sn><testIdentityObj>Anchor</testIdentityObj></BEISEN_GetResultBySn></soap12:Body></soap12:Envelope>";

$remote_server = "http://jii1.ceping.com/testservice/service.asmx";


//$md5Info = "37d88312465c072a57baf78a747395c6";
//$targetURL = "http://www.ceping.cn/logon.aspx?submit=2&Email=$myEmail&SignName=$username&Url=$url&UserName=$username2&UserSex=$userSex&Sn=$SN&Md5Info=$md5Info";
//echo "Target URL is: \r\n".$targetURL;

//url = http://www.ceping.cn/logon.aspx?submit=2&Email=ghxiang@gmail.com&SignName=counseling&Url=http://www.test.com/test.asp&UserName=test&UserSex=Male&Sn=79344987&Md5Info=83121dbcad7cd4e5b55c56dea1cc35a9
/*
$context = array(
	'http'=>array(
	'method'=>'POST',
	'header'=>'Content-type: application/soap+xml; charset=utf-8'."\r\n".
//	'User-Agent : POST Example'."\r\n".
	'Content-length:'.(strlen($post_string1)+1)."\r\n",
	'content'=>$post_string1)
);

$stream_context = stream_context_create($context);
echo "Stream context is ".$stream_context;
*/
//$data = file_get_contents($remote_server,FALSE,$stream_context);
$data = request_by_socket('jii1.ceping.com', '/testservice/service.asmx', $post_string2);
//$result = base64_decode($data);
//echo "\r\n\r\nData is \r\n".$data;


$doc = new DOMDocument();
$doc->loadXML($data);
$testIdElems = $doc->getElementsByTagName("Httpurl");
//var_dump($doc);
global $url;

foreach ($testIdElems as $testIdElem) {

  $url = $testIdElem->nodeValue;
  //echo "\r\n\r\n url is: ".$url."\r\n";
  
	//$md5info = $testIdElem->nodeValue;
  //echo "testId is: ".$md5info."\r\n";
}

/*
$targetURL = "http://www.ceping.cn/logon.aspx?submit=2&Email=$myEmail&SignName=$username&Url=$url&UserName=$username2&UserSex=$userSex&Sn=$SN&Md5Info=$md5info";

echo "Target URL is: \r\n".$targetURL;
*/

//echo "<iframe  src=$url frameborder=0 width=100% height=100% scrolling=no onload=\"SetCwinHeight(this)\" ></iframe>";
echo "<frameset frameborder=0 rows=*><frame src=\"$url\" width=100% height=100%></frame></frameset>";
?>




</html>
