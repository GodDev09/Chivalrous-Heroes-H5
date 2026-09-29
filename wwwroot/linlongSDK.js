;
(function () {
	//1. 获取定义，再新增
	var sdk = window.linlongSDK || {};

	var channulUID;
	sdk.setUID = function (uid) {
		channulUID = uid;
	}
	/** 创角信息上报 */
	sdk.upLoadCreate = function (data) {
		console.info("创角上报：", data);
		switch (channulUID) {
			default:
				window.XH_SDK.RaStarUploadCreate(data);
				break;
		}
	}
	/** 选服界面上报 */
	sdk.upLoadChangeServer = function (data) {
		console.info("选服界面上报：", data);
		switch (channulUID) {
			default:
				window.XH_SDK.RaStarUploadEnter(data);
				break;
		}
	}
	/** 升级时上报 */
	sdk.upLoadUpLevel = function (data) {
		console.info("升级时上报：", data);
		switch (channulUID) {
			default:
				window.XH_SDK.RaStarUploadLevelUp(data);
				break;
		}
	}
	/** 改名时上报 */
	sdk.upLoadChangeName = function (data) {
		console.info("改名时上报：", data);
		switch (channulUID) {
			default:
				window.XH_SDK.RaStarUploadChangeName(data);
				break;
		}
	}
	/** 登陆成功上报 */
	sdk.upLoadEntergame = function (data) {
		console.info("登陆成功上报：", data);
		switch (channulUID) {
			default:
				window.XH_SDK.RaStarEnterGameCom(data);
				break;
		}
	}
	/** 完成任务时上报 */
	sdk.upLoadFinishTask = function (data) {
		console.info("完成任务时上报：", data);
		switch (channulUID) {
			default:
				window.XH_SDK.RaStarFinishTask(data);
				break;
		}
	}
	/** 支付方法吊起 */
	sdk.payFunc = function (data) {
		console.info("支付方法吊起：", data);
		switch (channulUID) {
			default:
				var orderInfo = {};
				var objList = data.orderInfo.split("&");
				for (var i = 0, len = objList.length; i < len; i++) {
					var obj = objList[i].split("=");
					if (obj) {
						orderInfo[obj[0]] = obj[1];
					}
				}
				data.orderInfo = orderInfo;
				data.extra = "abc";
				window.XH_SDK.RaStarPay(data);
				break;
		}
	}
	/** 实名认证 */
	sdk.showRealName = function (data) {
		console.info("吊起实名认证接口：", data);
		switch (channulUID) {
			default:
				window.XH_SDK.RaStarRealNameVerify(function (info) {
					if (data && data.callBack) {
						data.callBack.call(data.thisObj, info);//info：1 认证成功，0 认证失败
					}
				});
				break;
		}
	}
	/** 创建桌面快捷方式 */
	sdk.addShortcut = function (data) {
		console.info("创建桌面快捷方式：", data);
		switch (channulUID) {
			default:
				window.XH_SDK.RaStarAddShortcut(function (info) {
					if (data && data.callBack) {
						data.callBack.call(data.thisObj, info);//info：1 创建桌面快捷方式成功，0 失败
					}
				});
				break;
		}
	}
	/** 收藏 */
	sdk.collect = function (data) {
		console.info("吊起收藏接口：", data);
		switch (channulUID) {
			default:
				window.XH_SDK.RaStarCollect(function (info) {
					if (data && data.callBack) {
						data.callBack.call(data.thisObj, info);//info：1 收藏成功，0 失败
					}
				});
				break;
		}
	}
	/** 游戏关注 */
	sdk.follow = function (data) {
		console.info("吊起游戏关注接口：", data);
		switch (channulUID) {
			default:
				window.XH_SDK.RaStarFollow(function (info) {
					if (data && data.callBack) {
						data.callBack.call(data.thisObj, info);//info：1 关注成功，0 失败
					}
				});
				break;
		}
	}
	/** 游戏分享 */
	sdk.share = function (data) {
		console.info("吊起游戏分享接口：", data);
		switch (channulUID) {
			default:
				window.XH_SDK.RaStarShare(function (info) {
					if (data && data.callBack) {
						data.callBack.call(data.thisObj, info);//info：1 分享成功，0 失败
					}
				});
				break;
		}
	}
	/** 手机绑定 */
	sdk.bindPhone = function (data) {
		switch (channulUID) {
			default:
				window.XH_SDK.RaStarBindPhone(function (info) {
					if (data && data.callBack) {
						data.callBack.call(data.thisObj, info);//info：1 绑定成功，0 失败
					}
				});
				break;
		}
	}

	// 新增完了后再写入window
	window.linlongSDK = sdk;
})();