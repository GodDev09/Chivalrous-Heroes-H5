//隐藏进度条
var hideLoading = function () {
    var loadingUi = document.getElementById('loadingUi');
    clearInterval(sid);
    var prossDiv = document.getElementById('prossDiv');
    if (prossDiv && prossDiv.parentNode) {
        prossDiv.parentNode.removeChild(prossDiv);
    }
    setTimeout(function () {
        if (loadingUi && loadingUi.parentNode) {
            loadingUi.parentNode.removeChild(loadingUi);
        }
    }, 500);
}

//更新进度条
function updateLoadingProg() {
    if (loadBar) {
        currProg += 0.3;
        if (currProg > totalProg) {
            currProg = totalProg;
        }
        loadBar.style.width = currProg + "%";
    } else {
        clearInterval(sid);
    }
}

var currProg = 0;
var loadBar = document.getElementById("loadingBar");
var totalProg = 100;
var sid = setInterval(updateLoadingProg, 50);