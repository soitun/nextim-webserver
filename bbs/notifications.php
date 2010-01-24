<?php 
include_once('common.php');
include_once DISCUZ_ROOT.'./uc_client/client.php';
$page = max($page, 1);
$action = !empty($action) ? $action : (isset($uid) || !empty($pmid) ? 'view' : '');
$ppp=10;
$pmstatus = uc_pm_checknew($discuz_uid, 4);
	$systemnewpm = $pmstatus['newpm'] - $pmstatus['newprivatepm'];
	$filter =  'newpm';
	
	$ucdata = uc_pm_list($discuz_uid, $page, $ppp, !isset($search) ? 'inbox' : 'searchbox', !isset($search) ? $filter : $srchtxt, 200);
	if(!empty($search) && $srchtxt !== '') {
		$filter = '';
		$srchtxtinput = htmlspecialchars(stripslashes($srchtxt));
		$srchtxtenc = rawurlencode($srchtxt);
	} else {
		$multipage = multi($ucdata['count'], $ppp, $page, 'pm.php?filter='.$filter);
	}
	$_COOKIE['checkpm'] && setcookie('checkpm', '', -86400 * 365);

	$pmlist = array();
	$today = $timestamp - ($timestamp + $timeoffset * 3600) % 86400;
	foreach($ucdata['data'] as $pm) {
		$pm['msgfromurl'] = $pm['fromappid'] && $ucapp[$pm['fromappid']]['viewprourl'] ? sprintf($ucapp[$pm['fromappid']]['viewprourl'], $pm['msgfromid']) : 'space.php?uid='.$pm['msgfromid'];
		$pm['daterange'] = 5;
		if($pm['dateline'] >= $today) {
			$pm['daterange'] = 1;
		} elseif($pm['dateline'] >= $today - 86400) {
			$pm['daterange'] = 2;
		} elseif($pm['dateline'] >= $today - 172800) {
			$pm['daterange'] = 3;
		}
		$pm['date'] = gmdate($dateformat, $pm['dateline'] + $timeoffset * 3600);
		$pm['time'] = gmdate($timeformat, $pm['dateline'] + $timeoffset * 3600);
		
		//////
		if ($pm['msgfromid'] > 0){
				$from=to_utf8($pm['msgfrom']);$text=to_utf8($pm['subject']);$link= 'pm.php?uid='.$pm['touid'].'&filter=privatepm&daterange='.$pm['daterange'].'#new';
			}else{
				$from='';$text=to_utf8($pm['subject']);$link= 'pm.php?pmid='.$pm['pmid'].'&filter=systempm';
			}
			if($text)
			$pmlist[]= array('from'=>$from,'text'=>$text,'link'=>$link,'time'=>$pm['time']);
		/////
	}
			
	die(json_encode($pmlist));
?>