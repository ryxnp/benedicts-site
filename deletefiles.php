<?php
include "connection.php";
$id=$_GET["id"];
mysqli_query($conn, "delete from services where id=$id");
?>
<script type="text/javascript">
window.location="services.php";
</script>