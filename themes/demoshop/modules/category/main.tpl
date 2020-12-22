<!-- BEGIN: main -->


<div class="col-xs-5 col-sm-5 col-md-5 ">
<div class="panel panel-default">
    <!-- BEGIN: cate -->
    <table class="table">
		<td>
            <h3> <i class="fa fa-book"></i> - <a href ="{CATE.url_product}">{CATE.name} </a>
            <!-- BEGIN: count --> ({COUNT.category_id}) <!-- END: count -->
            </h3>
           
    </table>
    <!-- END: cate -->

</div>
</div>


    <!-- BEGIN: loop -->
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
<div class="panel panel-default"  >
    <div class="thumbnail">
    	<div class="panel-body" style="height:50px" >
    		<h3 class="name">{ROW.product_name}</h3>
    	</div>
	</div>
	
	<div class="thumbnail">
		<div class="panel">
			<a href="{ROW.url_detail}" >
				<img src="{ROW.product_image}" style="border: 1px solid red; height:300px">
			</a>
		</div>
	</div>
		
	<div class="caption">
			<div class="panel-footer">
				<h3>{ROW.product_price} </h3>
			</p></div>
			<div class="text-center">
				
				<a href="" class="btn btn-danger" role="button" onclick="nv_add_to_cart({ROW.id}, 'add')"><i class="fa fa-shopping-cart"></i> Add to cart</a>
			</div>
	</div>
            
		
	
	</div>
		
</div>
    <!-- END: loop -->

    <!-- BEGIN: GENERATE_PAGE -->
    {GENERATE_PAGE} 
    <!-- END: GENERATE_PAGE -->

</div>
<!-- END: main -->