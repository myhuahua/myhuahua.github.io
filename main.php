<?php 
	// 通过对cookie的判断来验证用户之前是否登陆过
	if($_COOKIE['isLogin'] !=true){
		header("location:./login.php");
	}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .time {
            width: 350px;
            height: 40px;
            font-size: 30px;
            color: blueviolet;
            margin: 100px auto;
        }
        #top,#down{
            position: fixed;
            top: 150px;
            
            width: 300px;
            height: 300px;
            transform: scale(0.95);
        }

        #top:before,#top:after{
            content: "";
            position: absolute;
            top: 40px;
            width: 150px;
            height: 240px;
            background-color: pink;
            border-radius: 150px 150px 0 0;
            transform: rotate(-45deg);
            transform-origin: 0 100%;
        }

        #top:before,#down:before{
            left: 150px;
        }
        #top:after,#down:after{
            left: 0;
            transform: rotate(45deg);
            transform-origin: 100% 100%;
        }
        #top:after{
            box-shadow: inset -6px -6px 0px 6px rgba(255,255,255,0.3);
        }
        #top:before{
            box-shadow: inset 6px 6px 0px 6px rgba(255,255,255,0.3);
        }
        #top i:after{
            content: "";
            position: absolute;
            top: 35%;
            left: 15%;
            z-index: 10;
            font-size:30px;
            font-weight: 100;
            color: rgba(255,255,255,0.8);
            text-shadow: -1px -1px 0px rgba(0,0,0,0.2);
        }
        #top,#down{
            animation :topbeat .7s infinite;
            animation-timing-function: cubic-bezier(0,0,0,1.74);

        }
        #down{
            animation-name:down;
        }
        @keyframes topbeat{
            0%{transform: scale(0.95);}
            50%{transform: scale(1);}
            100%{transform: scale(0.95);}

        }
        @keyframes down{
            0%{
                opacity: 0.1;
                transform: scale(1);
            }
            100%{
                opacity: 1;
                transform: scale(1.5);
            }
        }
    </style>
</head>
<body>
	<a href="./login.php">离开</a>
<div id="time" class="time">
    <span id="days">00天</span>
    <span id="hours">00时</span>
    <span id="minutes">00分</span>
    <span id="seconds">00秒</span>
</div>
<div id="top">
    <i></i>
</div>
<div id="down"></div>
<script type="text/javascript">
    setInterval(getTimer, 1000);
    function getTimer() {
        var date1 = "2019/01/01 19:35:00"; //开始时间
        var date2 = new Date(); //结束时间
        var date3 = date2.getTime() - new Date(date1).getTime(); //时间差的毫秒数

        //计算出相差天数
        var days = Math.floor(date3 / (24 * 3600 * 1000));

        //计算出小时数

        var leave1 = date3 % (24 * 3600 * 1000); //计算天数后剩余的毫秒数
        var hours = Math.floor(leave1 / (3600 * 1000));
        //计算相差分钟数
        var leave2 = leave1 % (3600 * 1000); //计算小时数后剩余的毫秒数
        var minutes = Math.floor(leave2 / (60 * 1000));
        //计算相差秒数
        var leave3 = leave2 % (60 * 1000); //计算分钟数后剩余的毫秒数
        var seconds = Math.round(leave3 / 1000);
        hours = hours < 10 ? "0" + hours : hours;
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
        document.getElementById("days").innerHTML = days + "天";
        document.getElementById("hours").innerHTML = hours + "时";
        document.getElementById("minutes").innerHTML = minutes + "分";
        document.getElementById("seconds").innerHTML = seconds + "秒";
    }
    getTimer();
</script>
</body>
</html>