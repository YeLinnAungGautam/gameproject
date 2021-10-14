<!-- Footer -->
<?php if($activePage != "download") { ?>
<footer>
 
      <div class="red-footer-container container-fluid mar-topper">
        <div class="container contact-us-container">
          <div class="row">
            <div class="col-md-4 col-sm-5 col-xs-12 contact-us-box request-box">
              <div class="request-description">
                <i class="fas fa-info-circle"></i>
                <p>Have your find your game? If not, request us</p>
              </div>
              <div class="request_form">
                <form action="">
                  <div class="form-group">
                    <input type="text" class="form-control" id="game_request" name="game_request" placeholder="Enter game title">
                  </div>
                  <button type="submit" class="btn btn-default">Request</button>
                </form>
              </div>
            </div>
            <div class="col-md-4 col-sm-3 col-xs-12 contact-us-box phone-mail-box">
              <i class="fas fa-phone-alt"></i>
              <a href="tel:+959123456789">+959123456789</a>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 contact-us-box phone-mail-box">
              <i class="far fa-envelope"></i>
              <a href="mailto:info@gamehubmyanmar.com">info@gamehubmyanmar.com</a>
            </div>
            
          </div>
        </div>
      </div>

            <div class="container mar-topper">

              <div class="no-mar-bottom row"> 

                <!-- Blog Entries Column -->
                <div class="no-mar-bottom col-md-12">
                    <div class="footer-header">
                      <h3>
                        Keep in Touch with Gamehub Myanmar
                      </h3>
                    </div>
                    <div class="footer-des">
                      <p>Get new games, promotions and other stuffs</p>
                    </div>
                    <div class="subscribe_form mar-topper">
                      <form action="">
                        <div class="form-group">
                          <input type="email" class="form-control" id="news_subscribe" name="news_subscribe" placeholder="Enter your email">
                        </div>
                        <button type="submit" class="btn btn-default">Subscribe</button>
                      </form>
                    </div>
                    
                </div> 
              </div>
            </div>


    <div class="copyright container-fluid mar-topper">
      <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-3 col-xs-3 social-ft">
                  <div class="soical-links">
                      <a href="#"><i class="fab fa-facebook-f"></i></a>
                      <a href="#"><i class="fab fa-instagram"></i></a>
                      <a href="#"><i class="fab fa-twitter"></i></a>
                  </div>
                </div>
                <div class="col-md-6 col-sm-9 col-xs-9 text-right copy-ft">
                    <span style="line-height: 2;">Copyright &copy; <?php echo date("Y")?>. All Rights Reserved by <a href="index">Gamehub Myanmar</a>. </span>
                </div>

            </div>
          </div>
            <!-- /.row -->
      </div>   
    </div>
    <!-- /.container -->
</footer>
<?php } ?>

    <!-- Bootstrap Core JavaScript -->
    <script src="/gameproject/js/bootstrap.min.js"></script>

    <!-- Splide Js  -->
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>

    <script>

      $(document).ready(function() {

         var p_user_id = $("#p_user_id").val();

         if (p_user_id == 'donePay') {

          $("#pricebtn").replaceWith("<pre class='price'><button name='download' id='buynow' class='btn btn-info btn-lg'>Download</button></pre>");

         }
      });


       $("#buynow").on('click',function() {
          var userId = $("#user_id").val();
          var gameId = $("#game_id").val();
          var price  = $("#price").val();

          
          if(userId == '' || gameId == '' || price == '') {
            window.sessionStorage.setItem("gameId",gameId); 
            // location.href = "login.php?action=cfs";
            location.href = "/gameproject/login"
          }else{
            $("#paymentModal").modal({
              backdrop: 'static',
              keyboard: false
            })

            $(".panel-body #m_user_id").val(userId);
            $(".panel-body #m_game_id").val(gameId);
            $(".panel-body #m_price").val(price);


          }
       })

      $(document).ready(function(){
          $('#ptsearch').typeahead({
            source: function(query, result){
              $.ajax({
                url: "fetch.php",
                method: "POST",
                data: {query:query},
                dataType:"json",
                success:function(data){
                  result($.map(data, function(item){
                    return item;
                  }));
                }
              })
            } 
          });
        });


       $('#payform').submit(function(e) {

          e.preventDefault();
          $.ajax({
            type: "POST",
            url: "payment.php",
            data: $(this).serialize(),
            beforeSend: function() {
              $("#overlay").css({ 'display' : 'block'})
              console.log(document.getElementById("overlay"));
            },
            success: function(response)
            {
              $("#pricebtn").replaceWith("<pre class='price'>"+response+"</pre>");
            }
          }).done(function() {
            setTimeout(function(){
              $("#overlay").css({ 'display' : 'none'})
              $("#paymentModal").modal('hide');
            },500);

       });

       });

	    new Splide( '.splide', {
	        type  : 'fade',
	        rewind: true,   
	        autoplay: true,
        } ).mount();
   

        document.addEventListener("DOMContentLoaded", function () {
          slider_one();
          slider_two();
        //   global_carousel__ctrl();
        });

        function slider_one() {
          var one = new Splide("#one", {
                    type  : 'fade',
                  rewind: true,   
                  autoplay: true,
          }).mount();
        }

        function slider_two() {
          var two = new Splide("#two", {
            type     : 'loop',
            perPage : 4,
            breakpoints: {
            '991.98': {
              perPage: 3,
            },
            '577': {
              perPage: 1,
            }
          },
          // autoplay: true,
          focus    : 'center',
          }).mount();
        }
    </script>
</body>

</html>