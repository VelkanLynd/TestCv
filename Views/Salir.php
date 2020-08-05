<?php

     session_destroy();

     if( isset($_SESSION['TokenGoogle']) && !empty($_SESSION['TokenGoogle']) )
     {
          unset($_SESSION['TokenGoogle']);
     }

     echo('<script>

               localStorage.removeItem("Usr");
	          localStorage.clear();

               window.location = "' . PathSystem . '" 

          </script>');

?>