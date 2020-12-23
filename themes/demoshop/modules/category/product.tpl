<!-- BEGIN: main -->

<div class="col-xs-5 col-sm-5 col-md-5 ">
<div class="panel panel-default">
	<div class="panel-heading text-center"><h1> <i class="fa fa-briefcase"></i> -Danh muc</h1></div>
    <!-- BEGIN: cate -->
    <table class="table">
		<td><h3> <i class="fa fa-book"></i> - <a href ="{CATE.url_product}" >{CATE.category_name}</a></h3></td>
    </table>
    <!-- END: cate -->

</div>
</div>

<div class="col-xs-19 col-sm-19 col-md-19">
<!-- BEGIN: product -->
<div class="col-xs-12 col-sm-12 col-md-12 text-center">
<div class="panel panel-default"  >
<div class="thumbnail">
	<div class="panel" style="height:50px" >
    		<h3 class="name">{ROW.product_name}</h3>
	</div>
	</div>
	
	<div class="thumbnail">
		<div class="panel">
			<a href="{PRODUCT.url_detail}" >
				<img src="{ROW.product_image}" style="border: 1px solid red; height:300px">
			</a>
		</div>
	</div>
		
	<div class="caption">
			<div class="panel-footer">
				<h3>{ROW.product_price} </h3>
			</p></div>
			<div class="text-center">
				<a href="" class="btn btn-danger" role="button" onclick="nv_add_to_cart({PRODUCT.id}, 'add')"><i class="fa fa-shopping-cart"></i> Add to cart</a>
			</div>
			</div>
		
	
	</div>
		
</div>
	
<!-- END: product -->	
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
 