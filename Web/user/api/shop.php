<?php
include "../../db.php";
$type = $_GET['type'];
if($type == "get")
{
$page = $conn->real_escape_string(strip_tags(addslashes($_GET['p'])));
if($page<1)$page=1;
$line = 10;
$offset = ($page - 1) * 7;
$row_count = $line;
$moc = $conn->query("SELECT * FROM gc_webshop ORDER BY id DESC LIMIT $offset, $row_count");
while($rs = mysqli_fetch_array($moc))
{?>
  <!-- Event Item-->
    <div class="cart-item d-md-flex justify-content-between">  <div>
            <div class="cart-item-product" href="#">
                <div class="cart-item-product-thumb"><img src="http://127.0.0.1/item/<?=$rs['img'];?>.png" alt=""></div>
                <div class="cart-item-product-info">
                    <h4 class="cart-item-product-title"><?=$rs['name'];?></h4>
<p>
<?=$rs['con'];?>
</p>
                </div>

            </div>
        </div>
<div class="text-center">
            <div class="cart-item-label">Giá</div><span class="text-xl font-weight-medium"><b class="text-success"><?=number_format($rs['xu']);?> XU</b></span>
        </div>

        <div class=" text-center">
<div class="cart-item-label"></div><span class="text-xl font-weight-medium">
<span class="text-info">
<button href="#server" data-toggle="modal" data-pack="<?=$rs['id'];?>" data-packid="<?=$rs['id'];?>" class="confirm-received btn btn-success text-light">MUA</button>
</span>
</span>
</span>
</span>
        </div>
    </div>
    <!-- Event Item-->
<?php }
} else
{
	echo "Không thể kết nối đến CSDL";
}
?>