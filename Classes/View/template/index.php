<?php
    $con = mysqli_connect('localhost', 'root', '', 'ratethemovie');
    $sql = "SELECT * FROM `film`";
    $result = mysqli_query($con, $sql);
?>

<div class="startseitenblock">
    <h1>ratethemovie.ch</h1>
    <h2>Hier kommt ein kleiner Text</h2>
    <input type="text" placeholder="suchen"/>
    <input type="button" value="search">
</div>
<div class="beliebtfeed">
    <h1>Beliebteste Filme</h1>
    <h2><?php echo $this->data['testkey'] ?></h2>
    <div class="filmbox">
    <?php 
        while($rows = mysqli_fetch_assoc($result))
        {
    ?>
        <div class="item">
            <a href="./detail/<?php echo $rows['Titel'] ?>"><?php echo $rows['Titel'] ?></a>
        </div>

    <?php
        }
    ?>
    </div>
</div>