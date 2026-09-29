    /** 游戏url中附带的参数 **/
    var gameURLParams = {};
    window.urlParam = gameURLParams;
	
    window.showpay = function(url, type){
		var index = layer.open({
			title :'Trang thanh toán',
			type: 2, 
			maxmin: true,
			content: url+type
		});		 
		layer.full(index);
	};
    var main;
    //解析url中的参数
    var url = location.search; //获取url中"?"符后的字串
    console.info("参数url:" + url);
    //创建mvc框架的根容器对象
    if (url.indexOf("?") != -1) {
        //平台那边过来的需要使用decodeURIComponent。
        url = decodeURIComponent(url);
        console.info("重新解码:", url);
        var str = url.substr(1);
        var strs = str.split("&");
        for (var i = 0; i < strs.length; i++) {
            var params = strs[i].split("=");
            if (params[0] == 'userId' || params[0] == 'time' || params[0] == 'white' || params[0] == 'serverId') {
                gameURLParams[params[0]] = parseInt(params[1]);
            } else {
                gameURLParams[params[0]] = params[1];
            }

        }

        console.info("gameUID:" + gameURLParams["gameUID"]);
        console.info("channelUID:" + gameURLParams["channelUID"]);

    }

    var loadScript = function (list, callback) {
        var loaded = 0;
        var loadNext = function () {
            loadSingleScript(list[loaded], function () {
                loaded++;
                if (loaded >= list.length) {
                    callback();
                } else {
                    loadNext();
                }
            })
        };
        loadNext();
    };

    var loadSingleScript = function (src, callback) {
        var s = document.createElement('script');
        s.async = false;
        s.src = src;
        s.addEventListener('load', function () {
            s.parentNode.removeChild(s);
            s.removeEventListener('load', arguments.callee, false);
            if (callback)
                callback();
        }, false);
        document.body.appendChild(s);
    };

    var xhr = new XMLHttpRequest();
    xhr.open('GET', './manifest.json?v=' + Math.random(), true);
    xhr.addEventListener("load", function () {
        var manifest = JSON.parse(xhr.response);
        var list = manifest.initial.concat(manifest.game);
        loadScript(list, function () {
            console.log("Đang tải dữ liệu trò chơi");
            egret.runEgret({
                renderMode: "webgl",
                audioType: 2,
                calculateCanvasScaleFactor: function (context) {
                    console.log("egret.Capabilities.isMobile：" + egret.Capabilities.isMobile);
                    if (!egret.Capabilities.isMobile) {
                        return 2;
                    }
                    var backingStore = context.backingStorePixelRatio ||
                        context.webkitBackingStorePixelRatio ||
                        context.mozBackingStorePixelRatio ||
                        context.msBackingStorePixelRatio ||
                        context.oBackingStorePixelRatio ||
                        context.backingStorePixelRatio || 1;
                    return (window.devicePixelRatio || 1) / backingStore;
                }
            });
            main = egret.lifecycle.stage.getChildAt(0);
            main.loginFromBackPlatorm();
            hideLoading()
        });
    });
    xhr.send(null);
	var checkScreen = function () {
		var iwidth, iheight;
		var sw = window.screen.width;
		var sh = window.screen.height;
		if (sh > sw) {
			var tem = sh
			sh = sw;
			sw = tem;
		}
		iwidth = sw;
		iheight = sh;
		var margin_toppx = iheight / 2 - 150
		var margin_leftpx = iwidth / 2 - 163

		var tip = document.getElementById("screenTip")
		var gameCanvas = document.getElementById("mainDiv");
		var loadingUi = document.getElementById("loadingUi");

		if (window.orientation == 90 || window.orientation == -90) {
			tip.style.display = "block"
			tip.style.left = margin_leftpx + 'px'
			tip.style.top = margin_toppx + 'px'
			if (loadingUi) {
				loadingUi.style.display = 'none';
			}
			gameCanvas.style.display = "none";
		} else {
			tip.style.display = "none"
			if (loadingUi) {
				loadingUi.style.display = 'block';
			}
			gameCanvas.style.display = "block"
		}
	}