<div id="cesta">
    <h3><img src="img/cesta.png" alt="Cesta" width="26" height="24">Cesta</h3>
    <hr>
    {$contenidoCesta}
    <div id="botonesCesta">
        <form action="sitio.php" method="post">
            <input class="cestaAccion" type="submit" name="cestaAccion" value="Pagar" {$disabled}>
            <input class="cestaAccion" type="submit" name="cestaAccion" value="Vaciar" {$disabled}>
        </form>
    </div>
</div>