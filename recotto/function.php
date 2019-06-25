<?php
//ini_set('display_errors', "On");
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
//require_once('index.php');
$genre = $_POST['genre'];
$count = $_POST['spot_count'];
//$spot  = $_POST['spot'];
//$where = "AND where spot_name="."'".$spot."'";
//var_dump($genre); //''帰ってくる
//var_dump($count);


if($count ==="oneday") {
    $spot_count = 4;
}elseif($count ==="halfday") {
    $spot_count = 2;
}

if($genre === '') {
    echo "<script>alert('雰囲気を選んでください')</script>";
}

if($spot_count === NULL) {
    echo "<script>alert('デートの長さを選んでください')</script>";
}

//if($genre )

//var_dump($spot_count);

$sql = 'SELECT spot_name, url FROM Spots where spot_genre='."'".$genre."'".' ORDER BY RAND() '.'limit '.$spot_count;
//var_dump($sql);
    $query = $db->query($sql);
    /*for ($i=0;$i<=count($query);$i++) {
    var_dump($query[$i][1]);
    }*/
//var_dump($query);
$i = 1;
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>Recotto</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
   <a href="./index.php">＜＜もう一回</a>
    <div id="result">
        <ul id="spots-list">
            <?php foreach($query as $value): ?>
                <li value="<?php echo $value[spot_name]; ?>"><a href="<?php echo $value[url]; ?>" id="<?php echo "spot".$i; ?>" target="_blank"><?php echo $value[spot_name]; ?></a></li>
            <?php $i++; ?>
            <?php endforeach; ?>
        </ul>
        <div id="map"></div>
    </div>
    
<script>
function initMap() {
    window.onload = function() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: 35.460080,
                lng: 139.632458
            },
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        var DS = new google.maps.DirectionsService();
        var DR = new google.maps.DirectionsRenderer();
        DR.setMap(map);
        //document.getElementById("btn").onclick = function() {
        //この中にルート検索のためのJSを記入
            //var from = document.getElementById('from').innerHTML;
            //var to   = document.getElementById('to').innerHTML;
            //console.log(from);
            var wayPoints = new Array();
            var spots = document.getElementById("spots-list");
            var spotCount = spots.childElementCount;
            console.log(spotCount);
            for(var i=1;i<=spotCount;i++) {
                wayPoints.push({location: document.getElementById('spot'+i).innerHTML});
            }
        
            var request = {
                origin: '桜木町駅',
                destination: 'みなとみらい駅',
                optimizeWaypoints: true,
                waypoints: wayPoints,
                travelMode: google.maps.TravelMode.WALKING   
            };
            DS.route(request, function(result, status) {
            DR.setDirections(result);
            });
        //}
    }
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQSmbuereuAj2IGZi5FgEo-xj5ZF4nAJk&callback=initMap" async defer></script>
</body>
</html>
