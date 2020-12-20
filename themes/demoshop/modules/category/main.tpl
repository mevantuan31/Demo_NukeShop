<!-- BEGIN: main -->

<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <tbody>
          <div class="small-container single-product">
            <div class="col-2">
              <img src="{ROW.product_image}" alt="image" id="product_image"  />
            </div>
            <div class="col-2">
              <p>{ROW.category_name}</p>
              <h1 id="itemTitle">{ROW.product_name}</h1>
              <h4 id="itemPrice">{ROW.product_price}</h4>
              <input type="number" value="1" />
              <a href="cart.html" class="btn">Add to cart</a>
              <h1>Thông tin chi tiết sản phẩm</h1>
              <h3>{ROW.product_desc}</h3>
              <br />
              <p id="description"></p>
            </div>
          </div>
        </tbody>
    </table>
    <!-- BEGIN: GENERATE_PAGE -->
    {GENERATE_PAGE} 
    <!-- END: GENERATE_PAGE -->
<script src="index.js"></script>
      <script src="products.js"></script>
      <script type="text/javascript">
        $(window).on('scroll', function() {
          if ($(window).scrollTop()) {
            $('nav').addClass('black');
          } else {
            $('nav').removeClass('black');
          }
        });
      </script>

</div>
<!-- END: main -->