$files = Get-ChildItem -Path 'resources/views/admin' -Filter '*.blade.php' -Recurse
$emojiList = @(
    "`u{1F4CA}", "`u{1F4C5}", "`u{23F3}", "`u{2705}", "`u{1F3C6}", "`u{274C}",
    "`u{1F6AB}", "`u{2795}", "`u{1F37D}", "`u{1FA91}", "`u{1F5BC}", "`u{1F7E2}",
    "`u{1F7E0}", "`u{1F534}", "`u{1F4BE}", "`u{270F}", "`u{1F9FE}", "`u{1F464}",
    "`u{2699}", "`u{1F4CB}", "`u{1F4E5}", "`u{1F6AA}", "`u{1F4B0}", "`u{1F369}",
    "`u{1F4C8}", "`u{1F4CA}", "`u{1F4AD}", "`u{FE0F}", "`u{1F50D}", "`u{1F4C4}",
    "`u{1F4ED}", "`u{2714}", "`u{2718}", "`u{2716}", "`u{2015}", "`u{2012}",
    "`u{2013}", "`u{2014}"
)
foreach($f in $files) {
    $text = [System.IO.File]::ReadAllText($f.FullName)
    $original = $text
    foreach($e in $emojiList) {
        $text = $text.Replace("$e ", '')
        $text = $text.Replace($e, '')
    }
    if ($text -ne $original) {
        [System.IO.File]::WriteAllText($f.FullName, $text, (New-Object System.Text.UTF8Encoding $true))
        Write-Host "Cleaned: $($f.Name)"
    }
}
Write-Host "Done!"
