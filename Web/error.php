<html>
<meta charset="utf8">
<title>
Trang bạn đang tìm không tồn tại
</title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script>
		setTimeout(function () {
		   window.location.href = "/user/login"; 
		}, 4000); //will call the function after 2 secs.
		
		
		//Calls countdown function
		var count = 3;
		countdown(count);

		//counts to 3,2, 1 and redirect
		function countdown(timer) {
			//Keeps the interval ID for later clear
			var intervalID;
			intervalID = setInterval(function () {

				display(timer);
				timer = timer - 1;

				if (timer < 0) {
					//Clears the timeout 
					clearTimeout(intervalID);
				}
			}, 1000);


		}

		//Modifies the countdown display
		function display(timer) {
			document.getElementById("number").innerHTML = timer;
		}
		
		
		
		</script>
		<style>
		#main {
		    height: 100vh;
		}
	
		</style>
		<div class="page-wrap d-flex flex-row align-items-center" id="main">
		    <div class="container">
		        <div class="row justify-content-center">
		            <div class="col-md-12 text-center">
		                <span class="display-1 d-block">Oops!</span>
		                <div class="mb-4 lead">Vui lòng đăng nhập để tiếp tục, tự động chuyển trang sau <span id="number"></span>!</div>

		                <a href="/user/login" class="btn btn-link">Tới trang đăng nhập</a>
		            </div>
		        </div>
		    </div>
		</div>
</html>