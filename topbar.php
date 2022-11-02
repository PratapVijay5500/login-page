<style>
	.logo {
    margin: auto;
    font-size: 20px;
    background: white;
    padding: 5px 11px;
    border-radius: 50%;
    color: #000000b3;
}
    
	
</style>

<nav class="navbar navbar-dark bg-blue fixed-top " style="padding:0;">
  <div class="container-fluid mt-2 mb-2">
  	<div class="col-lg-12">
    <div class="col-md-1 float-left" style="display: flex;">
  			<div class="logo">
  				<i class="fa fa-coins"></i>
  			</div>
  		</div>
	  	<div class="col-md-2 float-right text-white">
	  		<?php
        session_start();
         echo "<b>Welcome back </b> ".$_SESSION['mail']." "?><a href="ajax.php?action=logout" class="text-black"><button class="btn btn-primary btn-sm btn-block float-right " type="button" id="logout">Logout</button></a>
	    </div>
    </div>
  </div>
  
</nav>
<script>
  <?
  
  ?>
</script>