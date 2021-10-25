<?php
	require_once('../lib/functions.php');

	$d = initializeApp('streamline');	
	$ni = sizeof($d['items']);
	$iu = array($ni);	
?>

<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./style/main.css" />
    <link rel="stylesheet" href="./style/home.css" />
    <link
      href="https://fonts.googleapis.com/css?family=Philosopher"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Montserrat"
      rel="stylesheet"
    />
    <title>Home</title>
  </head>
  <body>
    <div class="home">
      <div class="navbar"></div>
      <div class="hero">
        <div class="hero__left">
          <div class="heading">Khám phá Việt Nam qua những bức tranh</div>
          <div class="btn">Tham quan ngay</div>
        </div>
        <div class="hero__right">
          <div class="hero-image"></div>
        </div>
      </div>
      <div class="category">
        <div class="heading">Các dòng tranh tiêu biểu</div>
        <div class="carousel">
          <div class="list" id="carousel">
          <?php
            for($i=0;$i<$ni;$i++){
              $avatar = $d['items'][$i]['avatar'];
              $title = $d['items'][$i]['title'];
              $decs = $d['items'][$i]['description'];
              $link 	= "url('".(fetchItemData($avatar))."')";
              $active = "";

              if ($i == 0) {
                $active ="active";
              }

              echo '<div class="item '.($active).'" idx="0"><div class="item-txt"><div class="title">'.($title).'</div><div class="description">'.($decs).'</div><div class="more">Xem thêm</div></div><div class="item-img"><div style="background-image:'.($link)'" class="img"></div></div></div>'      
            }
          ?>
            <!--div class="item active" idx="0">
              <div class="item-txt">
                <div class="title">Tranh Đông Hồ</div>
                <div class="description">
                  aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
                </div>
                <div class="more">Xem thêm</div>
              </div>
              <div class="item-img">
                <div
                  style="background-image: url('../assets/img.png')"
                  class="img"
                ></div>
              </div>
            </div-->
          </div>
          <div class="utils-btn">
            <div class="btn-1 prev" id="prev"></div>
            <div class="btn-1 next" id="next"></div>
          </div>
        </div>
      </div>
    </div>
  </body>
  <script src="./lib/jquery.js"></script>
  <script src="./js/slide.js"></script>
</html>
