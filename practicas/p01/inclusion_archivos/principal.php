<body>
<script language="php"> 
echo "<h1> BUENO DIAS A TODOS </h1>";
</script>
<?php 
echo "<h2> Titulo escrito por PHP </h2>";
$variable2="MySQL";
?>
<p>Vas a descubrir <?= $variable1 ?></p>
<?php 
echo "<h2> Buenos días de $variable1 </h2>";
?>
<p> Utilización de variables PHP <br/> Vas a descubrir igualmente
<?php 
echo $variable2;
?>
</p>
<?= "<div><big> Buenos días de $variable2 </big></div>" ?> 
</body>