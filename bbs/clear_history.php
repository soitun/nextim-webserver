<?php
include_once('common.php');
$uid = $space['uid'];
$ids = ids_array(gp("ids"));
if(!empty($ids)){
        for($i=0;$i<count($ids);$i++){
                $id = $ids[$i];
                //$_SGLOBAL['db']->query("DELETE FROM ".im_tname('histories')." WHERE `uid`='$uid' and (`to`='$id' or `to`='$uid' ) and (`from`='$uid' or `from`='$id')");
				$_SGLOBAL['db']->query("update ".im_tname('histories')." set fromdel=1 where `from`='$uid' and `to`='$id'");
				$_SGLOBAL['db']->query("update ".im_tname('histories')." set todel=1 where `to`='$uid' and `from`='$id'");
	
				$_SGLOBAL['db']->query("delete from ".im_tname('histories')." where fromdel=1 and todel=1");
				$_SGLOBAL['db']->query("OPTIMIZE TABLE ".im_tname('histories'), 'SILENT');
        }
}
echo '{success:true}';
?>
