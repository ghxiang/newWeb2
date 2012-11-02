<html>
<body>

<?php 
require 'Utils.php';

$username="counseling";
$passwd="counseling@0919";

$post_string = "<?xml version=\"1.0\" encoding=\"utf-8\" ?><soap12:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" xmlns:soap12=\"http://www.w3.org/2003/05/soap-envelope\"><soap12:Header><CredentialSoapHeader xmlns=\"http://jii1.ceping.com/\"><UserName>".$username."</UserName><PassWord>".$passwd."</PassWord></CredentialSoapHeader></soap12:Header><soap12:Body><BEISEN_Ende xmlns=\"http://jii1.ceping.com/\" ><text>$sourceInfo</text><key>$key</key></BEISEN_Ende></soap12:Body></soap12:Envelope>";

$remote_server = "http://jii1.ceping.com/testservice/service.asmx";

$targetURL = "http://www.ceping.cn/logon.aspx?submit=2&Email=$myEmail&SignName=$username&Url=$url&UserName=$username2&UserSex=$userSex&Sn=$SN&Md5Info=$md5Info";

echo "Target URL is: \r\n".$targetURL;

$data = request_by_socket('jii1.ceping.com', '/testservice/service.asmx', $post_string2);
echo "\r\n\r\nData is \r\n".$data;

?>

</body>
</html>