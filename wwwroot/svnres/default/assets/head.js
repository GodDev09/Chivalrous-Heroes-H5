isReadyOver = false;
//启动loading条
ready();
function ready() {
    var progressInterID;
    window["platform"] = "egret";
    var loadingUi = document.getElementById('loadingUi');
    var lbar = document.getElementById('loadingBar');
    var t1 = document.getElementsByClassName("t1")[0].firstElementChild;
    // var effect = document.getElementById('effect');
    document.getElementById('prossDiv').style.display = "block";
    var loadpercent = 0;
    var loadpercent1 = 0;
    var maxWidth = 356;
    var percent = 0.6;
    var percent1 = 0.1;
    var tempTime = 0;
    var rateTime = 10;
    var lbIndex = 0;
    var showLbList = ["正在进入高清仙剑游戏世界……","首次加载游戏耗时较长，请耐心等待","如长时间无法加载，请尝试刷新网页"];
    if (location.search.search("login_type=guest") > 0) {
        var pic1 = document.getElementsByClassName("pic1")[0];
        pic1.className = "pic2";
        var pic1 = document.getElementsByClassName("loading-progress")[0];
        pic1.className = "loading-progress1";
    }
    // var prefixStr = "每分钟就会爆发<span>8次</span>大规模团战";
    var prefixStr = showLbList[lbIndex];

    overLoad = function () {
        console.log("index overLoad");
        clearInterval(progressInterID);
        // effect.style.visibility = 'hidden';
        lbar.style.width = "99.5%";
        t1.innerHTML = prefixStr;
        if (loadingUi.parentNode)
            loadingUi.parentNode.removeChild(loadingUi);
    }

    var tick = function () {
        tempTime += rateTime;
        if (tempTime >= 1000) {
            // prefixStr = "还有<span>5秒</span>即可进入游戏";
            lbIndex ++ ;
            if(lbIndex > 2)
                lbIndex = 0;
            prefixStr = showLbList[lbIndex];
            tempTime = 0;
        }
        loadpercent += percent;
        if (loadpercent > 100) {
            loadpercent = isReadyOver ? 100 : 0;
        }
        loadpercent1 += percent1;
        if (loadpercent1 >= 100) {
            loadpercent1 = 100;
            if (isReadyOver) {
                overLoad();
                return;
            }
        } else if (isReadyOver) {
            percent = 3;
            percent1 = 2;
        }
        var targetPercent = loadpercent1 >= 99.5 ? 99.5 : loadpercent1;
        // effect.style.left = targetPercent + "%";
        lbar.style.width = targetPercent + "%";
        // t1.innerHTML = prefixStr + "（" + Math.floor(loadpercent1) + "%）";
        t1.innerHTML = prefixStr ;
    }


    setTimeout(function () {
        progressInterID = setInterval(tick, rateTime);
    }, 100);
}