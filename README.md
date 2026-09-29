# Chivalrous-Heroes-H5 (XxSG)

Bộ server hoàn chỉnh cho game **H5 idle Tam Quốc** — client Egret, server Java, portal PHP.
Tên nội bộ trong script: **XxSG**. Package Java gốc: `com.linlongyx.sanguo`.

> **Trạng thái:** đang chạy được. Log gần nhất `2026-06-20 18:13`, có player thật đăng nhập
> và nhận thưởng. Còn 440 dòng ERROR trong `game/log/webgame.log` chưa xử lý.

---

## 1. Tổng quan

| Hạng mục | Thực tế |
|---|---|
| Loại project | Private server / server emulator game H5, không phải project phát triển từ đầu |
| Client | **Egret Engine** + DragonBones (skeletal animation), build ra `main.min.js` đã minify (7.3 MB) |
| Source client | **Không có.** Chỉ có bundle `main.min.js` đã minify |
| Server | Java 8 — **chỉ có 2744 file `.class` đã compile**, không có `.java` |
| Build system | **Không có.** Không `pom.xml`, không Gradle, không `package.json`. Chạy trực tiếp bằng classpath |
| Web layer | PHP thuần, không framework |
| Hạ tầng | phpstudy_pro (Nginx 1.15.11 + MySQL 5.7.26 + PHP + Redis 3.0.504) |
| Bản địa hoá | Đã Việt hoá (`wwwroot/Vietnamese.json`, UI tiếng Việt). Batch script viết tiếng Thổ Nhĩ Kỳ (`Sunucusu` = server) → nguồn gốc là bản leak từ cộng đồng TR/RageZone |
| Đường dẫn cứng | Toàn bộ script hardcode `C:\XxSG\...`. Muốn đặt thư mục khác phải sửa tay |

---

## 2. Stack server (từ `game/lib/`)

- **Netty 4.1.8** — TCP / WebSocket / HTTP
- **Spring 3.2** — cấu hình bằng XML bean, không annotation config đầy đủ
- **MyBatis 3.4.2** + **Druid 1.0.29** (connection pool) + MySQL Connector 5.1.34
- **Akka 2.5.1** (Scala 2.11) — actor model cho xử lý logic
- **Quartz 1.8.6** — job định kỳ (reset 0h/5h, world boss, kết toán đấu trường)
- **Java RMI** — đồng bộ cross-server (xếp hạng liên server)
- **Jedis 2.8.1** — Redis
- **Protobuf 2.5.0** + **MsgPack** + **fastjson** — mã hoá gói tin
- log4j 1.2.16, LZ4, javassist, cglib

---

## 3. Kiến trúc runtime

```
                            Browser (mobile / PC)
                                    │
        ┌───────────────────────────┼───────────────────────────┐
        │                           │                           │
   Nginx :80                   Nginx :81                  Nginx :8080
   root = Web/                 root = wwwroot/            root = function/
   Portal người chơi           Client game Egret          API nội bộ
   login / register            game.php → Egret           oauth/checkcdk.php
   nạp / giftcode / shop       index.js + hgavnh.js       buy/index.php
        │                                                 task/index.php
        │  Web/index.php → /user/login                          │
        │  → wwwroot/index.php (?token=base64)                  │
        │  → iframe :81/game.php                                │
        │                                                        │
        └───────────────────┬────────────────────────────────────┘
                            │  HTTP (curl, cmd=3 gửi mail vật phẩm)
                            ▼
                  ┌─────────────────────┐
                  │   Java Servers      │  JDK 1.8.0_181
                  └─────────────────────┘
                            │
   ┌────────────────────────┼────────────────────────┐
   │                        │                        │
center                    game (S1)               game2 (S2)
CrossServer               GameServer              GameServer
serverId: —               serverId 10000          serverId 10001
"cross/rank"              "小游戏1服"              "小游戏2服"
   │                        │                        │
   └── RMI :19850 ──────────┴────────────────────────┘
       crossRankRMI (xếp hạng liên server)
                            │
              ┌─────────────┴─────────────┐
         MySQL :3306                 Redis :6379 (db 13)
         sanguo_game   ← center + S1
         sanguo_game2  ← S2
         account       ← portal PHP
```

### Bảng port

| Service | WS | WSS | HTTP | JMX | RMI | Database |
|---|---|---|---|---|---|---|
| `center` (CrossServer) | 19650 | 19750 | 19651 | — | 19850 / 19451 | `sanguo_game` |
| `game` (S1) | 19101 | — | 19268 | 19301 | 17003 / 17004 | `sanguo_game` |
| `game2` (S2) | 19102 | — | 19202 | 19302 | 17005 / 17006 | `sanguo_game2` |
| Nginx portal | — | — | 80 | — | — | `account` |
| Nginx client | — | — | 81 | — | — | — |
| Nginx API | — | — | 8080 | — | — | — |

Entry point:
- `com.linlongyx.startup.CrossServer` — center
- `com.linlongyx.sanguo.webgame.startup.GameServer` — game / game2

---

## 4. Cấu trúc thư mục

```
/
├─ [0]StopAll.bat          taskkill java / nginx / mysqld / redis-server / php-cgi
├─ [1]StartWeb.bat         khởi động phpstudy_pro (Nginx + MySQL + PHP + Redis)
├─ [2]StartCenter.bat      → center/start.bat
├─ [3]StartS1.bat          → game/start.bat
├─ [4]StartS2.bat          → game2/start.bat
├─ change_mysql_pass.bat   đổi mật khẩu MySQL
│
├─ center/                 Cross server (xếp hạng liên server)
│  ├─ lib/                 ~50 jar dependency
│  ├─ target/classes/      .class đã compile + resource
│  └─ start.bat
│
├─ game/                   Game server S1
│  ├─ lib/
│  ├─ target/classes/
│  │  ├─ com/linlongyx/    core framework + sanguo/webgame + cross + logclient
│  │  ├─ webgame/beans/    Spring XML: server / mysql / redis / service / data / jmx
│  │  ├─ webgame/props/    ⚠️ credentials — bị gitignore
│  │  ├─ webgame/data/cn/  247 file JSON cấu hình gameplay
│  │  ├─ webgame/platform/ 11 kênh phát hành (.properties)
│  │  ├─ webgame/gm/       cấu hình GM
│  │  ├─ webgame/sql/      script SQL
│  │  ├─ webgame/word/     bộ lọc từ khoá
│  │  └─ quartz_jobs.xml   job định kỳ
│  └─ start.bat
│
├─ game2/                  Game server S2 — bản sao của game/, khác serverId + port + DB
│
├─ Web/                    Portal người chơi (Nginx :80)
│  ├─ user/                login, register, pay, paybank, paymomo, giftcode,
│  │  ├─ ajax/             exchange, shop, task, info, play-game...
│  │  └─ api/              role.php, shop.php
│  ├─ inc/                 func.php, home.php
│  └─ item/ assets/ css/ js/ img/
│
├─ wwwroot/                Client game (Nginx :81)
│  ├─ game.php             trang nhúng Egret player (kiểm tra session)
│  ├─ index.php            nhận ?token= base64, xác thực rồi iframe sang :81
│  ├─ index.js             progress bar loading
│  ├─ hgavnh.js            bootstrap: parse URL param → egret.runEgret() → loginFromBackPlatorm()
│  ├─ gamecfg.json         config client (URL SDK, version, res path)
│  ├─ gm.txt              danh sách lệnh GM
│  ├─ Vietnamese.json      bản dịch tiếng Việt
│  ├─ config/cfg/          config phía client
│  ├─ bone/ effect/ icon/  asset DragonBones, VFX
│  └─ debugLibs/           thư viện bản debug (chưa minify)
│
├─ function/               API nội bộ (Nginx :8080)
│  ├─ oauth/checkcdk.php   đổi giftcode → gửi mail vật phẩm qua HTTP cmd=3
│  ├─ buy/index.php        webshop: trừ xu → gửi mail vật phẩm
│  └─ task/index.php       nhiệm vụ web
│
├─ js/                     bundle client: egret, dragonBones, jszip, socket, main.min.js
├─ LoginUtil.java          ⚠️ source patch vô hiệu hoá xác thực SDK (xem §6)
├─ Portgame.txt            danh sách port game
├─ Blockport.txt           danh sách port cần chặn firewall
├─ Java/                   JDK + JRE 1.8.0_181 đóng gói kèm (gitignored)
├─ phpstudy_pro/           Nginx + MySQL + PHP + Redis (gitignored)
└─ cfr.jar                 CFR Java decompiler (gitignored)
```

---

## 5. Data gameplay

**247 file JSON** trong `game/target/classes/webgame/data/cn/` — đây là nơi cân bằng game.
Đổi số liệu game = sửa file ở đây, không cần decompile.

| Nhóm | File tiêu biểu |
|---|---|
| Tướng / thú | `partner.json`, `pet*.json`, `handbook*.json` |
| Đội hình | `array.json`, `arrayLevel.json`, `arrayRestraint.json`, `arrayTemple*.json` |
| Đấu trường | `arenaRanking.json`, `arenaRobot.json`, `arenaRule.json` |
| Bang hội | `bloc*.json` (boss, level, process, skill, war, reward) |
| Nạp thẻ | `charge.json`, `chargeReward*.json`, `continFilling*.json`, `checkDeluxe/Free/Luxury.json` |
| Cửa hàng | `dailyShop.json`, `channelShop.json`, `channelGift.json` |
| Boss | `blocBoss.json`, `bossHome.json`, `bossWorldReward.json` |
| Hệ thống khác | `bagua*.json`, `destiny*.json`, `cards*.json`, `artifact.json`, `buff.json` |
| Thời gian | `actTime.json`, `daily*.json` |

`dataLocation=cn` trong `center/.../webgame.properties` chọn bộ data (`cn` = Trung Quốc đại lục,
comment trong file có ghi `vn` = Việt Nam, `tw` = Hong Kong/Macau/Taiwan nhưng thư mục chưa tồn tại).

---

## 6. Luồng đăng nhập & thanh toán

### Đăng nhập
1. `Web/index.php` → redirect `/user/login`
2. `Web/user/login.php` xác thực với DB `account`, sinh `token`
3. Chuyển sang `wwwroot/index.php?token=<base64 của {user, token, sign}>`
4. `wwwroot/index.php` kiểm tra token/user rồi set `$_SESSION`, nhúng iframe
   `:81/game.php?user=...&sign=...&check=1`
5. `game.php` kiểm tra session → render Egret player
6. `hgavnh.js` → `main.loginFromBackPlatorm()` → WebSocket tới `ws://...:19101`

### Thanh toán / giftcode
Cả `function/buy/index.php` và `function/oauth/checkcdk.php` dùng cùng một pattern:
tra `gc_server` lấy `db` + `port` của server tương ứng (`serverId` = 5 ký tự đầu của `playerId`),
rồi gọi HTTP tới game server với `cmd=3` + payload mail chứa `rewards` → vật phẩm vào hộp thư người chơi.

Bảng liên quan trong DB `account`: `account`, `gc_info`, `gc_server`, `gc_giftcode`,
`gc_logcode`, `gc_webshop`, `gc_logxu`.

### Lệnh GM
Xem `wwwroot/gm.txt`. Ví dụ:
```
/gm currency add 1 100          thêm 100 tiền loại 1
/gm player level 100            đặt cấp nhân vật
/gm partner addPartner 1001     thêm tướng theo id bảng partner
/gm item addEquip <itemId>      thêm trang bị
/gm mail add 30000100 10        gửi 10 vật phẩm 30000100 qua thư
/gm sys logout all              kick toàn bộ người chơi
/gm sys time set 23:30:30       đổi giờ server
/gm boss worldOpen              mở World Boss
```

---

## 7. Cài đặt / chạy

### Yêu cầu
- Windows
- Thư mục project **phải** đặt tại `C:\XxSG\` (hardcode trong mọi `.bat` và vhost Nginx)
- Không cần cài Java/MySQL riêng — đã đóng gói trong `Java/` và `phpstudy_pro/`

### Sau khi clone — bắt buộc tạo lại file bí mật

Các file sau bị `.gitignore` (chứa mật khẩu), phải tạo tay:

```
game/target/classes/webgame/props/mysql.properties
game/target/classes/webgame/props/redis.properties
game/target/classes/webgame/props/webgame.properties
game2/target/classes/webgame/props/   (3 file tương tự)
center/target/classes/webgame/props/  (3 file tương tự)
Web/db.php
wwwroot/db.php
wwwroot/global/config.php
```

Mẫu `mysql.properties`:
```properties
jdbc.driverClassName=com.mysql.jdbc.Driver
jdbc.url=jdbc:mysql://127.0.0.1:3306/sanguo_game?useUnicode=true&characterEncoding=utf8
jdbc.user=<user>
jdbc.password=<password>
useUnicode=true
characterEncoding=UTF-8
```
(S2 dùng database `sanguo_game2`)

Mẫu `db.php`:
```php
<?php
$conn = mysqli_connect("localhost", "<user>", "<password>", "account")
    or die("Không thể kết nối đến CSDL");
mysqli_set_charset($conn, "UTF8");
?>
```

Mẫu `wwwroot/global/config.php` — cần các define: `DBIP`, `DBUSER`, `DBPWD`,
`DBPPORT`, `DBNAME` (= `account`), `WEBNAME`.

`webgame.properties` cần: `ws.port`, `http.port`, `jmxPort`, `serverId`, `serverName`,
`openTime`, `platform`, `rmi.url`, `logicRmi.*`, `jmxName`, `jmxPass`, `path=webgame/platform/`.
`center/webgame.properties` thêm: `wss.port`, thread count, `dataLocation`, `secretKey`, `jks`.

### Thứ tự khởi động
```
[1]StartWeb.bat       →  Nginx + MySQL + PHP + Redis
[2]StartCenter.bat    →  center (phải chạy trước game server vì có RMI)
[3]StartS1.bat        →  game S1
[4]StartS2.bat        →  game S2
```
Dừng: `[0]StopAll.bat`

---

## 8. Dấu vết reverse engineering

Project này đã bị patch để chạy độc lập khỏi SDK nhà phát hành gốc:

1. **`cfr.jar`** — CFR Java decompiler, dùng để decompile `.class` của server.
2. **`LoginUtil.java`** ở thư mục gốc là bản viết lại của
   `com.linlongyx.sanguo.webgame.processors.login.LoginUtil`. Mọi hàm kiểm tra
   trả về `0` (= pass): `checkNeedSign()`, `loginPreCheck()`, `checkPlayerName()`,
   `checkPlayerExist()`, `checkPlayerNameAndSex()`. Hiệu quả: **vô hiệu hoá xác thực
   signature của SDK gốc**, để hệ thống login PHP tự cấp quyền.
3. **`LoginUtil.class`** ở thư mục gốc **trùng khớp** (cùng 2473 byte, cùng timestamp)
   với file trong `game/target/classes/.../login/LoginUtil.class` → bản patch **đã được
   áp vào server đang chạy**.
4. `wwwroot/gamecfg.json` vẫn trỏ domain SDK của nhà phát hành Trung Quốc
   (`h5xxjsdk.shengli.com`, `sanguo-sdk.linlongyx.com`, `sqh5.res.rastargame.com`)
   dù luồng thật đi qua `127.0.0.1`. Client config chưa dọn.
5. `function/oauth/checkcdk.php` có comment ẩn quảng cáo site nguồn leak.

> **Lưu ý pháp lý:** đây là server không chính thức của một game thương mại Trung Quốc.
> Vận hành công khai có thể vi phạm bản quyền của chủ sở hữu game.

---

## 9. Vấn đề bảo mật cần xử lý

Đây là các lỗi đã xác minh trong code, xếp theo mức độ nghiêm trọng.

### 🔴 NGHIÊM TRỌNG — Credentials plaintext trong repo

Mật khẩu MySQL `root`, Redis, JMX và `secretKey` được viết thẳng trong code.

**Đã chặn bằng `.gitignore`** (file chỉ chứa config, xoá được an toàn):
```
**/webgame/props/mysql.properties      ← jdbc.password
**/webgame/props/redis.properties      ← redis.pass
**/webgame/props/webgame.properties    ← jmxPass, secretKey
Web/db.php                             ← MySQL root
wwwroot/db.php                         ← MySQL root
wwwroot/global/config.php              ← DBPWD
```

**CHƯA chặn được — 7 file PHP hardcode `mysqli_connect("localhost","root","<pass>")`
inline giữa logic ứng dụng**, không thể gitignore vì sẽ mất code:
```
function/buy/index.php
function/oauth/checkcdk.php
function/task/index.php
Web/user/ajax/role.php
Web/user/ajax/task.php
Web/user/api/role.php
wwwroot/pay/index.php
```
Phải sửa tay: thay dòng `mysqli_connect(...)` bằng `include` file `db.php` tương ứng,
rồi dùng biến `$conn` / `$db` chung. Làm việc này **trước** commit đầu tiên.

Nếu đã từng `git add` các file trên thì mật khẩu còn trong git history → phải **đổi
mật khẩu MySQL/Redis/JMX**, không chỉ xoá file (`change_mysql_pass.bat` có sẵn).

### 🔴 NGHIÊM TRỌNG — SQL injection: `function/oauth/checkcdk.php`

`$code = trim(strtoupper($_GET['code']))` được nội suy trực tiếp vào
`WHERE giftcode = '$code'` mà không escape.

Tệ hơn: bộ lọc `StopAttack()` cùng các vòng `foreach($_GET ...)` được đặt **sau**
`exit(json_encode($json))` ở phía trên → **là dead code, chưa bao giờ chạy**.
Cùng pattern lặp lại ở `function/buy/index.php`.

Sửa: dùng prepared statement (`mysqli_prepare` + `bind_param`), xoá bộ lọc regex
(vốn không hiệu quả kể cả khi chạy).

### 🔴 NGHIÊM TRỌNG — Bypass signature + SQLi: `wwwroot/index.php`

Ba lỗi trong cùng một đoạn:

1. `$user` và `$token` (giải mã base64 từ `$_GET['token']`) được đưa vào query
   **trước** khi `preg_match` kiểm tra → validation vô nghĩa với SQLi.
2. Biến gán là `$sgin = $arr['sign'];` nhưng đoạn kiểm tra dùng `$sign` — biến
   không tồn tại. Lỗi chính tả.
3. Điều kiện `if(!$user && $sign != $signkey)` dùng `&&`: khi `$user` có giá trị
   (tức luôn luôn, ở luồng bình thường), **toàn bộ kiểm tra signature bị bỏ qua**.

Hệ quả: chỉ cần biết username + một token hợp lệ định dạng là đăng nhập được,
không cần signature đúng.

### 🟠 CAO — MySQL chạy bằng `root`

Cả PHP layer lẫn 3 Java server đều dùng user `root`. Một lỗi SQLi ở PHP = toàn
quyền trên mọi database. Cần tạo user riêng: `game_s1` (chỉ `sanguo_game`),
`game_s2` (chỉ `sanguo_game2`), `web` (chỉ `account`), quyền tối thiểu.

### 🟠 CAO — Port JMX mở không xác thực mạnh

`jmxPort=19301/19302` với `jmxName`/`jmxPass` trong plaintext. JMX cho phép thực thi
mã trên JVM. `Blockport.txt` có liệt kê nhưng cần xác nhận firewall thực sự chặn
19301, 19302, 17003–17006, 19850, 19451 khỏi internet.

### 🟡 TRUNG BÌNH — Dependency đã hết hạn hỗ trợ

Java 8, Spring 3.2, log4j 1.2.16, MySQL Connector 5.1.34, fastjson 1.2.24 — tất cả
đều đã EOL và có CVE công khai. fastjson 1.2.24 đặc biệt có lỗ hổng deserialization
dẫn tới RCE (CVE-2017-18349). Không thể nâng cấp dễ vì không có source Java.

---

## 10. Vấn đề đã biết

| Vấn đề | Chi tiết |
|---|---|
| 440 dòng ERROR trong log | `game/log/webgame.log` — gồm `rankBossTimeOut 1001` và stacktrace Netty `ByteToMessageDecoder` (lỗi decode gói tin) |
| Port lệch so với tài liệu | `Portgame.txt` ghi `19201` nhưng `game2` thật dùng `http.port=19202` |
| Port không hợp lệ trong doc | `Blockport.txt` có `1945121` — có thể là `19451` và `21` bị dính liền |
| Client config chưa dọn | `gamecfg.json` vẫn trỏ SDK domain Trung Quốc (§8.4) |
| Redis bị comment out | `server-beans.xml` có `<!--<import resource="redis-beans.xml"/>-->` — Redis đang **không** được load ở game server dù config tồn tại |
| Bộ data `vn`/`tw` thiếu | `dataLocation` hỗ trợ `vn`/`tw` theo comment nhưng chỉ có thư mục `cn` |
| `game2` là bản sao thủ công | Sửa logic phải copy sang cả hai thư mục, không có cơ chế chia sẻ |
| `debugLibs/` còn trong production | `wwwroot/debugLibs/` chứa thư viện chưa minify + `vconsole` — nên chặn ở Nginx |
| Không có `.java` | Mọi thay đổi logic server phải decompile bằng `cfr.jar`, sửa, compile lại từng class |
| Repo nặng | Sau khi áp `.gitignore`: **901 MB / 27.182 file**. Phân bố: `wwwroot/` 541 MB (asset game), `game/` + `game2/` + `center/` mỗi thư mục ~100 MB (jar và data JSON **trùng lặp 3 lần**), `Web/` 36 MB. Đã cấu hình Git LFS — xem §12 |
| Vượt quota LFS GitHub | 764 MB vào LFS nhưng GitHub free chỉ cho **1 GB bandwidth/tháng** → khoảng **1 lần clone là hết quota**. Xem §12 |
| File trùng lặp 3 lần | `tools.jar` (17,4 MB), `monster.json` (17,1 MB), `scala-library.jar` (5,5 MB) và toàn bộ `lib/` + `data/cn/` tồn tại y hệt ở cả `game/`, `game2/`, `center/` → ~200 MB dư. Git dedupe theo nội dung nên repo không phồng, nhưng sửa data phải copy tay 3 chỗ |

---

## 11. Ghi chú bảo trì

- **Sửa số liệu game** → `game/target/classes/webgame/data/cn/*.json`, restart server.
- **Sửa logic server** → decompile class bằng `cfr.jar`, viết lại `.java`, compile bằng
  `Java/jdk1.8.0_181/bin/javac` với `-cp game/lib/*;game/target/classes`, copy `.class`
  vào đúng package. Xem `LoginUtil.java` làm mẫu.
- **Sửa client** → không có source. Chỉ sửa được `hgavnh.js`, `index.js`, `game.php`,
  `gamecfg.json`, và asset trong `wwwroot/`.
- **Thêm server S3** → copy `game/`, đổi `serverId`, `ws.port`, `http.port`, `jmxPort`,
  `logicRmi.port/cmport`, `jdbc.url`; tạo database mới; thêm dòng vào bảng `gc_server`;
  tạo `[5]StartS3.bat`.
- **Thư mục bị gitignore** (`Java/`, `phpstudy_pro/`) phải sao lưu riêng — không có cách
  tải lại chính xác bản đã dùng.

---

## 12. Git LFS

Repo dùng **Git LFS** cho asset binary. Cấu hình ở `.gitattributes`.

### Phân bố

Tính theo dung lượng file (raw):

| | Dung lượng | Số file |
|---|---|---|
| **Git LFS** | 1.072,0 MB | 11.600 |
| **Git thường** | 1.292,3 MB | 19.356 |
| **Tổng** | **2.364,2 MB** (2,31 GB) | **30.956** |

Nhưng **quota GitHub đếm theo object unique**, không phải raw. Repo này trùng lặp rất nhiều
(`game/`, `game2/`, `center/` có `lib/` và `data/cn/` y hệt nhau; `Java/jdk.../jre/lib` trùng
`Java/jre.../lib`). Đo thực tế trên commit đầu: 10.772 file LFS → **7.093 object unique,
490 MB** (dedup 36%).

| | Raw | Unique thực tế |
|---|---|---|
| LFS commit "init project" (core project) | 764 MB | **490 MB** — đã đo |
| LFS thêm từ `Java/` + `phpstudy_pro/` | 306 MB | ~180–300 MB — ước tính sau dedup jdk/jre |
| **LFS tổng dự kiến** | 1.072 MB | **~670–796 MB** ✅ dưới quota Free 1 GB |

Con số này đã tính cả `phpstudy_pro/`, `Java/`, database MySQL và log — xem §13.

### Đưa vào LFS

| Loại | Dung lượng (raw) | Ghi chú |
|---|---|---|
| `*.jar` | 477 MB / 935 file | 201 jar ở `game/game2/center/lib` (3 bản y hệt → ~58 MB unique) + 733 jar trong `Java/` JDK+JRE |
| `*.png` | 346 MB / 9.338 file | Asset game |
| 5 file JSON chỉ định theo path | 85 MB | `wwwroot/config/cfg.json`, `wwwroot/config/cfg/cfg.json`, `**/webgame/data/cn/monster.json` |
| `*.jpg` `*.jpeg` `*.gif` `*.bmp` `*.webp` `*.tga` `*.ico` | 62 MB | |
| `*.psd` | 36 MB / 22 file | File nguồn art |
| `*.min.js` | 19 MB | Bundle đã minify, không diff được |
| Font (`ttf/otf/eot/woff/woff2`) | 9,5 MB | |
| Audio (`mp3/ogg/wav/m4a`) | 4 MB | |
| `*.bin` `*.swf` `*.fla` | nhỏ | Asset đóng gói Egret |

> **Đừng đổi dòng `*.jar` trong `.gitattributes`.** Jar đã được commit ở dạng LFS pointer
> từ commit "init project". Bỏ nó khỏi LFS sẽ buộc phải chạy `git add --renormalize` trên
> 27.000 file và rewrite history, mà không tiết kiệm được gì vì quota vẫn dưới 1 GB.

### Cố ý KHÔNG đưa vào LFS

| Loại | Lý do |
|---|---|
| `*.json` (trừ 5 file trên) | Là **cấu hình gameplay sửa tay thường xuyên** — cần `git diff`/merge |
| `*.class` (19,7 MB / 6.094 file) | Trung bình ~3 KB/file. Pointer LFS 130 byte không tiết kiệm gì, chỉ thêm 6.094 LFS object |
| `*.dll` `*.exe` `*.ibd` | Binary của `phpstudy_pro/` và `Java/`. Giữ ngoài LFS để không đội quota |
| `*.svg` (9,9 MB / 3.131 file) | Là text |
| `*.php` `*.js` `*.css` `*.ts` | Source code |

### Quota GitHub

Remote: `github.com/GodDev09/Chivalrous-Heroes-H5` (**private**)

| | GitHub Free | Repo này |
|---|---|---|
| Giới hạn cứng mỗi file | 100 MB | ✅ File lớn nhất 76 MB (`ibdata1`) |
| LFS storage | 1 GB | ⚠️ ~670–796 MB unique — vừa, còn ít chỗ tăng |
| LFS bandwidth | 1 GB / tháng | ⚠️ ~700 MB mỗi lần clone → **1 lần clone/tháng** |
| Dung lượng repo | khuyến nghị < 5 GB | ⚠️ 2,31 GB — push được nhưng chậm |

Nếu cần clone nhiều hơn 1 lần/tháng, hoặc thêm asset làm LFS vượt 1 GB: mua Data Pack
5 USD/tháng (50 GB storage + 50 GB bandwidth), hoặc dùng `GIT_LFS_SKIP_SMUDGE=1` khi clone
(xem lệnh bên dưới).

### Hai nhóm file bị loại

`.gitignore` chỉ còn chặn 2 nhóm, vì GitHub chặn cứng file > 100 MB:

| Nhóm | Dung lượng | Lý do |
|---|---|---|
| `wwwroot/tankherocdn/` | 244 MB / 4 file | **Rác của game khác.** Nội dung là game Cocos2d-x Lua (Tank Hero): `luascript/*.lua`, `allianceWar/`, `arImage/`, `homeBuilding/`. Project này chạy Egret + TypeScript, không có Lua runtime. Grep `tankhero` và `luascript` trên toàn bộ `.php`/`.js`/`.json`/`.html` → 0 reference. 2 file `full/luascript.zip` mỗi cái 121,3 MB |
| `ib_logfile0`, `ib_logfile1` | 512 MB / 2 file | InnoDB redo log, mỗi file đúng 256 MB. MySQL tự sinh lại khi khởi động, nội dung đổi mỗi lần chạy → commit vào git chỉ làm repo phồng vô hạn. Phần còn lại của `data/` (`ibdata1`, `*.ibd`, `*.frm`) **vẫn được đưa lên** |

### Lệnh thường dùng

```bash
# Clone (LFS tải tự động nếu đã cài git-lfs)
git clone https://github.com/GodDev09/Chivalrous-Heroes-H5.git

# Clone nhanh, bỏ qua asset — chỉ lấy code, tải LFS sau khi cần
GIT_LFS_SKIP_SMUDGE=1 git clone https://github.com/GodDev09/Chivalrous-Heroes-H5.git
cd Chivalrous-Heroes-H5
git lfs pull --include="game/lib/*,center/lib/*,game2/lib/*"   # chỉ lấy jar để chạy server

# Kiểm tra file nào đang ở LFS
git lfs ls-files
git lfs status

# Xem dung lượng LFS đã dùng
git lfs env
```

> **Lưu ý:** mọi máy clone repo này **phải cài `git-lfs`** trước, nếu không sẽ nhận được
> file pointer text 130 byte thay vì asset thật, và server/client sẽ không chạy.
> Cài: https://git-lfs.com — kiểm tra bằng `git lfs version`.

---

## 13. 🔒 REPO NÀY PHẢI LUÔN LÀ PRIVATE

> **Không được chuyển repo sang public. Không được thêm collaborator ngoài.**

Theo quyết định của chủ project, toàn bộ project được đưa lên git **nguyên trạng**, bao gồm
cả những thứ bình thường không bao giờ được commit. Đây là danh sách chính xác những gì
đang nằm trong git history:

### Mật khẩu plaintext

| Nội dung | File |
|---|---|
| Mật khẩu MySQL `root` | `{game,game2,center}/target/classes/webgame/props/mysql.properties` |
| Mật khẩu Redis | `.../props/redis.properties` |
| Mật khẩu JMX (cho phép thực thi mã trên JVM) | `.../props/webgame.properties` |
| `secretKey` | `center/target/classes/webgame/props/webgame.properties` |
| Mật khẩu MySQL `root` | `Web/db.php`, `wwwroot/db.php`, `wwwroot/global/config.php` |
| Mật khẩu MySQL `root` hardcode inline | `function/{buy,oauth/checkcdk,task}/index.php`, `Web/user/ajax/{role,task}.php`, `Web/user/api/role.php`, `wwwroot/pay/index.php` |

### Dữ liệu người dùng thật

`phpstudy_pro/Extensions/MySQL5.7.26/data/` là **database MySQL đang chạy thật**, không phải
schema mẫu:

| Database | Nội dung |
|---|---|
| `account` | `account.ibd` — username + mật khẩu người chơi · `gc_admin.ibd` — tài khoản admin · `gc_lognap.ibd` — log nạp tiền · `gc_logxu.ibd` — log tiêu xu |
| `sanguo_game`, `sanguo_game2`, `sanguo_game3` | Dữ liệu nhân vật người chơi |
| `mysql` | DB hệ thống — **bảng `user` chứa hash mật khẩu MySQL root** |
| `web` | — |

### Hệ quả

1. **Push là không thu hồi được.** Xoá file rồi commit lại **không** xoá khỏi git history.
   Các bản fork, clone, và cache của GitHub vẫn giữ. Muốn xoá thật phải
   `git filter-repo` + force-push + xoá toàn bộ fork, hoặc xoá hẳn repo.
2. **Nếu repo chuyển sang public**, bot quét secret sẽ index mật khẩu trong vài phút.
   Bắt buộc đổi ngay toàn bộ mật khẩu MySQL/Redis/JMX + `secretKey`.
3. **Thêm collaborator = cấp cho họ toàn bộ mật khẩu và dữ liệu người chơi.**
4. GitHub Actions / CI đọc được repo cũng đọc được mật khẩu.

### Nếu sau này muốn làm sạch

```bash
# 1. Đổi hết mật khẩu trước (mật khẩu trong history thành mật khẩu hết hạn → lộ cũng vô hại)
change_mysql_pass.bat

# 2. Sửa 7 file PHP hardcode credentials → include db.php (xem §9)

# 3. Xoá khỏi history
git filter-repo --path phpstudy_pro/Extensions/MySQL5.7.26/data --invert-paths
git filter-repo --path-glob '**/props/*.properties' --invert-paths
git push --force

# 4. Backup database đúng cách, không commit file .ibd
mysqldump -u root -p --all-databases > backup.sql
```
