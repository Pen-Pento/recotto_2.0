<?php
    define('DB_DATABASE', 'recotto');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'recotto');
    define('PDO_DSN', 'mysql:dbhost=localhost;dbname=' . DB_DATABASE);


    try{
        $db = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>Recotto</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <section id="selectionmain">
        <div id="leftcontents">
            <img src="images/lp_icon_pink.png">
            <h1>ようこそRecottoへ！</h1>
            <form action="function.php" method="post" id="selection">
                <select id="area">
                    <option value="" disabled selected style='display:none;'>どこへ行くの？</option>
                    <option value="yokohama">横浜で</option>
                </select>
                <select required name="genre" id="genre">
                    <option value="" disabled selected style='display:none;'>どんな感じがいい？</option>
                    <option value="アクティブ">アクティブに！</option>
                    <option value="ゆっくり">ゆっくりしたい〜</option>
                </select>
                <select required name="spot_count" id="spot_count">
                    <option value="" disabled selected style='display:none;'>どれくらいの時間？</option>
                    <option value="halfday">半日くらい</option>
                    <option value="oneday">1日中</option>
                </select>
                <button id="btn">デートを見てみる！</button>
            </form>
        </div>
        <div id="rightcontents">
            <img src="images/selection_pair.png">
        </div>
    </section>
</body>

</html>
