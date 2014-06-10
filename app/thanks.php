<?php 
  include($_SERVER['DOCUMENT_ROOT']."/process_stripe.php");
?>
<!--[if lt IE 7]>
    <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
    <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
    <html class="no-js lt-ie9"> <![endif]-->
    <!--[if gt IE 8]><!-->

    <html class="no-js" xmlns="http://www.w3.org/1999/xhtml">
    <!--<![endif]-->

    <head>
      <meta name="generator" content=
      "HTML Tidy for Linux/x86 (vers 25 March 2009), see www.w3.org" />
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />

      <title></title>
      <meta name="description" content="" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
      <link href='http://fonts.googleapis.com/css?family=Open+Sans:800italic,400,800,600'
      rel='stylesheet' type='text/css' />
      <link rel="stylesheet" href="styles/main.css" type="text/css" />
      <link href="styles/wizard/wizard.css" rel="stylesheet" type="text/css" />
      <!-- build:js scripts/vendor/modernizr.js -->

      <script src="bower_components/modernizr/modernizr.js" type="text/javascript">
      </script><!-- endbuild -->
  </head>

  <body>
  <!--[if lt IE 7]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
    <![endif]-->

    <div class="container">
        <div class="col-md-4">
          <div id="logo"><img src="images/logo.png" alt="Logo" /></div>
      </div>

      <div class="col-md-8">
          <div id="as-seen-on">
            <p>AS SEEN ON:</p>

            <ul>
              <li>
                  <img src="images/as-seen-on-logos/curlynikki.png" alt=
                  "Curly Nikki Logo" />
              </li>

              <li>
                  <img src="images/as-seen-on-logos/daily-motion.png" alt=
                  "Daily Motion Logo" />
              </li>

              <li>
                  <img src="images/as-seen-on-logos/blackhairplanet-logo.png" alt=
                  "Black Hair Planet Logo" />
              </li>

              <li>
                  <img src="images/as-seen-on-logos/womens-hair-loss-project-logo.png" alt=
                  "Womens Hair Loss Project" />
              </li>
          </ul>
      </div>
  </div>
</div>

<div class="container">
    <div class="col-md-12">
      <div class="title" style="text-align:left;">
      <h1>Thanks For Your Order!</h1>
      </div>
      <hr>
  </div>
  <div class="col-md-12">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="invoice-title">
                    <h2>Invoice</h2><h3 class="pull-right">Order # <?php echo $order_id; ?></h3>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-6">
                        <address>
                        <strong>Billed To:</strong><br>
                            <?php echo $first_name . " " . $last_name; ?><br>
                            <?php echo $billing_address; ?><br>
                            <?php echo $billing_city; ?>, <?php echo $billing_state; ?> <?php echo $billing_zip; ?>
                        </address>
                    </div>
                    <div class="col-xs-6 text-right">
                        <address>
                        <strong>Shipped To:</strong><br>
                            <?php echo $first_name . " " . $last_name; ?><br>
                            <?php echo $shipping_address; ?><br>
                            <?php echo $shipping_city; ?>, <?php echo $shipping_state; ?> <?php echo $shipping_zip; ?>
                        </address>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <address>
                            <strong>Payment Method:</strong><br>
                            <?php echo $card_type; ?> ending <?php echo $card_number; ?><br>
                            <?php echo $email; ?>
                        </address>
                    </div>
                    <div class="col-xs-6 text-right">
                        <address>
                            <strong>Order Date:</strong><br>
                            <?php echo date("F j, Y"); ?><br><br>
                        </address>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Order summary</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <td><strong>Item</strong></td>
                                        <td class="text-center"><strong>Price</strong></td>
                                        <td class="text-center"><strong>Quantity</strong></td>
                                        <td class="text-right"><strong>Totals</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                    <tr>
                                        <td>Grow Fabulous Hair 60-Da Supply</td>
                                        <td class="text-center">$79.99</td>
                                        <td class="text-center">1</td>
                                        <td class="text-right">$79.99</td>
                                    </tr>
                                    <tr>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                        <td class="thick-line text-right">$79.99</td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-center"><strong>Shipping</strong></td>
                                        <td class="no-line text-right">$15</td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-center"><strong>Total</strong></td>
                                        <td class="no-line text-right">$94.99</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>





<hr>
<div class="container">
    <div class="row">
      <p class="left">copyright Mira Herbals, LLC</p>

      <div class="right"><img src="images/twitter.png" /> <img src=
          "images/pinterest.png" /> <img src="images/facebook.png" /></div>
      </div>
  </div><script type="text/javascript">
//<![CDATA[
(function (b, o, i, l, e, r) {
    b.GoogleAnalyticsObject = l;
    b[l] || (b[l] =
        function () {
            (b[l].q = b[l].q || []).push(arguments)
        });
    b[l].l = +new Date;
    e = o.createElement(i);
    r = o.getElementsByTagName(i)[0];
    e.src = '//www.google-analytics.com/analytics.js';
    r.parentNode.insertBefore(e, r)
}(window, document, 'script', 'ga'));
ga('create', 'UA-XXXXX-X');
ga('send', 'pageview');
  //]]>
</script><!-- build:js scripts/main.js -->
<script src="bower_components/jquery/jquery.js" type="text/javascript">
</script><script src="bower_components/video.js/video.dev.js" type="text/javascript">
</script><script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js">
</script><script src="bower_components/videojs-vimeo/vjs.vimeo.js" type=
"text/javascript">
</script><script src="bower_components/d3/d3.js" type="text/javascript">
</script><script src="bower_components/c3/c3.js" type="text/javascript">
</script><script src="bower_components/jquery.inview/jquery.inview.js" type=
"text/javascript">
</script><script src="bower_components/spinjs/spin.js" type="text/javascript">
</script><script src="bower_components/move.js/move.js" type="text/javascript">
</script><script src="scripts/wizard.js" type="text/javascript">
</script><script src="scripts/main.js" type="text/javascript">
</script><!-- endbuild -->
<!-- build:js scripts/vendor/bootstrap.js -->
<script src="bower_components/bootstrap/js/affix.js" type="text/javascript">
</script><script src="bower_components/bootstrap/js/alert.js" type="text/javascript">
</script><script src="bower_components/bootstrap/js/dropdown.js" type="text/javascript">
</script><script src="bower_components/bootstrap/js/tooltip.js" type="text/javascript">
</script><script src="bower_components/bootstrap/js/modal.js" type="text/javascript">
</script><script src="bower_components/bootstrap/js/transition.js" type=
"text/javascript">
</script><script src="bower_components/bootstrap/js/button.js" type="text/javascript">
</script><script src="bower_components/bootstrap/js/popover.js" type="text/javascript">
</script><script src="bower_components/bootstrap/js/carousel.js" type="text/javascript">
</script><script src="bower_components/bootstrap/js/scrollspy.js" type="text/javascript">
</script><script src="bower_components/bootstrap/js/collapse.js" type="text/javascript">
</script><script src="bower_components/bootstrap/js/tab.js" type="text/javascript">
</script><!-- endbuild -->
<script type="text/javascript">
//<![CDATA[
(function($) {

})(jQuery);
  //]]>
</script>
</body>
</html>













