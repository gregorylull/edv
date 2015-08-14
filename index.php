<?php 
/*
  GET HEADER
*/
  get_header();
?>

<!-- ENTRY POINT FOR BODY -->
<div edv-header>header</div>
<div edv-navbar></div>
<div ng-view>this will be some ngView</div>
<div edv-footer>footers</div>

<!-- END ENTRY POINT FOR BODY -->

<?php
/*
  GET FOOTER
*/
  get_footer();
?>
