<?php
function getpage($_var_0, $_var_1 = 10)
{
	$_var_2 = new Think\Page($_var_0, $_var_1);
	$_var_2->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
	$_var_2->setConfig('prev', '上一页');
	$_var_2->setConfig('next', '下一页');
	$_var_2->setConfig('last', '末页');
	$_var_2->setConfig('first', '首页');
	$_var_2->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
	$_var_2->lastSuffix = false;
	return $_var_2;
}

function mkdirs($_var_10, $_var_11 = '0777')
{
	if (!is_dir($_var_10)) {
		mkdirs(dirname($_var_10), $_var_11);
		mkdir($_var_10, $_var_11);
	}
	return true;
}
function getMovietypeList()
{
	$_var_12 = array('上下翻页', '上下惯性翻页', '左右翻页', '左右惯性翻页', '上下连续翻页', '左右连续翻页', '立体翻页', '卡片翻页', '放大翻页', '交换翻页', '翻书翻页', '掉落翻页');
	return $_var_12;
}
function getPageMode($_var_13)
{
	$_var_14 = getMovietypeList();
	return $_var_14[$_var_13];
}
function conf_read($_var_15, $_var_16 = true)
{
	$_var_15 = strpos($_var_15, 'php') !== false ? $_var_15 : $_var_15 . '.php';
	$_var_17 = WWW_ROOT . '/Application/Common/' . $_var_15;
	if (!file_exists($_var_17)) {
		return array();
	}
	return $_var_16 ? include $_var_17 : file_get_contents($_var_17);
}
function conf_write($_var_18, $_var_19, $_var_20 = 'array')
{
	$_var_18 = strpos($_var_18, 'php') !== false ? $_var_18 : $_var_18 . '.php';
	if (is_array($_var_19)) {
		$_var_20 = strtolower($_var_20);
		if ($_var_20 == 'array') {
			$_var_19 = '<?php
 return ' . var_export($_var_19, true) . ';
?>';
		} elseif ($_var_20 == 'constant') {
			$_var_21 = '';
			foreach ($_var_19 as $_var_22 => $_var_23) {
				$_var_21 .= 'define(\'' . strtoupper($_var_22) . '\',\'' . addslashes($_var_23) . '\');
';
			}
			$_var_19 = '<?php
' . $_var_21 . '
?>';
		}
	}
	$_var_24 = @file_put_contents(WWW_ROOT . '/Application/Common/' . $_var_18, $_var_19);
	@chmod(WWW_ROOT . '/Application/Common/' . $_var_18, 0777);
	return $_var_24;
}
function getBiztypeCateName($_var_25)
{
	return M('cate')->where('value=' . $_var_25)->getField('title');
}
function getBiztypeCateNameN($_var_26, $_var_27)
{
	$_var_28 = M('cate')->where('value=' . $_var_27 . " AND type='{$_var_26}'")->getField('title');
	return $_var_28;
}
function getUserRole($_var_29)
{
	$_var_30 = array('普通', 'VIP', '顶级VIP');
	return $_var_30[$_var_29];
}
function getUserType($_var_31)
{
	$_var_32 = array('普通用户', '企业用户', '高级用户', '服务商用户');
	return $_var_32[$_var_31 - 1];
}
function getCateName($_var_33)
{
	$_var_34 = array('tpType' => '图片', 'bgType' => '背景', 'musType' => '音乐', 'scene_type' => '场景');
	return $_var_34[$_var_33];
}
function getTpyeNameToId($_var_35)
{
	$_var_36 = array('tpType' => 1, 'bgType' => 0, 'musType' => 33, 'scene_type' => 2);
	return $_var_36[$_var_35];
}
function getTpyeNameById($_var_37)
{
	$_var_38 = array(0 => 'bgType', 1 => 'tpType', 33 => 'musType', 2 => 'scene_type');
	return $_var_38[$_var_37];
}
function getUserName($_var_39)
{
	$_var_40 = M('users')->where("userid_int='{$_var_39}'")->field('uname,email_varchar')->find();
	return $_var_40['uname'] ? $_var_40['uname'] : $_var_40['email_varchar'];
}
function getAllCate()
{
	$_var_41 = M('cate')->select();
	$_var_42 = array();
	foreach ($_var_41 as $_var_43 => $_var_44) {
	}
}
function getSceneType($_var_45 = 'scene_type', $_var_46)
{
	$_var_47 = M('cate')->where("value='{$_var_46}' AND type='{$_var_45}'")->getField('title');
	return $_var_47;
}
function getSceneTag($_var_48)
{
	$_var_49 = M('tag')->where('type_int=2 and tagid_int=' . $_var_48)->getField('name_varchar');
	return $_var_49;
}
function getTagName($_var_50, $_var_51)
{
	if ($_var_50 == 2) {
		return '';
	}
	$_var_52 = M('tag')->where("type_int={$_var_50} and tagid_int=" . $_var_51)->getField('name_varchar');
	return $_var_52;
}
function getAdWzi($_var_53)
{
	$_var_54 = array('首页', '尾页');
	return $_var_54[$_var_53];
}
function getOrderStatus($_var_55, $_var_56)
{
	$_var_57 = array('未付款', '已付款');
	$_var_58 = array('未确定', '已完成', '等待买家付款');
	return $_var_57[$_var_55] . '、' . $_var_58[$_var_56];
}