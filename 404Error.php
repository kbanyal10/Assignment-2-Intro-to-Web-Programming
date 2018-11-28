<?php

//This code will run if any desired file is missing.

$title = "Not Found";//This changes the title of the page to "Not Found".

require ('Header.php');//This includes the header to the page which is already coded
?>
<link rel="stylesheet" href="css/bootstrap.min.css" />//This link links the page to bootstrap.min.css from css file

<div class="text-center text-danger jumbotron"  > //This div gives a little bit style to the particular division

<h1>Ooops!</h1>

<p>We've looked everywhere but we can't find that page.  Please try one of the links above.</p>

</div>
</body>
</html>