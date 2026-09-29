<?php
include "../db.php";
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?=$url;?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Trang Chủ</a>
	<a href="#" class="current">Danh sách tài khoản nhận code</a> </div>
  </div>

  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
       <div class="widget-box">
	<div class="widget-title"> 
		<span class="icon"><i class="icon-th"></i></span>
		<h5>Danh sách tài khoản nhận code</h5> 
	</div>
	<div class="widget-content nopadding">
		<div class="dataTables_wrapper">
			<div class="dataTables_length">
				<label>Hiển thị 
					<select style="width:60px;" id="line">
						<option value="10" selected="selected">10</option>
						<option value="25">25</option>
						<option value="50">50</option>
						<option value="100">100</option>
					</select>
					dòng
				</label>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered data-table dataTable">
					<thead>
						<tr>
							<input type="hidden" id="type" name="type">
							<th>ID</th>
							<th>Tài khoản</th>
							<th><a href="#" onclick="arrangeOrder('actorid');">Actorid</a></th>
							<th>Code</th>
							<th>Server</th>
							<th>Thời gian nhận</th>
						</tr>
					</thead>
					<tbody id="loadUsers"></tbody>
				</table>
				<div id="loading" style="display: none; text-align: center; padding: 0 20px;">Đang tải dữ liệu, vui lòng chờ <img src="img/loading.gif"/></div>
				<div class="fg-toolbar ui-toolbar ui-widget-header ui-corner-bl ui-corner-br ui-helper-clearfix">
					<div class="dataTables_filter">
						<label>Search: <input type="text" id="searchs" name="search"></label>
					</div>
					<div class="dataTables_paginate fg-buttonset ui-buttonset fg-buttonset-multi ui-buttonset-multi paging_full_numbers">
						<ul class="pagination" id="pagination"></ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	var isClick = false;
	function arrangeOrder(type) {
		if(isClick == false) {
			isClick = true;
			$("#type").val(type + "_0");
			loadUsers(1, type + "_0");
		} else {
			isClick = false;
		
			$("#type").val(type + "_1");
			loadUsers(1, type + "_1");
		}
	}
	$("#searchs").keyup(function(e){
		loadUsers(1, "");
		if (e.which == 13) {
			loadUsers(1, "");
		}
	});
	$("#line").change(function() {
		loadUsers(1, "");
	});
	loadUsers(1, "");
	function loadUsers(page, type) {
		var search = $("#searchs").val();
		var line = $("#line").val();
		$("#loading").show();
		$.post("<?=$url;?>ajax/ajax_logcode.php", "search="+search+"&page="+page+"&line="+line+"&type="+type,
		function(result) {
			setTimeout(function() {
				var items = result['items'];
				var index = 0;
				if(items.length > 0) {
					var itemResult = "";
					items.forEach(function(entry) {
						itemResult += entry;
					});
					totalpage = result['totalpage'];
					totalitem = result['totalitem'];
					$('#loadUsers').html(itemResult);
					loadPage(totalpage, totalitem, page);
					$("#loading").hide();
				} else {
					$('#loadUsers').html("");	
					$('#loading').html("Không tìm thấy dữ liệu.");
				}
			}, 500);
		}, 'json');
	}
	function loadPage(totalpage, totalitem, page) {
		$('#pagination').pagination({
			items: totalpage,
			itemOnPage: totalitem,
			currentPage: page,
			cssStyle: '',
			prevText: '<span aria-hidden="true">&laquo;</span>',
			nextText: '<span aria-hidden="true">&raquo;</span>',
			onInit: function () {
				// fire first page loading
			},
			onPageClick: function (page, evt) {
				// some code
				var type = $("#type").val();
				loadUsers(page, type);
			}
		});
	}
</script>