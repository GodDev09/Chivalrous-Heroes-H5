<#
  SetupPaths.ps1 — chạy MỘT LẦN sau khi clone hoặc chuyển project sang thư mục khác.
  (Chạy qua SetupPaths.bat.)

  Nginx, Apache, MySQL, PHP và phpstudy chỉ đọc được đường dẫn tuyệt đối, nên 14 file
  config bên dưới chứa cứng thư mục cài đặt. Script tìm đường dẫn cũ và ghi lại thành
  thư mục hiện tại của project. Các file .bat không cần sửa — chúng dùng %~dp0.

  Đường dẫn cũ lấy từ 2 nguồn:
    1. dòng basedir= trong my.ini (vị trí cài đặt gần nhất)
    2. mọi chuỗi dạng X:\XxSG hoặc X:/XxSG (tàn dư các lần cài trước ở C:\ và D:\)

  Chạy lại bao nhiêu lần cũng an toàn: đường dẫn đã đúng thì không file nào bị ghi.
#>
$ErrorActionPreference = 'Stop'

# Console Windows mặc định dùng codepage 437/1252 nên tiếng Việt in ra thành '?'.
try { [Console]::OutputEncoding = New-Object System.Text.UTF8Encoding $false } catch { }

$root = $PSScriptRoot.TrimEnd('\', '/')

# Nhiều dòng config không đặt đường dẫn trong ngoặc kép ("include ...;", "DocumentRoot ...",
# xp.ini dùng đường dẫn làm dòng lệnh) và classpath Java dùng ';' làm dấu phân cách.
# Chỉ chấp nhận chữ không dấu, số và _ - . để không file nào bị hỏng.
if ($root -notmatch '^[A-Za-z]:([\\/][A-Za-z0-9_.-]+)+$') {
    Write-Host "LỖI: đường dẫn '$root' không dùng được." -ForegroundColor Red
    Write-Host "Nginx/Apache/MySQL/PHP trong bộ này hỏng khi đường dẫn có dấu cách, chữ có dấu"
    Write-Host "hoặc ký tự đặc biệt. Hãy đặt project vào thư mục chỉ gồm chữ không dấu, số, _ - ."
    Write-Host "và không nằm ngay gốc ổ đĩa. Ví dụ: D:\XxSG"
    exit 1
}

$newFwd  = $root -replace '\\', '/'
$newBack = $root -replace '/', '\'

# my.ini để cuối cùng: nếu script dừng giữa chừng, lần chạy lại vẫn đọc được đường dẫn cũ.
$files = @(
    'Web\dgdgd\.htaccess',
    'phpstudy_pro\COM\setting.ini',
    'phpstudy_pro\COM\xp.ini',
    'phpstudy_pro\Extensions\Apache2.4.43\conf\httpd.conf',
    'phpstudy_pro\Extensions\Apache2.4.43\conf\vhosts\0localhost_80.conf',
    'phpstudy_pro\Extensions\Apache2.4.43\conf\vhosts\0localhost_81.conf',
    'phpstudy_pro\Extensions\Apache2.4.43\conf\vhosts\0localhost_8080.conf',
    'phpstudy_pro\Extensions\Nginx1.15.11\conf\vhosts\0localhost_80.conf',
    'phpstudy_pro\Extensions\Nginx1.15.11\conf\vhosts\0localhost_81.conf',
    'phpstudy_pro\Extensions\Nginx1.15.11\conf\vhosts\0localhost_8080.conf',
    'phpstudy_pro\Extensions\php\php5.4.45nts\php.ini',
    'phpstudy_pro\Extensions\php\php5.6.9nts\php.ini',
    'phpstudy_pro\Extensions\php\php7.3.4nts\php.ini',
    'phpstudy_pro\Extensions\MySQL5.7.26\my.ini'
)

$myIni = Join-Path $root 'phpstudy_pro\Extensions\MySQL5.7.26\my.ini'
$hit = Select-String -LiteralPath $myIni -Pattern '^\s*basedir\s*=\s*"?(.+?)[\\/]phpstudy_pro[\\/]Extensions[\\/]MySQL5\.7\.26[\\/]?"?\s*$' |
    Select-Object -First 1
if (-not $hit) {
    Write-Host "LỖI: không đọc được dòng basedir= trong $myIni" -ForegroundColor Red
    exit 1
}
$oldRoot = $hit.Matches[0].Groups[1].Value

# Khớp đường dẫn cũ với cả \ lẫn /, không phân biệt hoa thường. Bắt buộc theo sau là dấu
# phân cách, ngoặc kép, ';', khoảng trắng hoặc hết dòng — để C:\XxSG không khớp nhầm C:\XxSG2.
$oldPattern = ($oldRoot -split '[\\/]' | ForEach-Object { [regex]::Escape($_) }) -join '[\\/]'
$regex = [regex]('(?i)(?:' + $oldPattern + '|\b[A-Z]:[\\/]XxSG)(?=[\\/"'';\s]|$)')

# Giữ kiểu dấu phân cách của từng chỗ: C:\XxSG\... -> D:\Moi\... ; C:/XxSG/... -> D:/Moi/...
$toNew = [Text.RegularExpressions.MatchEvaluator] {
    param($m)
    if ($m.Value.Contains('\')) { $newBack } else { $newFwd }
}

# Latin-1 ánh xạ đúng 1 byte = 1 ký tự: mọi byte không phải ASCII (chú thích tiếng Trung
# kiểu GBK, UTF-8, BOM) và kiểu xuống dòng được giữ nguyên, chỉ đoạn đường dẫn bị thay.
$latin1 = [Text.Encoding]::GetEncoding(28591)

Write-Host "Thư mục project : $root"
Write-Host "Đường dẫn cũ    : $oldRoot (từ my.ini) + mọi X:\XxSG còn sót"
Write-Host ""

$total = 0
foreach ($rel in $files) {
    $path = Join-Path $root $rel
    if (-not (Test-Path -LiteralPath $path)) {
        Write-Host "  bỏ qua, không có file: $rel" -ForegroundColor Yellow
        continue
    }
    $before = $latin1.GetString([IO.File]::ReadAllBytes($path))
    $after  = $regex.Replace($before, $toNew)
    if ($after -ceq $before) { continue }

    $n = $regex.Matches($before).Count
    [IO.File]::WriteAllBytes($path, $latin1.GetBytes($after))
    Write-Host ("  sửa {0,2} chỗ: {1}" -f $n, $rel)
    $total += $n
}

Write-Host ""
if ($total -eq 0) {
    Write-Host "Đường dẫn đã đúng — không cần sửa gì." -ForegroundColor Green
} else {
    Write-Host "Xong: $total chỗ đã trỏ về $root" -ForegroundColor Green
    Write-Host "git sẽ thấy các file trên là 'modified'. Đừng commit chúng, trừ khi muốn đổi"
    Write-Host "vị trí chuẩn của repo (hiện là C:\XxSG)."
}
