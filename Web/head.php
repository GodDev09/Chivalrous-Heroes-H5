<?php
session_start();
include "db.php";
include "inc/func.php";
?>
<!DOCTYPE html>
<html lang="vi" class=""><head>    
<title><?=$title;?></title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="robots" content="index,follow">
<meta name="revisit-after" content="1days">
<meta name="description" content="<?=$des;?>">
<meta property="og:title" content="<?=$title;?>">
<meta property="og:description" content="<?=$des;?>">
<meta property="og:image" content="/img/share.jpg">
<meta property="og:type" content="website">
<link rel="shortcut icon" href="/favicon.ico">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&amp;subset=vietnamese">
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript" src="/js/skin-homepage-v44487.js?v=1.2.26"  ></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<link rel="stylesheet" href="/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="/css/owl.carousel4487.css?v=1.2.26" type="text/css">
<link rel="stylesheet" href="/css/owl.theme.default.min4487.css?v=1.2.26" type="text/css">
<link rel="stylesheet" href="/css/global2708.css??v=1.2.26" type="text/css">
<link rel="stylesheet" href="/css/style32b3-2708.css??v=1.2.26" type="text/css">
<link rel="stylesheet" href="/css/res4487.css?v=1.2.26" type="text/css">
<script type="text/javascript" src="/js/owl.carousel.min4487.js?v=1.2.26"></script>
<script type="text/javascript" src="/js/bootstrap.bundle.min.js"></script>
<style>
/*! fancyBox v2.1.5 fancyapps.com | fancyapps.com/fancybox/#license */

.fancybox-wrap,
.fancybox-skin,
.fancybox-outer,
.fancybox-inner,
.fancybox-image,
.fancybox-wrap iframe,
.fancybox-wrap object,
.fancybox-nav,
.fancybox-nav span,
.fancybox-tmp {
    padding: 0;
    margin: 0;
    border: 0;
    outline: 0;
    vertical-align: top
}

.fancybox-wrap {
    position: absolute;
    top: 0;
    left: 0;
    z-index: 8020
}

.fancybox-skin {
    position: relative;
    background: #f9f9f9;
    color: #444;
    text-shadow: none;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px
}

.fancybox-opened {
    z-index: 99999
}

.fancybox-opened .fancybox-skin {
    -webkit-box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
    -moz-box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5)
}

.fancybox-outer,
.fancybox-inner {
    position: relative
}

.fancybox-inner {
    overflow: hidden
}

.fancybox-type-iframe .fancybox-inner {
    -webkit-overflow-scrolling: touch
}

.fancybox-error {
    color: #444;
    font: 14px/20px "Helvetica Neue", Helvetica, Arial, sans-serif;
    margin: 0;
    padding: 15px;
    white-space: nowrap
}

.fancybox-image,
.fancybox-iframe {
    display: block;
    width: 100%;
    height: 100%
}

.fancybox-image {
    max-width: 100%;
    max-height: 100%
}

#fancybox-loading,
.fancybox-close,
.fancybox-prev span,
.fancybox-next span {
    background-image: url('../img/bg/fancybox_sprite.png')
}

#fancybox-loading {
    position: fixed;
    top: 50%;
    left: 50%;
    margin-top: -22px;
    margin-left: -22px;
    background-position: 0 -108px;
    opacity: .8;
    cursor: pointer;
    z-index: 8060
}

#fancybox-loading div {
    width: 44px;
    height: 44px;
}

.fancybox-close {
    position: absolute;
    top: -18px;
    right: -18px;
    width: 36px;
    height: 36px;
    cursor: pointer;
    z-index: 8040
}

.fancybox-nav {
    position: absolute;
    top: 0;
    width: 40%;
    height: 100%;
    cursor: pointer;
    text-decoration: none;
    background: transparent url('../img/bg/blank.gif');
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    z-index: 8040
}

.fancybox-prev {
    left: 0
}

.fancybox-next {
    right: 0
}

.fancybox-nav span {
    position: absolute;
    top: 50%;
    width: 36px;
    height: 34px;
    margin-top: -18px;
    cursor: pointer;
    z-index: 8040;
    visibility: hidden
}

.fancybox-prev span {
    left: 10px;
    background-position: 0 -36px
}

.fancybox-next span {
    right: 10px;
    background-position: 0 -72px
}

.fancybox-nav:hover span {
    visibility: visible
}

.fancybox-tmp {
    position: absolute;
    top: -99999px;
    left: -99999px;
    visibility: hidden;
    max-width: 99999px;
    max-height: 99999px;
    overflow: visible!important
}

.fancybox-lock {
    overflow: hidden!important;
    width: auto
}

.fancybox-lock body {
    overflow: hidden!important
}

.fancybox-lock-test {
    overflow-y: hidden!important
}

.fancybox-overlay {
    position: absolute;
    top: 0;
    left: 0;
    overflow: hidden;
    display: none;
    z-index: 10000;
    background: url(../img/bg/fancybox_overlay.png)
}

.fancybox-overlay-fixed {
    position: fixed;
    bottom: 0;
    right: 0
}

.fancybox-lock .fancybox-overlay {
    overflow: auto;
    overflow-y: scroll
}

.fancybox-title {
    visibility: hidden;
    font: normal 15px/20px "Helvetica Neue", Helvetica, Arial, sans-serif;
    position: relative;
    text-shadow: none;
    z-index: 8050;
    padding: 0 10px
}

.fancybox-title a {
    padding: 0 10px;
    font-size: 15px
}

.fancybox-opened .fancybox-title {
    visibility: visible
}

.fancybox-title-float-wrap {
    position: absolute;
    bottom: 0;
    right: 50%;
    margin-bottom: -35px;
    z-index: 8050;
    text-align: center
}

.fancybox-title-float-wrap .child {
    display: inline-block;
    margin-right: -100%;
    padding: 2px 20px;
    background: transparent;
    background: rgba(0, 0, 0, 0.8);
    -webkit-border-radius: 15px;
    -moz-border-radius: 15px;
    border-radius: 15px;
    text-shadow: 0 1px 2px #222;
    color: #FFF;
    font-weight: 700;
    line-height: 24px;
    white-space: nowrap
}

.fancybox-title-outside-wrap {
    position: relative;
    margin-top: 10px;
    color: #fff
}

.fancybox-title-inside-wrap {
    padding-top: 10px
}

.fancybox-title-over-wrap {
    position: absolute;
    bottom: 0;
    left: 0;
    color: #fff;
    padding: 10px;
    background: #000;
    background: rgba(0, 0, 0, .8)
}

h3.Title {
    display: none
}

@media only screen and (-webkit-min-device-pixel-ratio: 1.5),
only screen and (min--moz-device-pixel-ratio: 1.5),
only screen and (min-device-pixel-ratio: 1.5) {
    #fancybox-loading,
    .fancybox-close,
    .fancybox-prev span,
    .fancybox-next span {
        background-size: 44px 152px
    }
    #fancybox-loading div {
        background-size: 24px 24px
    }
}

#fancybox-thumbs {
    position: fixed;
    left: 0;
    width: 100%;
    overflow: hidden;
    z-index: 8050
}

#fancybox-thumbs.bottom {
    bottom: 2px
}

#fancybox-thumbs.top {
    top: 2px
}

#fancybox-thumbs ul {
    position: relative;
    list-style: none;
    margin: 0;
    padding: 0
}

#fancybox-thumbs ul li {
    float: left;
    padding: 1px;
    opacity: .5
}

#fancybox-thumbs ul li.active {
    opacity: .75;
    padding: 0;
    border: 1px solid #fff
}

#fancybox-thumbs ul li:hover {
    opacity: 1
}

#fancybox-thumbs ul li a {
    display: block;
    position: relative;
    overflow: hidden;
    border: 1px solid #222;
    background: #111;
    outline: 0
}

#fancybox-thumbs ul li img {
    display: block;
    position: relative;
    border: 0;
    padding: 0;
    max-width: none
}

.loading {
    width: 100%;
    height: 200px;
    margin: 0 auto
}

.wrapper-out .wrapper,
.main-content div.plugin-social-block-p,
.game-servers .game-servers__list,
section {
    display: block;
    overflow: hidden
}

.page-header__logo,
.game-info a,
footer a.logo-360play,
footer a.logo-360game,
footer a.logo-zing,
.search__button,
.top,
.game-login__button,
.feature a,
.game-servers__title,
.game-servers__paging .jcarousel-control-prev,
.game-servers__paging .jcarousel-control-next,
.char .char-tab li .tab-1,
.char .char-tab li .tab-2,
.char .char-tab li .tab-3,
.char .char-tab li .tab-4,
.char .char-tab li .tab-5,
.char .char-cont li a {
    display: block;
    font: 0/0 a;
    text-shadow: none;
    color: transparent
}

.game-info__dowlap3,
.game-info__dowlap4,
.game-info__dowlap5,
.game-info__dowlap1,
.game-info__dowlap2,
.game-info__dowgame,
.game-info-sprite,
.game-info-game-info__payment-hov,
.game-info-game-info__payment,
.game-info-game-info__register-hov,
.game-info-game-info__register,
.game-info-logo-360game,
.game-info-logo-360play,
.game-info-logo-vng,
.game-info-logo-zingme,
.game-info__register,
.game-info__register:hover,
.game-info__payment,
.game-info__payment:hover,
footer a.logo-360play,
footer a.logo-360game,
footer a.logo-zing {
    background-image: url('../img/bg/game-info-s6e594cb74e.png');
    background-repeat: no-repeat
}

.game-info-logo-zingme {
    background-position: 0 -431px;
    height: 44px;
    width: 122px
}

.page-header__logo {
    background: url(../img/icon/logo.png) no-repeat
}

.game-info {
    float: left;
    padding: 0;
    margin: 0;
    position: relative;
}

.game-info a {
    float: left
}

.game-info_bg-download {
    background: url(../img/bg/final-2.gif) no-repeat;
    width: 383px;
    height: 215px;
    position: absolute;
    left: -52px;
    top: -46px;
    z-index: 5
}

.game-info_bg-download a {
    width: 100%;
    height: 100%;
}

.game-info_bg-download a:hover {}

.game-info__dowgame {
    background-position: left top;
    height: 74px;
    width: 142px;
    margin-top: 160px
}

.game-info__dowgame:hover {
    background-position: -295px top;
}

.game-info__payment {
    margin-top: 160px;
    background-position: -141px 0;
    height: 74px;
    width: 142px
}

.game-info__payment:hover {
    background-position: -436px top;
}

.game-info__dowlap1 {
    background-position: 0 -74px;
    height: 62px;
    width: 100%
}

.game-info__dowlap1:hover {
    background-position: -295px -74px;
}

.game-info__dowlap2 {
    background-position: 0 -136px;
    height: 62px;
    width: 100%
}

.game-info__dowlap2:hover {
    background-position: -295px -136px;
}

.game-info__dowlap3 {
    background-position: 0 -198px;
    height: 78px;
    width: 100%
}

.game-info__dowlap3:hover {
    background-position: -295px -198px;
}

.game-info__dowlap4 {
    background-position: 0 -276px;
    height: 78px;
    width: 100%
}

.game-info__dowlap4:hover {
    background-position: -295px -276px;
}

.game-info__dowlap5 {
    background-position: 0 -354px;
    height: 84px;
    width: 100%
}

.game-info__dowlap5:hover {
    background-position: -295px -354px;
}

footer {
    float: left;
    width: 100%;
    color: white;
    font-size: 100%;
    background-color: #17193073;
}

.footer {
    width: 90%;
    margin: 0 auto;
    clear: both;
    position: relative;
}


/* .footer a.logo-vng {background: url(../img/bg/vng.png) no-repeat center center;height: 70px;width: 46px;float: left; margin: 20px 36px 20px 0;background-size: 100% auto;}
.footer a.logo-net {background: url(../img/icon/logo_net.png) no-repeat center center;height: 50px;width: 126px;float: left; margin: 30px 28px 0 100px;background-size: 100% auto;} */

.footer p.Intro {
    float: left;
    line-height: 22px;
    margin-top: 30px;
    font-size: 13px;
}

#main-nav {
    position: relative;
    z-index: 2;
    text-align: right;
}

#main-nav ul {
    width: 100%;
    text-align: right;
    list-style: none;
    background: url(../img/bg/vien.png) no-repeat right center;
    padding-right: 2px;
}

#main-nav ul>li {
    display: inline-block;
    position: relative;
    padding: 0;
    margin: 0;
    background: url(../img/bg/vien.png) no-repeat left center;
}

#main-nav ul>li>a {
    display: block;
    color: #e4f3fb;
    font-size: 18px;
    padding: 22px 17px;
    text-decoration: none;
    margin-left: 2px;
}

#main-nav ul>li:first-child {}

#main-nav ul>li>a:hover {
    color: #fdbf1c;
    text-decoration: none;
    background: url(../img/bg/sub.png) repeat-x left top;
}

#main-nav ul>li:hover ul {
    display: block
}

#main-nav ul>li>ul {
    background: url(../img/bg/bg_sub.png) repeat-x left top;
    padding-top: 0px;
    display: none;
    position: absolute;
    top: 67px;
    left: 50%;
    margin-left: -85px;
    width: 200px;
    min-height: 160px;
    z-index: 9999
}

#main-nav ul>li>ul>li {
    text-align: center;
    width: 100%;
    margin: 0;
    padding: 0;
    background-image: none;
}

#main-nav ul>li>ul>li:first-child {
    background-image: none;
}

#main-nav ul>li>ul>li:last-child {}

#main-nav ul>li>ul>li ul {
    display: none
}

#main-nav ul>li>ul>li a {
    border: 0;
    color: #b3c8e5;
    height: auto;
    font-size: 15px;
    padding: 0;
    display: inline-block;
}

#main-nav ul>li>ul>li a:hover,
#main-nav ul>li>ul>li a.active {
    color: #fdbf1c;
    background-image: none;
}

#main-nav ul>li>ul>li:first-child>a {
    border: 0;
}

#main-nav ul>li>ul>li a span {
    padding: 3px 12px;
}

#main-nav ul>li>ul>li a:hover span {
    background: url(../img/bg/menu_sub.png) no-repeat center center;
}

.wrapper-out {
    position: relative;
}

.wrapper-out.index .wrapper {
    background: url(../img/bg/page-header.jpg) no-repeat center top
}

.wrapper-out.home .wrapper {
    background: url(<?=$background;?>) no-repeat;
    /*background-size: 100%;*/
    background-attachment: fixed;
}

.wrapper-out .wrapper {
    background: url(<?=$background;?>) no-repeat center top;
    background-size: 100%;
}

.wrapper-out.home.toi .wrapper {
    background: url(../img/bg/page-header-t.jpg) no-repeat center top;
    background-size: 100%;
    background-attachment: fixed;
}

.wrapper-out.toi .wrapper {
    background: url(../img/bg/page-header-t.jpg) no-repeat center top;
    background-size: 100%;
}

.wrapper-out .wrapper .page-header {
    height: 690px;
    width: 920px;
    margin: 0 auto;
    position: relative;
}

.wrapper-out .wrapper .page-header--outter {
    width: 100%;
    margin: 0 auto;
}

.wrapper-out .wrapper .page-header__logo {
    width: 100px;
    height: 98px;
    position: absolute;
    left: 0;
    top: 8px;
    background-size: 100% 100%;
    z-index: 100;
}

.wrapper-out .wrapper .page-main {
    float: left
}

.wrapper-out .wrapper .page-main--bot {
    padding-bottom: 120px;
    width: 1000px;
    margin: 0 auto
}

.wrapper-out.detail .wrapper .page-main--top {
    width: 100%;
    margin: 0 auto;
    padding: 0
}

.wrapper-out.detail .wrapper .page-main--bot {
    padding-bottom: 120px;
    width: 100%;
    margin: 0 auto
}

.wrapper-out .wrapper .page-main--top {
    width: 1000px;
    margin: 0 auto;
    padding: 0
}

.wrapper-out .wrapper .page-main aside {
    float: left;
    width: 286px
}

.wrapper-out .wrapper .page-main main {
    float: left;
    width: 50vw;
    max-width: 714px;
    margin-top: 0;
}


/* .wrapper-out.home .wrapper .page-main aside {float: none;width: 286px} */

.wrapper-out.detail .wrapper .page-main main,
.wrapper-out.categoryNews .wrapper .page-main main {
    width: 100%;
    max-width: initial;
}

.wrapper-out.detail,
.wrapper-out.categoryNews {
    background-color: #e6e4e5;
    background: url(../img/bg/pattern.jpg) repeat-y;
    background-position: center;
    background-size: contain;
}

.wrapper-out.detail .wrapper .page-main,
.wrapper-out.categoryNews .wrapper .page-main {
    width: 100%;
}

.wrapper-out.detail .wrapper .page-header,
.wrapper-out.categoryNews .wrapper .page-header {
    height: 300px;
}

.wrapper-out.detail .wrapper,
.wrapper-out.categoryNews .wrapper {
    background: url(../img/bg/bg_list_new3.jpg) no-repeat;
    background-size: 100%;
}

;
.wrapper-out.home .wrapper .page-main main {
    float: none;
    width: auto;
}

.wrapper-out.categoryNews .wrapper .page-main--bot,
.wrapper-out.home .wrapper .page-main--bot {
    width: 100%;
}

.wrapper-out.categoryNews .wrapper .page-main--top,
.wrapper-out.home .wrapper .page-main--top {
    width: 100%;
}

.wrapper-out.home .wrapper {
    min-height: 100vh;
}

.wrapper-out.home .wrapper .page-main {
    float: none
}

.news-postss {
    background-color: #252849;
}

.cse .gsc-control-cse,
.gsc-control-cse {
    background-color: #fff;
    min-height: 300px;
}

.banner {
    position: relative;
    width: 100%;
}

.home .banner {
    position: relative;
    width: 100%;
}

.banner-event {
    border: 0;
    position: relative;
    overflow: hidden;
    float: left;
    z-index: 1;
    width: 100%
}

.banner-event__list {
    position: relative;
    width: 20000em;
    height: 100%
}

.banner-event__list li {
    float: left
}

.banner-event__list li a,
.banner-event__list li img {
    display: block;
    height: 100%;
    width: 100%
}

.banner-event__control {
    position: absolute;
    z-index: 10;
    right: 10px;
    bottom: 10px;
}

.banner-event__control a {
    background: url('../img/bg/icon_slide.png') no-repeat center center;
    color: #fff;
    margin: 0 4px;
    width: 16px;
    height: 16px;
    line-height: 16px;
    font-size: 0;
    display: inline-block;
    text-align: center;
    text-decoration: none
}

.banner-event__control a:hover,
.banner-event__control a.active {
    background: url('../img/bg/icon_slide_hover.png') no-repeat center center;
}

.chars-sprite,
.chars-bt-viewmore-hov,
.chars-bt-viewmore,
.chars-tab-1-hov,
.chars-tab-1,
.chars-tab-2-hov,
.chars-tab-2,
.chars-tab-3-hov,
.chars-tab-3,
.chars-tab-4-hov,
.chars-tab-4,
.chars-tab-5-hov,
.chars-tab-5,
.char .char-tab li .tab-1,
.char .char-tab li .tab-1:hover,
.char .char-tab li:hover .tab-1,
.char .char-tab li.active .tab-1,
.char .char-tab li .tab-2,
.char .char-tab li .tab-2:hover,
.char .char-tab li:hover .tab-2,
.char .char-tab li.active .tab-2,
.char .char-tab li .tab-3,
.char .char-tab li .tab-3:hover,
.char .char-tab li:hover .tab-3,
.char .char-tab li.active .tab-3,
.char .char-tab li .tab-4,
.char .char-tab li .tab-4:hover,
.char .char-tab li:hover .tab-4,
.char .char-tab li.active .tab-4,
.char .char-tab li .tab-5,
.char .char-tab li .tab-5:hover,
.char .char-tab li:hover .tab-5,
.char .char-tab li.active .tab-5,
.char .char-cont li a,
.char .char-cont li a:hover {
    background-image: url('../img/chars-s34da4bdb26.html');
    background-repeat: no-repeat
}

section {
    float: left;
    margin: 0
}

section.post_megry {
    background: url('../img/bg/bg_post.jpg') no-repeat center top;
    width: 100%;
}

.home section.post_megry {
    width: 100%;
    background: rgb(216 222 232 / 89%)
}

section.posts {
    width: 100%;
    padding: 10px 18px;
    position: relative;
}

section.char {
    width: 710px;
    height: 340px;
    margin-bottom: 20px
}

section.intro {
    width: 710px;
    height: 340px
}

.posts__view {
    background: url(../img/bg/icon-more.png) no-repeat right 0;
    color: #b0b8ce;
    font: 12px/20px Arial;
    padding-right: 20px;
    height: 20px;
    position: absolute;
    right: 50px;
    top: 25px
}

.posts__view:hover {
    background: url(../img/bg/icon-more-hover.png) no-repeat right 0;
}

.posts__tab {
    display: flex;
    justify-content: space-between;
    width: 100%;
}

.posts__tab li {
    float: left;
    padding-left: 30px;
}

.posts__tab li:first-child {
    padding-left: 0;
}

.posts__tab li a {
    color: #000;
    display: block;
    float: left;
    font-size: 1.2vw;
    margin-bottom: -9px;
}

.posts__tab li a:hover,
.posts__tab li a.active {
    color: #5d95db;
    border-bottom: 3px solid #5d95db
}

.posts__list {
    width: 100%;
    padding: 10px 0 0;
    overflow: hidden;
    clear: both;
    float: left;
    min-height: 250px;
}

.posts__list li {
    color: #6a6a6a;
    overflow: hidden;
}

.posts__list li:last-child {
    border-bottom: 0
}

.posts__list li .posts__post-title {
    background: url(../img/bg/icon_news.png) no-repeat left center;
    display: block;
    font-size: 1vw;
    text-indent: 20px;
    line-height: 39px;
    color: #000;
    text-decoration: none;
}

.posts__list li .posts__post-title:hover,
.posts__list li .posts__post-title:hover time {
    color: #fdc01a
}

.posts__list li .posts__post-title time {
    float: right;
    padding-right: 35px;
    color: #fff;
}

.posts__list li span {
    margin-right: 15px;
    text-transform: uppercase;
}


/* .posts__tab li.active{border-bottom: 3px solid #5d95db} */


/* .home .posts__tab li a.active{border: 0px;} */

.home .posts__tab li.active {
    background: url(../img/bg/mui_2.png) no-repeat center bottom;
}

.home .posts__tab li {
    padding: 1vw .5vw;
}

.detail .posts__tab li a,
.categoryNews .posts__tab li a {
    padding: 5px 10px;
    text-align: center;
    line-height: 130%;
}

.detail .posts__tab li,
.categoryNews .posts__tab li {
    padding: 2px;
}

.detail .posts__tab li a:hover,
.detail .posts__tab li a.active,
.categoryNews .posts__tab li a:hover,
.categoryNews .posts__tab li a.active {
    background: #252849;
    color: white;
    border-radius: 10px;
    border: 0px;
}

section.posts.bottom {
    padding: 10px 0 10px 18px;
}

.posts__tab.bottom {
    border-bottom: solid 1px #5f6178;
    margin-bottom: 25px;
}

.posts__tab.bottom.dt {
    margin-bottom: 3px;
}

.posts.bottom .post-mh img {
    width: 100% !important;
}

.posts__tab.bottom li a:hover,
.posts__tab.bottom li a.active {
    border-bottom: 3px solid #ebc574;
}

.posts__tab.bottom li a.active {
    background: url(../img/bg/mui_1.png) no-repeat center bottom;
}

.posts__tab.bottom.dt li {
    padding-left: 24px;
}

.posts__tab.bottom.dt li:first-child {
    padding-left: 0;
}

.posts__tab.bottom.dt li a {
    font: 15px/32px Arial;
}

.gallary img {
    width: 100%
}

section.intro {
    width: 100%;
    margin-bottom: 58px;
    padding-left: 4px;
}

.swiper-container {
    margin: 0 auto;
    position: relative;
    overflow: hidden;
    z-index: 1
}

.swiper-wrapper {
    position: relative;
    width: 100%;
    height: 100%;
    z-index: 1;
    display: -webkit-box;
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    -webkit-transition-property: -webkit-transform;
    -moz-transition-property: -moz-transform;
    -o-transition-property: -o-transform;
    -ms-transition-property: -ms-transform;
    transition-property: transform;
    -webkit-box-sizing: content-box;
    -moz-box-sizing: content-box;
    box-sizing: content-box
}

.swiper-slide {
    -webkit-flex-shrink: 0;
    -ms-flex: 0 0 auto;
    flex-shrink: 0;
    width: 100%;
    height: 100%;
    position: relative
}

.swiper-slide img {
    display: block
}

@-webkit-keyframes swiper-preloader-spin {
    100% {
        -webkit-transform: rotate(360deg)
    }
}

@keyframes swiper-preloader-spin {
    100% {
        transform: rotate(360deg)
    }
}

.swiper-container {
    width: 100%;
    height: 100%
}

.swiper-slide {
    text-align: center;
    font-size: 18px;
    background: #fff;
    display: -webkit-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    -webkit-justify-content: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    -webkit-align-items: center;
    align-items: center
}

.fixed-box {
    display: block;
    width: 200px;
    position: fixed;
    top: 50px;
    right: 0;
    z-index: 100;
    border-top: solid 8px #7894dc;
}

.fixed-box ul.download {
    position: relative;
    margin: 10px 0 0 15px;
    padding-top: 0px;
}

.fixed-box ul.download li {
    float: left;
    margin: 0 0 5px;
}

.fixed-box ul.download a,
.fixed-box .toggle.close,
.fixed-box .toggle.open {
    background-image: url('../img/bg/btn-nap-the.png');
    background-repeat: no-repeat;
    background-position: left top;
}

.fixed-box ul.download a {
    display: block;
    text-indent: -9999px;
    height: 50px;
    width: 174px;
}

.fixed-box ul.download .app-info__install--app-store>a {
    background-position: 0 -100px;
}

.fixed-box ul.download .app-info__install--app-store>a:hover {
    background-position: 0 0;
}

.fixed-box ul.download .app-info__install--google-play>a {
    background-position: 0 -250px;
}

.fixed-box ul.download .app-info__install--google-play>a:hover {
    background-position: 0 -150px;
}

.fixed-box ul.download .app-info__install--pc>a {
    background-position: 0 -401px;
}

.fixed-box ul.download .app-info__install--pc>a:hover {
    background-position: 0 -300px;
}

.fixed-box ul.download .app-info__install--pc.button-play-on-pc>a {
    background-position: 0 -552px;
}

.fixed-box ul.download .app-info__install--pc.button-play-on-pc>a:hover {
    background-position: 0 -450px;
}

.fixed-box ul.download .app-info__install--pc.button-payment>a {
    background-position: 0 -702px;
}

.fixed-box ul.download .app-info__install--pc.button-payment>a:hover {
    background-position: 0 -602px;
}

.fixed-box ul.download .app-info__install--360>a {
    background-position: 0 -949px;
}

.fixed-box ul.download .app-info__install--360>a:hover {
    background-position: 0 -849px;
}

.fixed-box .toggle {
    position: absolute;
    top: 12px;
    left: -30px;
}

.fixed-box .toggle.close {
    background-position: 0 -800px;
    height: 49px;
    width: 30px;
}

.fixed-box .toggle.open {
    background-position: 0 -752px;
    height: 49px;
    width: 30px;
}

.fixed-box ul.download a.ht {
    background: url('../img/bg/thiennu_hotro.png') no-repeat center -50px;
}

.fixed-box ul.download a.ht:hover {
    background: url('../img/bg/thiennu_hotro.png') no-repeat center top;
}

.block-top {
    float: left;
    width: 100%;
    background: #344881 url(../img/bg/bg-block-fixed-top.png) no-repeat center bottom;
}

.block-bottom {
    background: url('../img/bg/bg-block-fixed-bottom.png') no-repeat center bottom;
    height: 26px;
    float: left;
    width: 100%;
    background-size: 100% 100%;
}


/* .search_tk{border: solid 1px #232442;} */

.search_tk input[type='text'] {
    background: none;
    border: none;
    padding: 0 10px;
}

#search_btn {
    border: none;
    background: none;
    color: #fff;
    font-size: 20px;
}

.search_tk input[type='text']::-webkit-input-placeholder {
    /* Chrome/Opera/Safari */
    color: #fff !important;
    font-style: italic
}

.search_tk input[type='text']::-moz-placeholder {
    /* Firefox 19+ */
    color: #fff !important;
    font-style: italic
}

.search_tk input[type='text']:-ms-input-placeholder {
    /* IE 10+ */
    color: #fff !important;
    font-style: italic
}

.search_tk input[type='text']:-moz-placeholder {
    /* Firefox 18- */
    color: #fff !important;
    font-style: italic
}

.box {
    width: 300px;
    height: 50px;
}

.container-2 {
    width: 300px;
    vertical-align: middle;
    white-space: nowrap;
    position: relative;
}

.container-2 input#search {
    width: 35px;
    height: 50px;
    border: none;
    font-size: 10pt;
    float: left;
    padding-left: 35px;
    background: none;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    color: #fff;
    -webkit-transition: width .55s ease;
    -moz-transition: width .55s ease;
    -ms-transition: width .55s ease;
    -o-transition: width .55s ease;
    transition: width .55s ease;
}

.container-2 input#search::-webkit-input-placeholder {
    color: #fff !important;
    font-style: italic
}

.container-2 input#search:-moz-placeholder {
    /* Firefox 18- */
    color: #fff !important;
    font-style: italic
}

.container-2 input#search::-moz-placeholder {
    /* Firefox 19+ */
    color: #fff !important;
    font-style: italic
}

.container-2 input#search:-ms-input-placeholder {
    color: #fff !important;
    font-style: italic
}

.container-2 .icon {
    position: absolute;
    top: 50%;
    margin-left: 10px;
    margin-top: 15px;
    z-index: 1;
    color: #fff;
}

.container-2 input#search:focus,
.container-2 input#search:active {
    outline: none;
    width: 300px;
}

.container-2:hover input#search {
    width: 300px;
}

.container-2:hover .icon {
    color: #93a2ad;
}


/* bg menu */

.bg-dark {
    background: rgb(0 0 0 / 54%) !important;
}

.navbar-dark .navbar-nav .nav-link {
    color: #fff;
    padding: 7px 15px;
}

.nav-item:last-child .nav-link {
    border-right: 0px solid;
}

.nav-item:not(:last-child) .nav-link {
    position: relative;
}

.nav-item:not(:last-child):hover .nav-link::after {
    content: '';
    position: absolute;
    background-size: 100%;
    bottom: -20px;
    width: 45px;
    height: 35px;
    right: 0;
}

.dropdown-menu {
    color: #ffffff;
    background-color: #06060673;
}

.dropdown-item {
    color: #ffffff;
}

.dropdown:hover>.dropdown-menu {
    display: block;
}

.pagination {
    display: inline;
}


/* list post */

.border-white {
    border-bottom: 1px solid #fff;
    border-top: 1px solid #fff;
}
</style>
</head>
<body style="">
    <div class="game-18-tuoi d-none d-lg-block" style="position: fixed;top: 90px;left: 0px;z-index: 2;">
        <img src="/img/bg/long-dinh-18.jpg">
    </div>

    <div class="wrapper-out  home">
        <div class="wrapper">
            <!--navbar-->
            <div id="boxAudio">
                <a class="sound-video fancybox" href="<?php if($detect->isiOS()) { echo $down['1']; } else {echo $down['0'];};?>" title="<?=$title;?>"></a>
            </div>

            <nav class="navbar navbar-expand-xl navbar-dark bg-dark fixed-top py-2">
    <div class="container justify-content-center ">
        <div class="bor-logo">

            <div class="row align-items-center justify-content-center d-flex d-xl-none">
                <a href="<?=$url;?>" class="nav-link navbar-brand col-3 col-md-2 mr-0">
                    <img src="/assets/img/logo.png" width="100px" class="w-100">
                </a>
                <ul class="col-6 col-md-7 d-flex justify-content-center align-items-end d-flex d-xl-none px-0">
                    <li class="col-6 p-0">
                        <!-- Link theo từng hệ điều hành -->
                        <a href="<?php if($detect->isiOS()) { echo $down['1']; } else {echo $down['0'];};?>" target="_blank" id="thiennu_dowload" onclick="ga('send', 'event', 'Download APK', 'Button Image', 'Homepage', 1);">
                            <img src="/imgs_mobile/down.png" class="w-100" alt="">
                        </a>

                    </li>
                    <li class="col-6 p-0">
                        <a href="user/payment">
                            <img src="/imgs_mobile/Nap.gif" class="w-100" alt="">
                        </a>
                    </li>
                </ul>
                <div class="col-2">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </div>
            <a class="nav-link navbar-brand d-none d-xl-inline-block" href="<?=$url;?>">
                <img src="/assets/img/logo.png" width="100px" class="">
            </a>
        </div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="mx-3 text-center">
               
            </div>
            <ul class="navbar-nav ml-auto text-center">
				<?php 
				while($mn = mysqli_fetch_array($summenu))
				{?>
				<li class="nav-item dropdown">
                <a class="nav-link" href="<?=$mn['url'];?>">
                <span class="icon_12"> </span> <?=$mn['name'];?></a>
                </li>
                <?php } ?>
				<?php if(isset($_SESSION['username'])) { ?>
				<li class="nav-item dropdown">
				<a class="nav-link" href="<?=$url;?>user/">
                <span class="fa fa-user"></span> Tài khoản: <font color="red"><b><?=$_SESSION['username'];?></b></font>
			    </a>
                </li>
				<li class="nav-item dropdown">
				<a class="nav-link" href="<?=$url;?>user/logout">
                <span class="fa fa-sign-out"></span> Thoát
			    </a>
                </li>
				<?php } else {?>
				<li class="nav-item dropdown">
                <a class="nav-link" href="/user/register">
                <span class="icon_12"> </span> Đăng ký</a>
                </li>
				<li class="nav-item dropdown">
                <a class="nav-link" href="/user/login">
                <span class="icon_12"> </span> Đăng nhập</a>
                </li>
				<?php } ?>
            </ul>

        </div>
    </div>

</nav>      