<!-- BEGIN: main -->
<div class="row">
	<div class="col-md-24">
		<div id="cp_widget_f084c050-4ced-461a-a3b7-e0a9ff73da17">...</div><script type="text/javascript"> var cpo = []; cpo["_object"] ="cp_widget_f084c050-4ced-461a-a3b7-e0a9ff73da17"; cpo["_fid"] = "AsCAVve1qj-V"; var _cpmp = _cpmp || []; _cpmp.push(cpo); (function() { var cp = document.createElement("script"); cp.type = "text/javascript"; cp.async = true; cp.src = "//www.cincopa.com/media-platform/runtime/libasync.js"; var c = document.getElementsByTagName("script")[0]; c.parentNode.insertBefore(cp, c); })(); </script>
	</div>
</div>
       <div class="container">
	<div class="row" >
		<div>
			<div class="col-xs-8 col-sm-8 col-md-11 text-center">		
				<img src="{ROWDETAIL.product_image}" alt="" class="avt" style="width:400px; height: 400px; ">
			</div>
			<div class="col-xs-8 col-sm-8 col-md-13 " >
					<h1>{ROWDETAIL.product_name}</h1>
				<br>

				<h2><p> Danh mục: {ROWCATE.category_name}</p></h2>
				<div class="container">
					<h2>
						<i class="fa fa-bolt "></i> Giá bán: {ROWDETAIL.product_price},000 VNĐ
						<p></p>
					</h2>
				</div>
				<p>
					<a href="#" class="btn btn-danger" onclick="nv_add_to_cart({ROWDETAIL.id}, 'add')"><i class="fa fa-shopping-cart"></i> Add to cart</a>
				</p>
                <br>
                <p>{ROWDETAIL.product_desc}</p>
				<p>
				<h2><p>Chính sách bảo hành</p></h2>
				<h3> <i class="fa fa-eercast"></i>  Bảo hành chính hãng 3 năm</h3>
				<h3> <i class="fa fa-eercast"></i>  Đổi mới trong 15 ngày đầu tiên</h3>
				<h3> <i class="fa fa-eercast"></i>  1 đổi 1 trong 1 tháng nếu có lỗi của nhà sản suất</h3>
			</div>
			
			</div>	
		</div>
    </div>
</div>

<script type="text/javascript">
function nv_add_to_cart(id, action) {
  $.ajax({
          url: nv_base_siteurl + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=cart',
          method: 'POST',
          dataType:"text",
          data: {id: id, action: action},
          success: function(data) {
              alert(data);
          }
        });
}
 
</script>
<!-- END: main -->

