<html>
<script type="text/javascript">

function doPost() {
var form = document.forms[0];
form.action = "<?=$targetUrl;?>"; //測試環 form.submit();
}
</script>
<body>
    <form action="<?=$targetUrl;?>" method="post">
        <?php 
            foreach ($Data as $key => $value){
                echo '<input type="text" id="'.$key .'" name="'.$key .'" value="'.$Data[$key].'">';
            }
        ?>
        <button onclick="doPost();">送出</button>
    </form>
</body>
</html>