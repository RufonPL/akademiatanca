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
	$course_name		= $params['course_name'];
	$course_type		= $params['course_type'];
	$course_level		= $params['course_level'];
	$course_number		= $params['course_number'];
	$course_daystimes   = $params['course_daystimes'];
	/* $course_days		= $params['course_days'];
	$course_start_time 	= $params['course_start_time'];
	$course_end_time	= $params['course_end_time']; */
	$course_start_date	= $params['course_start_date'];
	$course_end_date	= $params['course_end_date'];
	$course_place		= $params['course_place'];
	$course_instructor	= $params['course_instructor'];
	$course_price		= $params['course_price'];
	$course_payment		= $params['payment_method'];
	$client_name		= $params['client_name'];
	$client_email		= $params['client_email'];
	$client_phone		= $params['client_phone'];
	$client_info		= $params['client_info'];
}
$payment_info = $text ? '<br>'.$text : '';
?>
	<div class="em-container">
		<?php echo rfs_email_get_header(); ?>
        <div class="em-content text-center">
        <?php if($admin) : ?>
        	<h1>Nowy osoba zapisała się na kurs tańca</h1>
            <h2>Poniżej znajdują się szczegóły:</h2>
        <?php else : ?>
        	<h1>Dziękujemy za wybranie naszych kursów tańca</h1>
            <h2>Poniżej znajdują się szczegóły kursu, na który się zapisałeś/aś:</h2>
        <?php endif; ?>
            <br/>
            <table class="table table-bordered">
                <tr>
                   <td>Nazwa kursu</td>
                   <td><?php echo $course_name.' - '.$course_type.', '.$course_level; ?></td> 
                </tr>
                <tr>
                   <td>Nr kursu</td>
                   <td><?php echo $course_number; ?></td> 
                </tr>
                <!--NEW-->                                                        
                <?php //if(is_my_ip()) : ?>
                <tr>
                   <td>Dzień / Godzina kursu</td>
                   <td>
                   <?php foreach($course_daystimes as $day => $time) : ?>
                        <p class="no-margin"><?php echo $day; ?> / <?php echo $time; ?></p>
                   <?php endforeach; ?>
                   </td> 
                </tr>
                
                <?php //endif; ?>
                <!--NEW--> 
                <!--<tr>
                   <td>Dzień kursu</td>
                   <td><?php //echo $course_days; ?></td> 
                </tr>
                <tr>
                   <td>Godzina kursu</td>
                   <td><?php //echo $course_start_time.' - '.$course_end_time; ?></td> 
                </tr>
                <tr>-->
                   <td>Data trwania kursu</td>
                   <td><?php echo date('d.m', strtotime($course_start_date)).' - '.date('d.m', strtotime($course_end_date)); ?></td> 
                </tr>
                <tr>
                   <td>Miejsce kursu</td>
                   <td><?php echo $course_place; ?></td> 
                </tr>
                <tr>
                   <td>Instruktor kursu</td>
                   <td><?php echo $course_instructor; ?></td> 
                </tr>
                <tr>
                   <td>Cena kursu</td>
                   <td><?php echo $course_price; ?></td> 
                </tr>
                <tr>
                   <td>Metoda płatności</td>
                   <td><?php echo $course_payment; ?><?php echo $payment_info; ?></td> 
                </tr>
            </table>
            <br/>
            <?php if($admin) : ?>
            <h2>Dane osobowe:</h2>
            <?php else : ?>
            <h2>Twoje dane:</h2>
            <?php endif; ?>
            <table class="table table-bordered">
                <tr>
                   <td>Imię i nazwisko</td>
                   <td><?php echo $client_name; ?></td> 
                </tr>
                <tr>
                   <td>Adres email</td>
                   <td><?php echo $client_email; ?></td> 
                </tr>
                <tr>
                   <td>Nr telefonu</td>
                   <td><?php echo $client_phone; ?></td> 
                </tr>
                <?php if($client_info) : ?>
                <tr>
                   <td>Dodatkowe informacje</td>
                   <td><?php echo $client_info; ?></td> 
                </tr>
                <?php endif; ?>
            </table>
        </div><!--end em content-->
        <?php echo rfs_email_get_footer(); ?>
    </div><!--end em container-->
</body>
</html>