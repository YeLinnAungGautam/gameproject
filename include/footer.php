<!-- Footer -->
<footer>
 
      <div class="red-footer-container container-fluid mar-topper">
        <div class="container contact-us-container">
          <div class="row">
            <div class="col-md-4 col-sm-5 col-xs-12 contact-us-box request-box">
              <div class="request-description">
                <i class="fas fa-info-circle"></i>
                <h5>Have your find your game? If not, request us</h5>
              </div>
              <div class="request_form">
                <?php if(isset($_SESSION['user_id'])) { ?>

                <!-- <form action="">
                  <div class="form-group">  
                    <input type="text" class="form-control" id="game_request" name="game_request" placeholder="Enter game title">
                  </div>
                  <button type="submit" class="btn btn-default">Request</button>
                </form> -->
                
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
                      <p id="sub-alert-success" style="display:none;color:green;">Thank you for your subscription.</p>
                      <p id="sub-alert-fail" style="display:none;color:yellow;">You have already subscribed.</p>
                    </div>

                    <div class="subscribe_form mar-topper">
                      <form id="sub-form" action="">
                        <input type="email" class="form-control" id="sub_email" required name="news_subscribe" placeholder="Enter your email">
                        <input type="submit" id="sub-btn" class="btn btn-default" value="Subscribe">
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

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo $baseurl;?>/js/bootstrap.min.js"></script>

    <!-- Splide Js  -->
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>

    <script>

      var CLIENT_ID = '454988175560-0k6rof7thb937jjt8lg78jg99utrfp3r.apps.googleusercontent.com';
      var API_KEY = 'AIzaSyD6cYuYJ3laD-Cih6Ng74YCbBgnD0DxgPE';
      var DISCOVERY_DOCS = ["https://www.googleapis.com/discovery/v1/apis/drive/v3/rest"];
      var SCOPES = 'https://www.googleapis.com/auth/drive.metadata.readonly';
      var base_url = $('#base-url').val();


      $(document).ready(function() {

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

       $("#sub-form").submit(function(e) {
          var email = $("#sub_email").val();
          $.ajax({
            type: "POST",
            url: base_url+"/subscription.php",
            data: {email: email},
            beforeSend: function() {
              $("#overlay").css({ 'display' : 'block'})
            },
            success: function(response)
            {
              $("#overlay").css({ 'display' : 'none'})
              if(response == "1"){
                $('#sub-alert-fail').fadeIn("fast", function(){        
                  $("#sub-alert-fail").fadeOut(2000);
                });
              }else{
                $('#sub-alert-success').fadeIn("fast", function(){        
                  $("#sub-alert-success").fadeOut(2000);
                });
              }
            }
          
        });

        return false;

      });

       $("#buynow").on('click',function() {
          var userId = $("#user_id").val();
          var gameId = $("#game_id").val();
          var id = $("#game-id").val();
          var price  = $("#price").val();
          var count = $('#d_count').val();
          if(userId == '' || gameId == '') {
            window.sessionStorage.setItem("gameId",gameId); 
            location.href = base_url+"/login"
          }else{
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
                }
            })
        })
        };
        // 1. Load the JavaScript client library.
    </script>
</body>

</html>
