  <?php
/**
 * 		Copyright:SmartCome
 * 		WebSite:www.SmartCome.com
 *      QQ:2811931192
 *              
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
   $fcid=intval($_GET['fcid']);$scid=intval($_GET['scid']);
   $tcid=intval($_GET['tcid']);
   $fclass= C::t("#smart_video#video")->fetch_all("type=1");
   if($fcid)$sclass= C::t("#smart_video#video")->fetch_all("type=2 and cup=$fcid");
   if($scid)$tclass= C::t("#smart_video#video")->fetch_all("type=3 and cup=$scid");
   if(submitcheck('search_submit',1)){
		if($_GET['urlkey']){
			$key=trim(urldecode($_GET['urlkey']));
		}else{
			$key=trim($_POST['key']);
		}
			if($key){
			$key=stripsearchkey($key);
			$where="subject LIKE '%".$key."%' and ";}
			}
			$c_array=array('fcid','scid','tcid');
			foreach($c_array as$ck=>$cv){
			$tmp=$$cv;
			if($tmp){
			$where.="$cv=$tmp and ";
			}else{
			$where.="1=1 and ";
			}
	   		
		}
	$where.="visiable=1";	
	$where=str_replace("1=1 and 1=1","1=1",$where);
	$where=str_replace("1=1 and 1=1","1=1",$where);
	if(!$where){$where="visiable=1";}
   $urlkey=urlencode($key);
   $perpage=max(1,$smart['perpage']);$page=max(1,intval($_GET['page']));
   $start=$perpage*$page-$perpage;
   if($_GET['order']=='play'){$order='play desc,dateline desc';}elseif($_GET['order']=='grade'){$order='grade desc,dateline desc';}else{$order='dateline desc,play desc';}
   $posts=C::t("#smart_video#video")->fetch_all_by_where('smart_video_thread',$where,$order,$start,$perpage);
   $maxnum=C::t("#smart_video#video")->count_by_where('smart_video_thread',$where); 
   define("SMART_SEARCH_URL","plugin.php?id=smart_video&mod=s&search_submit=1&urlkey=$urlkey&formhash=".FORMHASH);
   $url="plugin.php?id=smart_video&mod=s&fcid=$fcid&scid=$scid&tcid=$tcid&urlkey=$urlkey&search_submit=1&formhash=".FORMHASH;
      if(!defined('IN_MOBILE')){
		  $multi=multi($maxnum,$perpage,$page,$url,0,10,true,FALSE);
	   }else{$multi=get_bootstrap_page($maxnum,$perpage,$page,$url,10,0);}
   
   $audionum=count($posts);
   $navtitle.="-$key";
   $metakeywords=$navtitle.',$key';
   include template("smart_video:s");
  
  ?>