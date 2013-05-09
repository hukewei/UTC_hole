<?php
/*
 * This example for invoke RenRen RESTful Webservice
 * It MUST be extends RESTClient
 * The requirement of PHP version is 5.2.0 or above, and support as below:
 * cURL, Libxml 2.6.0
 *
 * @Modified by kewei on 2013/05/08.
 * @Version: 0.0.1 alpha
 * @Blog:	http://blog.kekebox.com
 * @Link:	http://kewei.me
 * @Author:	Edison tsai<dnsing@gmail.com>

 */

require_once 'renrenRestApiService.class.php';

$rrObj = new RenrenRestApiService;
//accesstoken
$accesstoken='233943|6.67sadasdsadhjkashdkjad2000.1370620800-278365310';//由serv.php获取到的令牌，有效期应该为30天，可以续期，过期及时修改

//$rrObj->setEncode("GB2312");//如果是utf-8的环境可以不用设，如果当前环境不是utf8编码需要在这里设定


/*
*发送消息给公共主页
*/


$status = $_REQUEST["status"];

if (strlen($status)>5 && strlen($status)<140){
$params = array('page_id'=>'601722988','status'=>$status.' 通过UTC树洞发布. http://utc.kekebox.com','access_token'=>$accesstoken);
$res = $rrObj->rr_post_curl('pages.setStatus', $params);//curl函数发送请求
echo($res);
}

?>