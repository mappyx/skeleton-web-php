<div class="container">
<h1>Productos</h1>
<?php 
foreach ($dataController as $producto)
{
    echo '<br>';
    echo $producto->name;
}
?>
</div>