<?php

// is this a post request?
if( true )
{
   /*
     process the form submission
     and on success (a boolean value which you would put in $success), do a redirect
   */
   if( true )
   {
      $link = "product-view.php?pid=".$_GET['pid'];
       header( "Location: $link "  );
   }
   /* 
      if not successful, simply fall through here
   */
}

// has the form submission succeeded? then only show the thank you message
if( isset( $_GET[ 'message' ] ) && $_GET[ 'message' ] == 'success' )
{
?>

<h2>Thank you</h2>
<p>
You details have been submitted succesfully.
</p>

<?php
}
// else show the form, either a clean one or with possible error messages
else
{
?>

<!-- here you would put the html of the form, either a clean one or with possible error messages -->

<?php
}
?>
