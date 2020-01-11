

<div class="startseitenblock">
    <h1>ratethemovie.ch</h1>
    <h2>Hier kommt ein kleiner Text</h2>
    <form action="./search" method="POST">
        <input name="search" type="text" placeholder="suchen"/>
        <input type="submit" value="search">
    </form>
</div>
<div class="beliebtfeed">
    <h1>Beliebteste Filme</h1>
    <div class="filmbox">
    <?php 
        foreach($this->data['filme'] as $film)
        {
    ?>
        <div class="item" onclick="window.location='./detail/<?php echo $film['Titel'] ?>'">
            <img class="previewImage" src="http://localhost/ratethemovie/<?php echo $film['Bild'] ?>"/>
        </div>

    <?php
        }
    ?>
    </div>
</div>