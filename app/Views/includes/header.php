<!DOCTYPE html>
<html lang="<?= esc($common_data["locale"], "attr") ?>">
<head>
    <?php if($common_data["custom_common_cfg"]->robots_noindex): ?>
        <meta name="robots" content="noindex">
    <?php endif; ?>
    <title><?= esc($common_data["title"]) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="/resources/style/css/style.css?v=<?= $common_data["custom_common_cfg"]->version ?>">
    <link type="text/css" rel="stylesheet" href="/resources/style/css/bootstrap.min.css">
</head>
<body class="site-main page-<?= $current_page ?> bg-dark">