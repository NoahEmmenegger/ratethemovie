<h1 style="text-align: center">Suche: <?php echo $this->data['searching'] ?></h1>
<form style="text-align: center" method="POST">
    <input name="search" type="text" placeholder="suchen"/>
    <input type="submit" value="search">
</form>

<?php
    if (!$this->data['filme'])
    {

?>
        <div>
            Keine Filme gefunden
        </div>
<?php
    }
?>
<div class="filmbox">
    <?php
        foreach ($this->data['filme'] as $film)
        {

    ?>
            <div class="item" onclick="window.location='./detail/<?php echo $film['Titel'] ?>'">
                <img class="previewImage" src="http://localhost/ratethemovie/<?php echo $film['Bild'] ?>"/>
            </div>
    <?php
        }
    ?>
</div>