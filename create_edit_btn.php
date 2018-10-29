<?php

// 创建一组 装修按钮数据

$edit_btn_arr = array(
	"uid" => array(
		'default_val' => "{TEMPLATE_ID}",
		'spec' => "模板ID(后台自动生成)",
		'is_editable' => false,
		'is_require' => true,
	),
	"cat_id" => array(
		'spec' => "编辑器的`cat_id`（与`type` 组合 确定使用什么编辑器）",
		'is_editable' => true,
		'is_require' => true,
	),
	"type" => array(
		'spec' => "编辑器的`type`（与`cat_id` 组合 确定使用什么编辑器）",
		'is_editable' => true,
		'is_require' => true,
	),
	"length" => array(
		'spec' => "长度（文字长度）",
		'is_editable' => true,
		'is_require' => false,
	),
	"number" => array(
		'spec' => "个数（商品个数或其他个数）",
		'is_editable' => true,
		'is_require' => false,
	),
	"has_link" => array(
		'spec' => "是否展示链接编辑功能",
		'is_editable' => true,
		'is_require' => false,
	),
	"has_title" => array(
		'spec' => "是否展示标题编辑功能（一般用户商品编辑器）",
		'is_editable' => true,
		'is_require' => false,
	),
	"has_top_tips" => array(
		'spec' => "是否展示编辑器顶部标示（1,0）",
		'is_editable' => true,
		'is_require' => false,
	),
	"pic_w" => array(
		'spec' => "图片宽度",
		'is_editable' => true,
		'is_require' => false,
	),
	"pic_h" => array(
		'spec' => "图片高度",
		'is_editable' => true,
		'is_require' => false,
	),
	// "width" => array(
	// 	'spec' => "宽",
	// 	'is_editable' => true,
	// 	'is_require' => false,
	// ),
	"level_deep" => array(
		'spec' => "分类递归深度(分类编辑器使用)",
		'is_editable' => true,
		'is_require' => false,
	),
	"has_sub_title" => array(
		'spec' => "是否展示子标题(1,0)",
		'is_editable' => true,
		'is_require' => false,
	),
	"sub_title_field_name" => array(
		'spec' => "子标题编辑器展示名称",
		'is_editable' => true,
		'is_require' => false,
	),
	"sub_length" => array(
		'spec' => "子标题长度",
		'is_editable' => true,
		'is_require' => false,
	),
	"has_bg_color" => array(
		'spec' => "是否展示背景颜色(1,0)",
		'is_editable' => true,
		'is_require' => false,
	),
	"bg_color_field_name" => array(
		'spec' => "背景颜色编辑器展示名称",
		'is_editable' => true,
		'is_require' => false,
	),
	"has_font_color" => array(
		'spec' => "是否展示字体颜色(1,0)",
		'is_editable' => true,
		'is_require' => false,
	),
	"font_color_field_name" => array(
		'spec' => "字体颜色编辑器展示名称",
		'is_editable' => true,
		'is_require' => false,
	),
	"has_item_title" => array(
		'spec' => '是否有图片标题(1,0)',
		'is_editable' => true,
		'is_require' => false,
	),
	"has_item_sub_title" => array(
		'spec' => '是否有图片子标题(1,0)',
		'is_editable' => true,
		'is_require' => false,
	),
	"shop_id" => array(
		'default_val' => "{SHOP_ID}",
		'spec' => "商户ID(后台自动生成)",
		'is_editable' => false,
		'is_require' => true,
	),
	"city_id" => array(
		'default_val' => "{CITY_ID}",
		'spec' => "城市ID(后台自动生成)",
		'is_editable' => false,
		'is_require' => true,
	),
	"data_name" => array(
		'spec' => "模板ID(后台自动生成)",
		'is_editable' => true,
		'is_require' => true,
	)
);

$encode_data = '';
$decode_data = array();

// 处理提交数据
if ($_POST) {
	$template_edit = $_POST['template_edit'];
	$item_attr_key = $_POST['item_attr_key'];
	$item_attr_value = $_POST['item_attr_value'];

	$need_data = array();

	foreach ($template_edit as $key => $value) {
		if (!empty($value)) {
			$need_data[$value] = $item_attr_data = array();

			$now_item_attr_key = ( isset($item_attr_key[$key]) && !empty($item_attr_key[$key]) ) ? $item_attr_key[$key] : array();
			$now_item_attr_value = ( isset($item_attr_value[$key]) && !empty($item_attr_value[$key]) ) ? $item_attr_value[$key] : array();
			if (!empty($now_item_attr_key)) {
				foreach ($now_item_attr_key as $attr_key => $attr_value) {
					if ($attr_value == 'on') {
						$item_attr_data[$attr_key] = $now_item_attr_value[$attr_key] ? $now_item_attr_value[$attr_key] : '';
					}
				}
			}

			if (!empty($item_attr_data)) {
				$need_data[$value] = $item_attr_data;
			}
		}
	}

	$encode_data = serialize($need_data);
	$decode_data = $need_data;

	file_put_contents('./edit_btn_input.log', $encode_data);
	
	echo OK;
}

if (empty($decode_data)) {
	$edit_btn_data = file_get_contents('./edit_btn_input.log');

	$decode_data = unserialize($edit_btn_data);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<style type="text/css">
	p{
		padding: 0;
		margin: 0;
	}
	.edit-btn-item{
		width: 22%;
		display: inline-block;
		border:1px solid #000000;
		padding: 0 10px 10px 10px;
		margin: 5px;
	}
	.edit-btn-item p{
		padding: 5px 0;
	}
	.edit-btn-item p input{
		width: 90%;
	}
	.edit-btn-item .item-edit-btn-input-v{
		width: 90%;
	}
	.default-demo{
		display: none;
	}
</style>
<body>
	<div style="border: 1px solid #000000;padding: 10px;margin: 10px 0;">
		<h2>字段描述</h2>
		<table style="width: 100%;" border="1">
			<thead>
				<tr>
					<th style="width: 20%;">字段code</th>
					<th style="width: 10%">默认值</th>
					<th style="width: 40%">描述</th>
					<th style="width: 30%">特别说明</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($edit_btn_arr as $key => $value): ?>
				<tr>
					<td><?php echo $key; ?></td>
					<td><?php echo isset($value['default_val']) ? $value['default_val'] : '无' ; ?></td>
					<td><?php echo $value['spec']; ?></td>
					<td></td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
	<div>
		<div style="border: 1px solid #000000;padding: 5px;margin-bottom: 10px;">
			<button class="item-plus-btn">添加一个按钮数据</button>
			<button class="item-save-btn">保存</button>
		</div>
		<div class="default-demo">
			<div class="edit-btn-item">
				<div style="text-align: right;">
					<button class="item-delete-btn">删除</button>
				</div>
				<p><input type="text" name="template_edit" value="" placeholder="按钮标示，例：TEMPLATE_EDIT,TEMPLATE_EDIT_1" /></p>
				<table style="width: 100%;" border="1px">
					<?php foreach ($edit_btn_arr as $key => $value): ?>
					<tr>
						<td>
							<?php $item_check_h = $value['is_require'] ? 'checked onclick="return false;"' : ''; ?>
							<input type="checkbox" <?php echo $item_check_h; ?> name="item_attr_key" />
						</td>
						<td class="item-key"><?php echo $key; ?></td>
						<td>
							<?php $disabled_h = isset($value['default_val']) ? 'readonly' : '' ; ?>
							<input type="text" class="item-edit-btn-input-v" <?php echo $disabled_h; ?> name="item_attr_value" value="<?php echo isset($value['default_val']) ? $value['default_val'] : ''; ?>" />
						</td>
					</tr>
					<?php endforeach ?>
				</table>
			</div>
		</div>

		<form id="edit_btn_form" method="POST">
		<div class="form-content">
			<?php foreach ($decode_data as $d_key => $d_value): ?>
			<div class="edit-btn-item">
				<div style="text-align: right;">
					<button class="item-delete-btn">删除</button>
				</div>
				<p><input type="text" name="template_edit" value="<?php echo $d_key; ?>" placeholder="按钮标示，例：TEMPLATE_EDIT,TEMPLATE_EDIT_1" /></p>
				<table style="width: 100%;" border="1px">
					<?php foreach ($edit_btn_arr as $key => $value): ?>
					<tr>
						<td>
							<?php 
								if (isset($value['is_require']) && $value['is_require']) {
									$item_check_h = 'checked onclick="return false;"';
								}else{
									$item_check_h = (isset($d_value[$key]) && $d_value[$key]) ? 'checked' : '';
								}
							 ?>
							<input type="checkbox" <?php echo $item_check_h; ?> name="item_attr_key" />
						</td>
						<td class="item-key"><?php echo $key; ?></td>
						<td>
							<?php $disabled_h = isset($value['default_val']) ? 'readonly' : '' ; ?>
							<?php 
								if (isset($value['default_val'])) {
									$item_value = $value['default_val'];
								}else{
									$item_value = (isset($d_value[$key]) && $d_value[$key]) ? $d_value[$key] : '';
								}
							 ?>
							<input type="text" class="item-edit-btn-input-v" <?php echo $disabled_h; ?> name="item_attr_value" value="<?php echo $item_value; ?>" />
						</td>
					</tr>
					<?php endforeach ?>
				</table>
			</div>
			<?php endforeach ?>
		</div>
		<form>

	</div>
</body>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">
	<!-- 新增一组按钮数据录入 -->
	$(".item-plus-btn").click(function(e){
		var item_html = $(".default-demo").html();
		$(".form-content").append(item_html);
	});
	// 删除当前按钮输入区域
	$(".form-content").on("click",".item-delete-btn",function(e){
		$(this).parents(".edit-btn-item").remove();
	});
	// 保存数据
	$(".item-save-btn").click(function(e){
		$(".form-content").find(".edit-btn-item").each(function(k,item){
			var tr_obj = $(item).find("tr");
			$(item).find("input[name='template_edit']").attr('name','template_edit['+k+']');
			tr_obj.each(function(tr_k,tr_item){
				var item_key = $(tr_item).find(".item-key").text();
				$(tr_item).find("input[name='item_attr_key']").attr('name','item_attr_key['+k+']['+item_key+']');
				$(tr_item).find("input[name='item_attr_value']").attr('name','item_attr_value['+k+']['+item_key+']');
			});
		});

		$("#edit_btn_form").submit();
	});
</script>
</html>