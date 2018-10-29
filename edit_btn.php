<?php

// 将装修页中的 sld_tpl_edit_btns 反序列化 为数组 输出到 edit_btn.log


$edit_btn_data = file_get_contents('./edit_btn_input.log');

$decode_data = unserialize($edit_btn_data);
// function array_to_str($data){
// 	$return = '';
// 	if(is_array($data)){
// 		$return = 'array(';
// 		foreach ($data as $k => $v) {
// 			$item_value = array_to_str($v);
// 			$return .= '"'.$k.'"=>'.$item_value.',';
// 		}
// 		$return .= ')';
// 	}else{
// 		if (is_numeric($data)) {
// 			$return = $data;
// 		}else{
// 			$return = '"'.$data.'"';
// 		}
// 	}

// 	return $return;
// }

// $array_str = array_to_str($decode_data);

// $last_array_str = "<?php \$edit_btn_arr = ".$array_str.';';
// $last_array_str = $array_str.';';

$last_array_str = json_encode($decode_data);

file_put_contents('./edit_btn.log', $last_array_str);

echo 'OK';
