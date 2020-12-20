<!-- BEGIN: main -->

<div class="row">
        <!-- BEGIN: loop -->
            <div class="col-3">
            <a href="main.tpl.html" id="id">
            <img src="{ROW.product_image}" width="200px" height="200px"/>
            <h4>{ROW.product_name}</h4>
            <p>{ROW.product_price}</p>
            </a>
            </div>
        <!-- END: loop -->
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

