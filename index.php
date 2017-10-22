<?php
$user = $_GET['id'];
include 'functions.php';
$data = yt_details($user);
$data2 = yt_recent($data['channelId']);
?>
<html lang="en">
<head>
    <title><?php echo $data['channel'];?>'s YouTube profile card</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="ytcard.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro|Merriweather" rel="stylesheet">
</head>
<body>
<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <div class="well bg">
                <?php
                echo "<a href='https://youtube.com/".$data['channel']."'><h1 class='name'>" . $data['channel'] . "</h1></a>
                    <img src='" . $data['avatar'] . "' class='img-circle avatar' height='122' width='122'>
                    <h3 class='desc'>" . $data['description'] . "</h3>
                    <h3 class='stat'>" . number_format($data['subs'], 0, ',', ',') . " Subs</h3>
                    <h3 class='stat'>" . number_format($data['videos'], 0, ',', ',') . " Videos</h3>
                    <h3 class='stat'>" . number_format($data['views'], 0, ',', ',') . " Views</h3>
                    <h3 class='stat'>" . number_format($data['comments'], 0, ',', ',') . " Comments</h3>
                    <h3 class='stat'>Created ".$data['startDateFormatted']."</h3>
                    <h3>Latest Video</h3>
                    <div class='embed-responsive embed-responsive-16by9'><iframe class='embed-responsive-item' src='".$data2['videoLinkEmbed']."'></iframe></div><br>
                    <h4 class='tag'>".$data2['tag']."</h4> <h4 class='tag'>".$data2['tag1']."</h4> <h4 class='tag'>".$data2['tag2']."</h4> <h4 class='tag'>".$data2['tag3']."</h4>
                    "; ?>
            </div>
        </div>
            <div class='col-lg-3'></div>
        </div>
    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        $(".well").mouseenter(
            function(){
                $(this).css({'background':'url("<?php echo $data['bannerMed'];?>")', 'background-size':'contain', 'background-repeat':'repeat-y', 'box-shadow': 'inset 0 0 0 1000px rgba(255, 255, 255, 0.25),8px 10px 20px 2px #000000'});
            });

        $(".well").mouseleave(
            function(){
                $(this).css({'background-color':'rgba(240, 45, 33, 0.81)', 'background-image':'url("")', 'box-shadow': '8px 10px 20px 2px #000000'});
            });
    </script>
</body>
</html>
