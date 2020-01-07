<div class="FilmDetail">
    <h1 style="text-align: center"><?php echo $this->data['film']['Titel'] ?></h1>
    <img class="detailImage" src="http://localhost/ratethemovie/<?php echo $this->data['film']['Bild'] ?>"/>
    <div>
        <?php echo $this->data['film']['Beschreibung'] ?>
    </div>
</div>

<?php
        foreach($this->data['kommentare'] as $kommentar)
        {
    ?>
        <div class="kommentar">
            <h1><?php echo $kommentar['UserId'] ?></h1>
            <h3><?php echo $kommentar['Inhalt'] ?></h1>
        </div>

    <?php
        }
    ?>