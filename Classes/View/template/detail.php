<div class="FilmDetail">
    <div class="stars">
    <?php
    $x = 1;
        while ($x <= 5)
        {
            if($x <= $this->data['anzahlSterneFilm'])
            {
                ?>
                <span class="star on"></span>
                <?php
            }else {
                if($x- 0.5 == $this->data['anzahlSterneFilm'])
                {
                    ?>
                    <span class="star half"></span>
                    <?php
                } else {
                ?>
                <span class="star"></span>
                <?php
                }
            }
            $x++;
    ?>
    
    <?php
        }
    ?>
    </div>

    <h1 style="text-align: center"><?php echo $this->data['film']['Titel'] ?></h1>
    <h3 style="text-align: center">von <?php echo $this->data['film']['Produzent'] ?></h3>
    <img class="detailImage" src="http://localhost/ratethemovie/<?php echo $this->data['film']['Bild'] ?>"/>
    <div>
        <?php echo $this->data['film']['Beschreibung'] ?>
    </div>
</div>
<?php
        if(isset($_COOKIE['userid']))
        {
    ?>
        <div class="bewertungSection">
            <div class="bewertung">
                <form method="POST">
                    <span class="sternebewertung">
                    <input onchange="this.form.submit()" type="radio" id="stern5" name="bewertung" value="5"><label for="stern5" title="5 Sterne">5 Sterne</label>
                    <input onchange="this.form.submit()" type="radio" id="stern4" name="bewertung" value="4"><label for="stern4" title="4 Sterne">4 Sterne</label>
                    <input onchange="this.form.submit()" type="radio" id="stern3" name="bewertung" value="3"><label for="stern3" title="3 Sterne">3 Sterne</label>
                    <input onchange="this.form.submit()" type="radio" id="stern2" name="bewertung" value="2"><label for="stern2" title="2 Sterne">2 Sterne</label>
                    <input onchange="this.form.submit()" type="radio" id="stern1" name="bewertung" value="1"><label for="stern1" title="1 Stern">1 Stern</label>
                    <span hidden id="Bewertung"><label><input type="radio" name="bewertung" value="0"> Bewertung:</label></span>
                    </span>
                </form>
            </div>
            <div class="kommentarschreiben">
                <form method="POST">
                    <textarea class="kommentartext" name="kommentar" ></textarea>
                    <input type="submit" value="post"/>
                </form>
            </div>
        </div>
    <script>
        document.getElementById('stern' + <?php echo $this->data['anzahlSterne']?>).checked = 'checked'
    </script>
<?php
        }
    ?>

<?php
        foreach($this->data['kommentare'] as $kommentar)
        {
    ?>
        <div class="kommentar">
            <div>
                <h1 style="display: inline-block"><?php echo $kommentar['Vorname'] . ' ' . $kommentar['Nachname'] ?></h1>
                <div class="stars" style="display: inline-block; float:right">
    <?php
    $x = 1;
        while ($x <= 5)
        {
            if($x <= $kommentar['AnzahlSterne'])
            {
                ?>
                <span class="star on"></span>
                <?php
            }else {
                if($x- 0.5 == $kommentar['AnzahlSterne'])
                {
                    ?>
                    <span class="star half"></span>
                    <?php
                } else {
                ?>
                <span class="star"></span>
                <?php
                }
            }
            $x++;
    ?>
    
    <?php
        }
    ?>
    </div>
            </div>
            <h3><?php echo $kommentar['Inhalt'] ?></h1>
        </div>

    <?php
        }
    ?>