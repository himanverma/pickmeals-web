<footer>
    <div class="footer_box">
        <div class="container">
            <div class="footer_top_box">
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <ul class="footer_menu1">
                        <h1>Info</h1>
                        <li><a href="/about-us">About Us</a></li>
                        <li><a href="/faq">FAQ'S</a></li>
                        <li><a href="/privacy-policy">Privacy Policy</a></li>
                        <li><a href="/terms-and-conditions">Terms and Conditions</a></li>
                    </ul>
                </div>
                <div class="col-sm-2 col-md-3 col-lg-3">
                    <ul class="footer_menu1">
                        <h1>Follow us</h1>
                        <li><a target="_new" href="https://twitter.com/pickmeals"> Twitter</a></li>
                        <li><a target="_new" href="https://www.facebook.com/pickmeals"> Facebook</a></li>
                        <li><a target="_new" href="http://instagram.com/pickmeals/"> Instagram</a></li>
                    </ul>
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <ul class="footer_menu1">
                        <h1>Help</h1>
                        <li><a href="/contact-us">Contact Us</a></li>
                        <li><a href="/feedback">Feedback</a></li>
                    </ul>
                </div>
                <div class="col-sm-4 col-md-3 col-lg-3">
                    <iframe width="300" height="150" src="//www.youtube.com/embed/GeRmsNPVHts" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <!--footer top end--> 

    </div>
    <div class="container">
        <div class="col-sm-12">
            <address class="footer_copyright">
                <!--                <h6>Policies: Terms of use | Security | Privacy | Infringement</h6>-->
                <p>By continuing past this page, you agree to our <a href="/terms-and-conditions">Terms and Conditions</a>. All trademarks are properties of their respective owners. © 2015 - Pickmeals™ Pvt Ltd. All rights reserved.</p>
            </address>
        </div>
    </div>
</footer>
<?php if(Configure::read('Global.shop_online') == "off"){ ?>
<div class="modal fade" data-backdrop="static" id="shop_online">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
<!--        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
        <h4 class="modal-title">We are closed now :(</h4>
      </div>
      <div class="modal-body">
        <p>Placed order between 11am to 4pm and 7pm to 11:30pm.</p>
      </div>
      <div class="modal-footer">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
    $(function(){
        $('#shop_online').modal('show');
    });
</script>
<?php } ?>