  <div class="clr"></div>
            <footer>
    <div class="footer container">
        <div class="row justify-content-center align-items-center">
            <div class="col-3 col-xl-2">


            </div>
            <div class="col-2 col-xl-1">
                <a class="logo-vng" href="" title="Mộng 69">
                    <img src="/assets/img/mong69-1.png" width="100px">
                </a>
            </div>
            <div class="col-7 col-xl-8">
                <p class="Intro">
                    CÔNG TY CỔ PHẦN GC POS<br>
                    Địa chỉ: Hưng Thạnh, Cái Răng, Cần Thơ<br>
                    <br>
                </p>

            </div>
        </div>
    </div>
</footer>

        </div>
    </div>

    <div id="off_light"></div>
    <div class="fixed-box d-none d-xl-block" style="right: 0; border: 0px">

    <ul class="list-menu">

        <li>
            <a href="<?=$url;?>">
                <img src="/img/nav/topmenu.png" alt="">
            </a>
        </li>

        <li>
            <a target="_blank" id="thiennu_dowload" href="<?=$down['1'];?>" title="Tải game trên IOS" onclick="ga('send', 'event', 'Download IOS', 'Button Image', 'Homepage', 1);">
                <img src="/img/nav/load-game-ios.png" alt="">
            </a>
        </li>

        <li><a target="_blank" id="thiennu_dowload" href="<?=$down['0'];?>" title="Tải trên Google Play" onclick="ga('send', 'event', 'Download Google Play', 'Button Image', 'Homepage', 1);">
                <img src="/img/nav/google_play2.png" alt="">
            </a>
        </li>

        <li><a target="_blank" id="thiennu_dowload" href="<?=$down['0'];?>" title="Tải file APK" onclick="ga('send', 'event', 'Download APK', 'Button Image', 'Homepage', 1);">
                <img src="/img/nav/load-file-apk.png" alt="">
            </a>
        </li>

        <li><a target="_blank" id="thiennu_dowload" href="<?=$down['0'];?>" title="Tải game trên máy tính" onclick="ga('send', 'event', 'Download PC', 'Button Image', 'Homepage', 1);">
                <img src="/img/nav/play-on-pc.png" alt="">
            </a>
        </li>

        <li><a target="_blank" id="thiennu_dowload" href="<?=$url;?>user/payment" title="Nạp thẻ" onclick="ga('send', 'event', 'Nap the', 'Button Image', 'Homepage', 1);">
                <img src="/img/nav/nap-tien-icon.png" alt="">
            </a>
        </li>

        <li>
            <img src="/img/nav/social-icon.png" style="z-index: 1;" alt="">
            <ul class="social-list">
                <li><a target="_blank" href="<?=$url;?>"></a></li>
                <li><a target="_blank" href="<?=$page;?>"></a></li>
                <li><a target="_blank" href="<?=$ytb;?>"></a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;"><img class="botmenu" src="/img/nav/botmenu.png" alt=""></a>
        </li>

    </ul>
<script type="text/javascript">

    Swal.fire({
  title: '<strong class="text-success">Thông báo từ BQT</u></strong>',
  icon: 'info',
  html:
    '<?=$danhsachcode;?>',
  showCloseButton: true,
  showCancelButton: false,
  confirmButtonText:
    '<i class="fa fa-thumbs-up"></i> OK!',
  confirmButtonAriaLabel: 'Thumbs up, great!',

})
</script>
</div>
<div>
</div>
</body>
</html>