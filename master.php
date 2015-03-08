<script src="js/jquery-2.1.3.js"></script>
<script src="js/jquery-1.11.2.js"></script>

<script type="text/javascript">

    function display_c(){
        var refresh=10000; // Refresh rate in milli seconds
        mytime=setTimeout('display_ct()',refresh)
    }

    function display_ct() {
        var strcount
        var x = new Date()
        document.getElementById('ct').innerHTML = ' Its ct - ' + x;
        tt=display_c();
    }
/*
    function getStatus() {
        var x = new Date()
        //$('#ct').load('getstatus.php');
        document.getElementById('bt').innerHTML = x;
        setTimeout(getStatus,25000);

    }
*/

</script>

<script  type="text/javascript">

    $(document).ready(function() {
       alert('hi');
        function getStatus() {

            var x = new Date();
            //$('#ct').load('getstatus.php');
            $('#bt').html(' its bt - ' + x);
            setTimeout(getStatus,10000);

        }

        getStatus();


    });

</script>

<?php
/**
 * Created by PhpStorm.
 * User: zakir
 * Date: 3/6/15
 * Time: 1:13 AM
 */
/* onload=display_ct();*/
?>
<body onload=display_ct();>
<span id='ct' ></span>
<br/>
<span id='bt' ></span>

</body>