<!-- Footer -->
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
                <?php if(isset($_SESSION['user_id'])) { ?>

                <form action="">
                  <div class="form-group">  
                    <input type="text" class="form-control" id="game_request" name="game_request" placeholder="Enter game title">
                  </div>
                  <button type="submit" class="btn btn-default">Request</button>
                </form>
                
                <?php } ?>
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
                      <p>Get new games notifications</p>
                    </div>
                    <div class="subscribe_form mar-topper">
                      <form action="subscribe.php">
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
                <div class="col-md-6 col-sm-5 col-xs-12 social-ft">
                  <div class="soical-links">
                      <a href="https://www.facebook.com/Gamehub-Myanmar-107734438341861"><i class="fab fa-facebook-f"></i> Follow Us on Facebook</a>
                     
                  </div>
                </div>
                <div class="col-md-6 col-sm-7 col-xs-12 text-right copy-ft">
                    <span style="line-height: 2;">Copyright &copy; <?php echo date("Y")?>. All Rights Reserved by <a href="index">Gamehub Myanmar</a>. </span>
                </div>

            </div>
          </div>
            <!-- /.row -->
      </div>   
    </div>
    <!-- /.container -->
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo $baseurl ?>/js/bootstrap.min.js"></script>
 
    <!-- Splide Js  -->
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>

    <script>

      var CLIENT_ID = '454988175560-0k6rof7thb937jjt8lg78jg99utrfp3r.apps.googleusercontent.com';
      var API_KEY = 'AIzaSyD6cYuYJ3laD-Cih6Ng74YCbBgnD0DxgPE';
      var DISCOVERY_DOCS = ["https://www.googleapis.com/discovery/v1/apis/drive/v3/rest"];
      var SCOPES = 'https://www.googleapis.com/auth/drive.metadata.readonly';
      var base_url = $('#base-url').val();
      
    //   <script>
    //     $(document).ready(function() {
    //       $("#popupsearch").click(function(e) {
    //           e.preventDefault();
    //           $(".togglesearch").toggle();
    //           $(".searchTerm").focus();
    //         });

    //         $("#popupuser").click(function(e) {
    //           e.preventDefault();
    //           $(".toggleuser").toggle();
    //         });

    //     });
    //

      $(document).ready(function() {



         var p_user_id = $("#p_user_id").val();
         $("#popupsearch").click(function(e) {
              e.preventDefault();
              $(".togglesearch").toggle();
              $(".searchTerm").focus();
            });

            $("#popupuser").click(function(e) {
              e.preventDefault();
              $(".toggleuser").toggle();
            });  
  //modal
            const modal = $(".modal");
            const modalToggle = $(".modal-toggle");
            const modalWrapper = $(".modal-wrapper");
            const modalHeight = modalWrapper.height();

            //countdown
            function coundDown() {
              console.log("countdown");
              var countdownNumberEl = document.getElementById("countdown-number");
              var countdown = 5;
              countdownNumberEl.textContent = countdown;
              var downloadTimer = setInterval(function() {
                countdown--; // 5 to 0
                countdownNumberEl.textContent = countdown;

                if (countdown > 0) {
                  modalToggle.unbind("click", showMConfirmModal);
                } else {
                  modalToggle.bind("click", showMConfirmModal);
                  clearInterval(downloadTimer);
                  modal.removeClass("is-visible");
                }
              }, 1000);
            }


            //show modal
            function showMConfirmModal(e) {
              console.log('icon click');
              const modalPosY = $(document).outerHeight() / 2 - modalHeight/2;
              modalWrapper.css("margin-top", modalPosY)
              //fire countedown modal
              if ($("#count-loading").length) {
                e.preventDefault();
                modal.addClass('is-visible');
                coundDown();
              }else{
                //fire confirm modal
                e.preventDefault();
                modal.toggleClass('is-visible');
              }
            }

            modalToggle.click(showMConfirmModal);

              $(".btn-cancel").click(function(e) {
                modal.removeClass("is-visible");
              });
      });


       $("#buynow").on('click',function() {
          var userId = $("#user_id").val();
          var gameId = $("#game_id").val();
          var id = $("#game-id").val();
          var price  = $("#price").val();
          var count = $('#d_count').val();
          if(userId == '' || gameId == '') {
            window.sessionStorage.setItem("gameId",gameId); 
            // location.href = "login.php?action=cfs";
            location.href = base_url+"/login"
          }else{
            // $("#paymentModal").modal({
            //   backdrop: 'static',
            //   keyboard: false
            // })
            if(count < 20) {
            $.ajax({
            type: "POST",
            url: base_url+"/payment.php",
            data: {user_id: userId, game_id: id},
            beforeSend: function() {
              $("#overlay").css({ 'display' : 'block'})
            },
            success: function(response)
            {
              gapi.load('client', start);
              $("#overlay").css({ 'display' : 'none'})
            },
            }).done(function() {
              console.log('done');
            })
            }else{
              alert("Downloads time exceed");
            }
          }
       })

      $(document).ready(function(){
          $('#ptsearch').typeahead({
            source: function(query, result){
              $.ajax({
                url: base_url+"/fetch.php",
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

       function getIdFromUrl(url) { return url.match(/[-\w]{25,}/); }

       function start() {

        var download_url = $("#download-url").val();
        var fileId = getIdFromUrl(download_url)[0]
          var download_url = "https://www.googleapis.com/drive/v3/files/"+fileId+"?alt=media&key="+API_KEY
          // window.open(download_url,"_self");
        gapi.client.init({
            apiKey: API_KEY,
            clientId: CLIENT_ID,
            discoveryDocs: DISCOVERY_DOCS,
            scope: SCOPES
                  
        }).then(function() {
            gapi.client.drive.files.get({
            supportsAllDrives: true,
            fileId: fileId,
            fields:  'webContentLink'   
            }).then(function (resp) {
                if(resp.result.webContentLink) {
                    window.location.assign(resp.result.webContentLink);
                } else {
                    var formatted = JSON.stringify(resp.data.result, null, 2);
                    console.log(formatted);
                }
            })
        })
        };
        // 1. Load the JavaScript client library.
        
    </script>
    <script>
    var timeleft = 10;
    var downloadTimer = setInterval(function(){
      if(timeleft <= 0){
        clearInterval(downloadTimer);
      }
      document.getElementById("progressBar").value = 10 - timeleft;
      timeleft -= 1;
    }, 1000); 
</script>
<script>
$(document).ready(function(){
  window.onload=function(){
    $('#preloader').fadeOut(3000, function(){
            $(this).remove();
        });
  }
        
        });
</script>
<script>
$(document).ready(function(){
    $(".show-modal").click(function(){
        $("#myModal").modal({
            backdrop: 'static',
            keyboard: false
        });
    });
 setTimeout(function() {$('#myModal').modal('hide');}, 11000);
});
</script>
<script>
  $(document).ready(function() {
  setTimeout(function() {
    $("#ad_close_custom").show();
  }, 8000);
});
</script>
</body>
</html>
