<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
<title><?php wp_title('|', true, 'right'); ?></title>
</head>
<style>
@import url(https://fonts.googleapis.com/css?family=Lato:400,300,100,700,900&subset=latin,latin-ext);

body {font-family:'Lato',sans-serif; background-color:#fff; color:#333; font-size:15px; line-height:24px;}
h1,h2,h3,h4,h5,h6,.h1,.h2,.h3,.h4,.h5,.h6 {font-family: 'Lato', Arial, Helvetica, cursive, sans-serif; font-family: ; line-height:1.2; color:inherit; font-weight:normal; margin:5px 0;}
h1{font-size:24px;}
h2{font-size:18px;}
h3{font-size:16px;}
h4{font-size:14px;}
.text-center{text-align:center;}
p{line-height:20px; margin:0;}
a{color:#f73a36;}
.em-header{border:solid 2px #00192d; color:#00192d; padding:10px;}
.em-header a{color:#00192d;}
.em-header a:hover,.em-header a:focus{color:#FFF; text-decoration:none;}
.em-container{width:700px; padding:10px; box-shadow:0 0 4px #ccc;}
.em-content{border:solid 2px #00192d; margin-top:10px; padding:10px;}
.em-footer{padding:10px; margin-top:10px;}
.table td {padding-right:20px;}
</style>
<body>
<?php 
if($params) { 
	$new_password = $params['new_password'];
}
?>
	<div class="em-container">
		<?php echo rfs_email_get_header(); ?>
        <div class="em-content text-center">
        	<h1>Twoje hasło zostało zresetowane</h1>
            <h2>Poniżej znajdują się szczegóły:</h2>
            <br/>
            <table class="table table-bordered">
                <tr>
                   <td>Nowe hasło</td>
                   <td><?php echo esc_html($new_password); ?></td> 
                </tr>
            </table>
        </div><!--end em content-->
        <?php echo rfs_email_get_footer(); ?>
    </div><!--end em container-->
</body>
</html>