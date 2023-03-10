<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<!--title>404 HTML Template by Colorlib</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Nunito:400,700" rel="stylesheet">

</head>

<body>

	<div id="notfound" style="min-width: 75%;">
		<div class="notfound">
			<div class="notfound-404"></div>
			<div>
				<h1>404</h1>
				<h2>Content Not Found</h2>
				<p>Sorry but the file you are looking for does not exist, have been removed. name changed or is temporarily unavailable</p>
				<a href="https://www.ranrom.xyz">Back to homepage</a>
			</div>
		</div>
	</div>
</body>
<style>
* {
  -webkit-box-sizing: border-box;
          box-sizing: border-box;
          
}

body {
  padding: 0;
  margin: 0;
  resize:none;
  /*background-color:#36393f;*/
}

#notfound {
  position: relative;
  height: 100vh;
}

#notfound .notfound {
  position: absolute;
  left: 50%;
  top: 50%;
  -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
}

.notfound {
  max-width: 560px;
  width: 100%;
  padding-left: 160px;
  line-height: 1.1;
}

.notfound .notfound-404 {
  position: absolute;
  left: 0;
  top: 0;
  display: inline-block;
  width: 160px;
  height: 160px;
  background-image: url('/img/ed9aab4a-1279-40ad-a672-ba54b045c008.webp');
  background-repeat: no-repeat;
  background-size: cover;
}

.notfound .notfound-404:before {
  content: '';
  position: absolute;
  width: 100%;
  height: 100%;
  left: -30px;
  bottom: -15px;
  -webkit-transform: scale(2.4);
      -ms-transform: scale(2.4);
          transform: scale(2.4);
  border-radius: 50%;
  background-color: #f2f5f8;
  z-index: -2;
}

.notfound h1 {
  font-family: 'Nunito', sans-serif;
  font-size: 65px;
  font-weight: 700;
  margin-top: -25px;
  margin-bottom: 10px;
  /*color: #151723;*/

  text-transform: uppercase;
}

.notfound h2 {
  font-family: 'Nunito', sans-serif;
  font-size: 21px;
  font-weight: 400;
  margin: 0;
  text-transform: uppercase;
  color: #151723;
}

.notfound p {
  font-family: 'Nunito', sans-serif;
  color: #999fa5;
  font-weight: 400;
}

.notfound a {
  font-family: 'Nunito', sans-serif;
  display: inline-block;
  font-weight: 700;
  border-radius: 40px;
  text-decoration: none;
  color: #388dbc;
}

.notfound i {
  font-family: 'Nunito', sans-serif;
  font-weight: 0;
  border-radius: 40px;
  text-decoration: none;
  /*color: #388dbc*/;
}

@media only screen and (max-width: 767px) {
  .notfound .notfound-404 {
    width: 180px;
    height: 180px;
    top: -100px;
    left: 00px;
  }
  .notfound {
    padding-left: 15px;
    padding-right: 15px;
    padding-top: 110px;
    bottom: 50px;
  }
}
</style>
</html>
