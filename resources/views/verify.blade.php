<html>
    <head>
    <script>
       
    </script>
    </head>
    <body>
        <h3>Redirecting......</h3>
        <script>
      document.addEventListener("DOMContentLoaded", function (){
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const product = urlParams.get('token');
		

        
        window.location.href = "unitydl://lmn?"+product;
	

      });
      
      </script>
    </body>
</html>