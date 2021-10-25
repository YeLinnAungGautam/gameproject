<!DOCTYPE html>
<html>
  <head>
    <title>Drive API Quickstart</title>
    <meta charset="utf-8" />
  </head>
  <body>
    <p>Drive API Quickstart</p>

    <!--Add buttons to initiate auth sequence and sign out-->
    <button id="authorize_button" style="display: none;">Authorize</button>
    <button id="signout_button" style="display: none;">Sign Out</button>

    <pre id="content" style="white-space: pre-wrap;"></pre>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://apis.google.com/js/api.js"></script>

    <script type="text/javascript">
      // Client ID and API key from the Developer Console
      var CLIENT_ID = '266228857374-p6uk0fbsksqfi3a1100sst8nt0tkq6g9.apps.googleusercontent.com';
      var API_KEY = 'AIzaSyBhZ5LptCqNtEq2jFbuSD3nLBpDzaQB-Ec';

      // Array of API discovery doc URLs for APIs used by the quickstart
      var DISCOVERY_DOCS = ["https://www.googleapis.com/discovery/v1/apis/drive/v3/rest"];

      // Authorization scopes required by the API; multiple scopes can be
      // included, separated by spaces.
      var SCOPES = 'https://www.googleapis.com/auth/drive.metadata.readonly';

      
      /**
       *  On load, called to load the auth2 library and API client library.
       * 
       */
       function getIdFromUrl(url) { return url.match(/[-\w]{25,}/); }

       function start() {

        var fileId = getIdFromUrl('https://drive.google.com/file/d/1nCx1azMq-h_DNh3qSzR1HiwQFz197ZeQ/view?usp=sharing')[0]
        gapi.client.init({
            apiKey: API_KEY,
            clientId: CLIENT_ID,
            discoveryDocs: DISCOVERY_DOCS,
            scope: SCOPES
        }).then(function() {
            gapi.client.drive.files.get({
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
        gapi.load('client', start);
    </script>

    <script src="https://apis.google.com/js/api.js"></script>
  </body>
</html>