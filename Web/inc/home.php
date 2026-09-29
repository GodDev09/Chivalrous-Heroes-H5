<?php
if($hide == 0)
{?>
<div class="page-main--bot">
                <div class="page-main--top">
                    <div class="page-main">

                        <div class="row align-items-center" style="min-height: 100vh;">
    <div class="container d-flex justify-content-end">
        <main class="mt-5">
		 </main>

    </div>
</div>

<!-- Bài viết ở đây -->
                    </div>
                </div>
            </div>
<?php }else {?>
<div class="page-main--bot">
               <div class="page-main--bot">
                <div class="page-main--top">
                    <div class="page-main">

                        <div class="row align-items-center" style="min-height: 100vh;">
    <div class="container d-flex justify-content-end">
        <main class="mt-5">
            <section class="mt-5 float-right d-none d-xl-block w-100">
                <ul class="d-flex justify-content-center align-items-end w-100">
                    <li class="col-4 p-0">
                        <a href="<?php if($detect->isiOS()) { echo $down['1']; } else {echo $down['0'];};?>" target="_blank" id="thiennu_dowload" onclick="ga('send', 'event', 'Download PC', 'Button Image', 'Homepage', 1);">
                            <img src="https://tanthienha.mobi/static/Home/img/bg/btn-download.png" class="w-100" alt="">
                        </a>
                    </li>
                    <li class="col-4 p-0">
                        <a href="/user/login">
                            <img src="https://tanthienha.mobi/static/Home/img/bg/btn-dang-nhap.png" class="w-100" alt="">
                        </a>
                    </li>
                </ul>
            </section>
         
            <section class="post_megry float-right">
                <section class="posts">
                    <ul class="posts__tab intro" id="posts__tab">
                        <li class="">
                            <a class="active" href="#" rel="" data-slug="" title="Tin Tức">Tổng hợp</a>
                        </li>

                    </ul>

                    <div id="posts__list" class="news item1">
                        <div id="load_items" class="intro"></div>
                    </div>
                </section>
            </section>
            <div class="clr"></div>

        </main>

    </div>
</div>
            </div>
			<script>
    var id_active = $("#posts__tab.intro li a.active").attr('rel');
    console.log(id_active)
    LoadAjax(1, id_active);
    $(document).on("click", ".pagination a", function(e) {
        e.preventDefault();
        var str = (this).href;
        var id = $('#type').val();
        str = str.split("=");
        var page = str[1];
        LoadAjax(page, id);
    });

    $("#posts__tab.intro li a").click(function(d) {
        d.preventDefault();
        $("#posts__tab.intro li a").removeClass("active");
        $("#posts__tab.intro li").removeClass("active");
        $(this).addClass("active");
        $(this).parent().addClass("active");
        var str = (this).rel;
        LoadAjax(1, str);


        $("a#posts__view-all").attr("href", link)

        return false
    });

    function LoadAjax(page, id) {
        $('#load_items').stop(true, true).load('baiviet.php');
    }
</script>
<?php } ?>