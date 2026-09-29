<ul class="posts__list">
<?php
include "db.php";
$query = $conn->query("SELECT * FROM gc_post");
while($rs = mysqli_fetch_array($query))
{?>
        <li class="first">
        <a href="<?=$rs['url'];?>" class="posts__post-title hot" title="<?=$rs['tieude'];?>">
            <div class="row ghim">
                <div class="col-9 col-md-10 text-overflow"><?=$rs['tieude'];?></div>
                <div class="col-3 col-md-2"><?=$rs['date'];?></div>
            </div>

        </a>
    </li>
<?php } ?>
</ul>