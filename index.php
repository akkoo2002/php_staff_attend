<?php include "header.php"  ?>
<style>

    .bg {
    animation:slide 3s ease-in-out infinite alternate;
    background-image: linear-gradient(-60deg, #6c3 50%, #09f 50%);
    bottom:0;
    left:-50%;
    opacity:.5;
    position:fixed;
    right:-50%;
    top:0;
    z-index:-1;
    }

    .bg2 {
    animation-direction:alternate-reverse;
    animation-duration:4s;
    }

    .bg3 {
    animation-duration:5s;
    }

    .content {
    background-color:rgba(255,255,255,.8);
    border-radius:.25em;
    box-shadow:0 0 .25em rgba(0,0,0,.25);
    box-sizing:border-box;
    left:50%;
    padding:10vmin;
    position:fixed;
    text-align:center;
    top:50%;
    transform:translate(-50%, -50%);
    }

    h1 {
    font-family:monospace;
    }

    @keyframes slide {
    0% {
        transform:translateX(-25%);
    }
    100% {
        transform:translateX(25%);
    }
    }

</style>
<div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>
    <h1>Welcome to:</h1>
    <h2>Staff Attendance portal</h2>
    <hr/>
    <br><br>
    <h3>In this poratal administrator can </h3>
    Add new staff with user id and password
    <br> Will confirm the staff attendance applied
    <br> can see the monthly report for attendance
    <br><br>
    <br><br>
    <h3>In this poratal staff can </h3>
    Login to the portal with id created by admin
    <br> and apply for his attendance to be approved by admin

<?php include "footer.php"  ?>