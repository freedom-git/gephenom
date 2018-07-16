<?php
if(isset($_SESSION['session_user_id'])){}else{
?>
<script type="text/javascript">
window.location.href="/login/login.php";
</script>
<?php exit;
	}?>