package com.linlongyx.sanguo.webgame.processors.login;

import com.linlongyx.core.framework.logic.IPlayerSession;
import com.linlongyx.core.framework.logic.ISession;
import com.linlongyx.core.framework.logic.IPlayer;
import com.linlongyx.sanguo.webgame.app.user.UserComponent;
import com.linlongyx.sanguo.webgame.app.player.PlayerComponent;
import com.linlongyx.sanguo.webgame.common.player.Player;
import com.linlongyx.sanguo.webgame.proto.binary.struct.WxPlayerInfo;

public class LoginUtil {
    public static final int OFFLINE_TYPE_REPLACE = 1;
    public static final int OFFLINE_TYPE_CROSS_LOGOUT = 2;

    public static short checkPlayerName(String name) { return 0; }
    public static String updateHead(String head, int type) { return head; }
    public static short checkPlayerNameAndSex(String name, byte sex) { return 0; }
    public static short checkPlayerExist(PlayerComponent playerComp, UserComponent userComp) { return 0; }
    
    public static short createPlayer(IPlayerSession session, long userId, String name, long p4, byte sex, UserComponent userComp, PlayerComponent playerComp, IPlayer player, long p9) {
        if (userComp != null && playerComp != null) {
            userComp.addPlayer(playerComp.getPlayerId(), name, sex);
            userComp.saveToDB();
            playerComp.saveToDB();
        }
        return 0;
    }
    
    public static void updateOrNotice(long userId, WxPlayerInfo info) {}
    public static short loginPreCheck(IPlayerSession session, int serverId, int userId) { return 0; }
    public static short checkNeedSign(Player player, String sign, long time, long userId, int serverId) { return 0; }
    public static void updateFromCross(WxPlayerInfo info, long userId) {}

    public static void loginReplace(IPlayerSession playerSession) {
        if (playerSession != null && playerSession.getTcpSender() != null) {
            playerSession.getTcpSender().close();
        }
    }
    
    public static void loginCrossLogout(IPlayerSession session) {
        if (session != null && session.getTcpSender() != null) {
            session.getTcpSender().close();
        }
    }

    public static void offlineNotice(IPlayerSession session, int type) {
    }
}
