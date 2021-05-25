<?php
$domain = "https://winnie.smnarnold.com";
$url = $domain;
$uri = substr($_SERVER[REQUEST_URI], 1);
$uriParts = explode('/', $uri);
$slug = $uriParts[0];

if ($slug) {
  $url .= $uri;
}

$resolution = $uriParts[1];
$opengraph = $domain . "/img/opengraph.jpg";

if($resolution) {
  $opengraph = $domain . "/img/opengraph-" . $resolution . ".jpg";
}

$strJson = file_get_contents("memes.json");
$json = json_decode($strJson);
$title = "Winnie le caca 💩";
$text1 = '';
$text2 = '';
$img2 = '';
$source = '';

foreach ($json as $obj) {
  if ($obj->slug == $slug) {
    $text1 = $obj->no1->text;
    $title = "Winnie le caca 💩 | " . $text1;

    if ($obj->no2->text) {
      $text2 = $obj->no2->text;
    } elseif ($obj->no2->img) {
      $img2 = $obj->no2->img;
    }

    $source = $obj->source;
  }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Favicons -->
  <link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon/favicon-16x16.png">
  <link rel="manifest" href="/img/favicon/site.webmanifest">
  <link rel="mask-icon" href="/img/favicon/safari-pinned-tab.svg" color="#fba919">
  <meta name="msapplication-TileColor" content="#f52532">
  <meta name="theme-color" content="#f52532">

  <!-- Primary Meta Tags -->
  <title><?php echo $title ?></title>
  <meta name="title" content="<?php echo $title ?>">
  <meta name="description" content="Le joual québécois à son meilleur. Parfois poétique, souvent drôle.">
  <meta name="author" content="Simon Arnold">

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="<?php echo $title ?>">
  <meta property="og:url" content="<?php echo $url ?>">
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?php echo $title ?>">
  <meta property="og:description" content="Le joual québécois à son meilleur. Parfois poétique, souvent drôle.">
  <meta property="og:image" content="<?php echo $opengraph ?>">
  <meta property="og:image:width" content="1200" />
  <meta property="og:image:height" content="630" />

  <!-- Twitter -->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:creator" content="@smnarnold">
  <meta property="twitter:url" content="<?php echo $url ?>">
  <meta property="twitter:title" content="<?php echo $title ?>">
  <meta property="twitter:description" content="Le joual québécois à son meilleur. Parfois poétique, souvent drôle.">
  <meta property="twitter:image" content="<?php echo $opengraph ?>">

  <link rel="stylesheet" href="/styles.css">

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-WLX8F05HW7"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-WLX8F05HW7');
  </script>
</head>
<body>
  <nav class="nav">
    <label>
      <input type="radio" name="resolution" value="standard" <?php if(!$resolution) { echo "checked"; } ?> /> Standard
    </label>
    
    <label>
      <input type="radio" name="resolution" value="hd" <?php if($resolution == "hd") { echo "checked"; } ?> /> HD
    </label>
    
    <label>
      <input type="radio" name="resolution" value="4k" <?php if($resolution == "4k") { echo "checked"; } ?> /> 4K
    </label>
  </nav>
  
  <div class="meme <?php if($resolution) { echo "is-" . $resolution; } ?>">
    <div class="cell image no1"></div>
    <div class="cell text no1">
      <?php echo $text1; ?>
    </div>
    <div class="cell image no2"></div>
    <div class="cell text no2" <?php if($img2) { echo "style='background-image: url(" . $img2 . ");'"; } ?>>
    <?php echo $text2; ?>
    </div>
  </div>
  
  <div class="source">
    <svg version="1.1" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="sauce-icon">
      <path class="st0" d="M295.27 210.58V55.9h-78.54v154.69c-23.7 13.68-39.75 39.29-39.75 68.48v197.9c0 15.09 12.35 27.44 27.44 27.44h103.17c15.09 0 27.44-12.35 27.44-27.44v-197.9c-.01-29.2-16.06-54.81-39.76-68.49z"/>
      <path class="st1" d="M216.25 476.96v-197.9c0-24.76 11.55-46.93 29.52-61.44 2.97-2.74 9.96-10.87 10.23-26.82V55.91h-39.27V210.6c-23.7 13.68-39.75 39.29-39.75 68.48v197.9c0 15.09 12.35 27.44 27.44 27.44h39.27c-15.09-.02-27.44-12.37-27.44-27.46z"/>
      <path d="M243.1 421.88l-46.62-46.62c-7.1-7.1-7.1-18.71 0-25.81l46.62-46.62c7.1-7.1 18.71-7.1 25.81 0l46.62 46.62c7.1 7.1 7.1 18.71 0 25.81l-46.62 46.62c-7.1 7.09-18.72 7.09-25.81 0z" fill="#fff"/>
      <path d="M256 297.51c-4.68 0-9.35 1.77-12.9 5.32l-46.62 46.62c-7.1 7.1-7.1 18.71 0 25.81l46.62 46.62c3.55 3.55 8.22 5.32 12.9 5.32V297.51z" fill="#eff7ff"/>
      <path class="st1" d="M304.57 284.91c-4.07 0-7.44-3.22-7.59-7.32-.51-13.94-8.45-27-20.71-34.08-3.64-2.1-4.88-6.75-2.78-10.39 2.1-3.64 6.75-4.88 10.39-2.78 16.75 9.67 27.6 27.56 28.31 46.69.15 4.2-3.12 7.72-7.32 7.88h-.3zM304.61 311.94c-4.2 0-7.6-3.4-7.6-7.6v-4.39c0-4.2 3.4-7.6 7.6-7.6s7.6 3.4 7.6 7.6v4.39c0 4.2-3.41 7.6-7.6 7.6z"/>
      <path class="st4" d="M176.99 477.37c.22 14.9 12.48 27.02 27.43 27.02h103.17c14.95 0 27.2-12.12 27.43-27.02H176.99z"/>
      <path class="st5" d="M216.49 477.37h-39.5c.22 14.9 12.48 27.02 27.43 27.02h39.5c-14.96.01-27.21-12.12-27.43-27.02z"/>
      <path class="st6" d="M275.52 7.6h-39.03c-10.87 0-19.76 8.89-19.76 19.75v59.27c0 10.87 8.89 19.75 19.76 19.75h39.03c10.87 0 19.76-8.89 19.76-19.75V27.36c-.01-10.86-8.9-19.76-19.76-19.76z"/>
      <path d="M236.48 7.6c-10.87 0-19.76 8.89-19.76 19.75v59.27c0 10.87 8.89 19.75 19.76 19.75h4.12V7.6h-4.12z" fill="#d80027"/>
      <path d="M275.52 7.6c10.87 0 19.76 8.89 19.76 19.75v59.27c0 10.87-8.89 19.75-19.76 19.75h-4.12V7.6h4.12z" fill="#720015"/>
      <path class="st1" d="M216.73 55.89h78.54v118.65h-78.54z"/>
      <path class="st6" d="M216.73 55.89H256v118.65h-39.27z"/>
      <path class="st4" d="M291.67 48.21h-71.34c-7.85 0-14.27 6.42-14.27 14.27s6.42 14.27 14.27 14.27h71.34c7.85 0 14.27-6.42 14.27-14.27s-6.42-14.27-14.27-14.27z"/>
      <path class="st5" d="M245.33 62.48c0-7.85 6.42-14.27 14.27-14.27h-39.27c-7.85 0-14.27 6.42-14.27 14.27s6.42 14.27 14.27 14.27h39.27c-7.85 0-14.27-6.42-14.27-14.27z"/>
      <path d="M302.87 206.32V81.23c6.38-3.82 10.67-10.79 10.67-18.75s-4.29-14.92-10.67-18.75V27.36C302.87 12.27 290.6 0 275.52 0h-39.03c-15.09 0-27.36 12.27-27.36 27.36v16.37c-6.38 3.83-10.67 10.79-10.67 18.75s4.29 14.92 10.67 18.75v125.09c-24.63 15.95-39.75 43.42-39.75 72.73v197.9c0 19.32 15.72 35.04 35.04 35.04h103.17c19.32 0 35.04-15.72 35.04-35.04v-197.9c-.01-29.31-15.13-56.78-39.76-72.73zm-82.54-150.5h71.34c3.67 0 6.66 2.99 6.66 6.66s-2.99 6.66-6.66 6.66h-71.34c-3.67 0-6.66-2.99-6.66-6.66s2.98-6.66 6.66-6.66zm67.34 28.53v82.6h-63.33v-82.6h63.33zm0-56.99v13.25h-39.46v-25.4h15.58v11.58c0 4.2 3.4 7.6 7.6 7.6s7.6-3.4 7.6-7.6V15.72c5.02 1.5 8.68 6.15 8.68 11.64zM233 15.72v24.89h-8.67V27.36c0-5.49 3.66-10.14 8.67-11.64zm-12.47 201.45a7.613 7.613 0 003.8-6.59v-28.43h63.33v28.43c0 2.72 1.45 5.23 3.8 6.59 22.17 12.8 35.95 36.52 35.95 61.89v76.01a25.743 25.743 0 00-6.52-11l-46.62-46.62c-4.87-4.87-11.36-7.55-18.28-7.55s-13.41 2.68-18.28 7.55l-46.62 46.62a25.743 25.743 0 00-6.52 11v-76.02c.01-25.37 13.79-49.08 35.96-61.88zm89.61 152.71l-46.62 46.62c-2 2-4.67 3.1-7.53 3.1s-5.53-1.1-7.53-3.1l-46.62-46.62c-4.15-4.15-4.15-10.9 0-15.06l46.62-46.62c2-2 4.67-3.1 7.53-3.1 2.86 0 5.53 1.1 7.53 3.1l46.62 46.62c4.16 4.16 4.15 10.91 0 15.06zm-2.56 126.91H204.42c-8.08 0-15.04-4.87-18.13-11.82h100.12c4.2 0 7.6-3.4 7.6-7.6s-3.4-7.6-7.6-7.6H184.58V369.64c1.18 4.03 3.35 7.83 6.52 11l46.62 46.62c4.87 4.87 11.36 7.55 18.28 7.55s13.41-2.68 18.28-7.55l46.62-46.62c3.17-3.17 5.34-6.97 6.52-11v100.13h-18.19c-4.2 0-7.6 3.4-7.6 7.6s3.4 7.6 7.6 7.6h16.48c-3.09 6.96-10.04 11.82-18.13 11.82z"/>
      <path class="st0" d="M293.69 362.66c0-4.58-3.74-8.31-8.35-8.31-2.25 0-4.28.9-5.78 2.34-5.69-3.74-13.38-6.12-21.9-6.43l4.66-14.67 12.62 2.96-.02.18c0 3.75 3.06 6.79 6.83 6.79 3.76 0 6.82-3.05 6.82-6.79s-3.06-6.8-6.82-6.8c-2.89 0-5.35 1.8-6.35 4.33l-13.6-3.19c-.59-.14-1.2.2-1.38.78l-5.2 16.36c-8.91.11-16.99 2.51-22.93 6.36-1.49-1.38-3.46-2.24-5.65-2.24-4.6 0-8.34 3.73-8.34 8.31 0 3.05 1.67 5.69 4.14 7.13-.16.89-.27 1.78-.27 2.69 0 12.29 15.1 22.28 33.67 22.28s33.67-10 33.67-22.28c0-.86-.09-1.71-.24-2.54 2.62-1.38 4.42-4.1 4.42-7.26zm-54.1 5.71c0-2.73 2.23-4.95 4.97-4.95s4.97 2.22 4.97 4.95-2.23 4.94-4.97 4.94-4.97-2.22-4.97-4.94zm28.46 14.66c-2.5 2.49-6.43 3.7-12.01 3.7l-.04-.01-.04.01c-5.58 0-9.51-1.21-12.01-3.7-.46-.45-.46-1.19 0-1.64.46-.46 1.2-.46 1.65 0 2.04 2.03 5.43 3.02 10.36 3.02l.04.01.04-.01c4.93 0 8.32-.99 10.36-3.02.46-.46 1.2-.45 1.65 0 .45.45.45 1.19 0 1.64zm-.59-9.72c-2.74 0-4.97-2.22-4.97-4.94 0-2.73 2.23-4.95 4.97-4.95 2.74 0 4.97 2.22 4.97 4.95-.01 2.72-2.24 4.94-4.97 4.94z"/>
    </svg>
  
    Sauce: <a class="url" target="_blank"><?php echo $source; ?></a>
  </div>
  
  <div class="buttons-bar">
    <button class="random">Nouveau mémé</button>
    <button class="download">
      <svg viewBox="0 0 29.978 29.978">
        <path fill="#000" d="M25.462 19.105v6.848H4.515v-6.848H.489v8.861c0 1.111.9 2.012 2.016 2.012h24.967c1.115 0 2.016-.9 2.016-2.012v-8.861h-4.026zM14.62 18.426l-5.764-6.965s-.877-.828.074-.828h3.248V9.217.494S12.049 0 12.793 0h4.572c.536 0 .524.416.524.416V10.424h2.998c1.154 0 .285.867.285.867s-4.904 6.51-5.588 7.193c-.492.495-.964-.058-.964-.058z"/>
      </svg>
    </button>
  </div>

  <footer class="footer">
    Envoyez moi des suggestions de mémés sur <a href="https://twitter.com/smnarnold" target="_blank">Twitter @smnarnold</a><br>ou encore mieux, envoyez moi un <a href="https://github.com/smnarnold/winnie" target="_blank">pull request direct sur GitHub</a>!
  </footer>
  
  <a class="href-download"></a>

  <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
  <script src="/script.js"></script>
</body>
</html>