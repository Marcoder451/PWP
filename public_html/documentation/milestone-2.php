<!Doctype HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>milestone-2</title>
	</head>
	<body>
<header>
	<img src="images/mobile-wireframe.png" alt="Mobile Wireframe"/>
	<img src="images/pwp-wireframe.png" alt="Desktop Wireframe"/>
		<h1>Content</h1>
</header>
		<main>
		<H3>Services</H3>


		<ul>
			<li>Studio Recording</li>


			<li>Voice Overs</li>

			<li>Music Production</li>


			<li>Post Production</li>

		</ul>

		<H3>Artist</H3>

			<ul>
			<li>Emel</li>


			<li>Rival</li>

			<li>Submissions Reviewed</li>

		</ul>

		<H3>About Us</H3>
		<ul>
			<li>Our Desire</li>
			<li></li>
			<li>Our Goal</li>
		</ul>

		<H3>Contact Us</H3>
		<ul>
			<li>Email Form</li>
			<li>From</li>
			<li>Subject line is dropdown that will populate address in “To” line</li>
			<li>email input</li>
		</ul>
		</main>

	</body>
</html>



<?php
require_once( dirname(__FILE__).'/form.lib.php' );

define( 'PHPFMG_USER', "mlester3@cnm.edu" ); // must be a email address. for sending password to you.
define( 'PHPFMG_PW', "e4975e" );

?>
<?php
/**
 * GNU Library or Lesser General Public License version 2.0 (LGPLv2)
 */

# main
# ------------------------------------------------------
error_reporting( E_ERROR ) ;
phpfmg_admin_main();
# ------------------------------------------------------




function phpfmg_admin_main(){
	$mod  = isset($_REQUEST['mod'])  ? $_REQUEST['mod']  : '';
	$func = isset($_REQUEST['func']) ? $_REQUEST['func'] : '';
	$function = "phpfmg_{$mod}_{$func}";
	if( !function_exists($function) ){
		phpfmg_admin_default();
		exit;
	};

	// no login required modules
	$public_modules   = false !== strpos('|captcha||ajax|', "|{$mod}|");
	$public_functions = false !== strpos('|phpfmg_ajax_submit||phpfmg_mail_request_password||phpfmg_filman_download||phpfmg_image_processing||phpfmg_dd_lookup|', "|{$function}|") ;
	if( $public_modules || $public_functions ) {
		$function();
		exit;
	};

	return phpfmg_user_isLogin() ? $function() : phpfmg_admin_default();
}

function phpfmg_ajax_submit(){
	$phpfmg_send = phpfmg_sendmail( $GLOBALS['form_mail'] );
	$isHideForm  = isset($phpfmg_send['isHideForm']) ? $phpfmg_send['isHideForm'] : false;

	$response = array(
		'ok' => $isHideForm,
		'error_fields' => isset($phpfmg_send['error']) ? $phpfmg_send['error']['fields'] : '',
		'OneEntry' => isset($GLOBALS['OneEntry']) ? $GLOBALS['OneEntry'] : '',
	);

	@header("Content-Type:text/html; charset=$charset");
	echo "<html><body><script>
    var response = " . json_encode( $response ) . ";
    try{
        parent.fmgHandler.onResponse( response );
    }catch(E){};
    \n\n";
	echo "\n\n</script></body></html>";

}


function phpfmg_admin_default(){
	if( phpfmg_user_login() ){
		phpfmg_admin_panel();
	};
}



function phpfmg_admin_panel()
{
	if( !phpfmg_user_isLogin() ){
		exit;
	};

	phpfmg_admin_header();
	phpfmg_writable_check();
	?>
	<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td valign=top style="padding-left:280px;">

				<style type="text/css">
					.fmg_title{
						font-size: 16px;
						font-weight: bold;
						padding: 10px;
					}

					.fmg_sep{
						width:32px;
					}

					.fmg_text{
						line-height: 150%;
						vertical-align: top;
						padding-left:28px;
					}

				</style>

				<script type="text/javascript">
					function deleteAll(n){
						if( confirm("Are you sure you want to delete?" ) ){
							location.href = "admin.php?mod=log&func=delete&file=" + n ;
						};
						return false ;
					}
				</script>


				<div class="fmg_title">
					1. Email Traffics
				</div>
				<div class="fmg_text">
					<a href="admin.php?mod=log&func=view&file=1">view</a> &nbsp;&nbsp;
					<a href="admin.php?mod=log&func=download&file=1">download</a> &nbsp;&nbsp;
					<?php
					if( file_exists(PHPFMG_EMAILS_LOGFILE) ){
						echo '<a href="#" onclick="return deleteAll(1);">delete all</a>';
					};
					?>
				</div>


				<div class="fmg_title">
					2. Form Data
				</div>
				<div class="fmg_text">
					<a href="admin.php?mod=log&func=view&file=2">view</a> &nbsp;&nbsp;
					<a href="admin.php?mod=log&func=download&file=2">download</a> &nbsp;&nbsp;
					<?php
					if( file_exists(PHPFMG_SAVE_FILE) ){
						echo '<a href="#" onclick="return deleteAll(2);">delete all</a>';
					};
					?>
				</div>

				<div class="fmg_title">
					3. Form Generator
				</div>
				<div class="fmg_text">
					<a href="http://www.formmail-maker.com/generator.php" onclick="document.frmFormMail.submit(); return false;" title="<?php echo htmlspecialchars(PHPFMG_SUBJECT);?>">Edit Form</a> &nbsp;&nbsp;
					<a href="http://www.formmail-maker.com/generator.php" >New Form</a>
				</div>
				<form name="frmFormMail" action='http://www.formmail-maker.com/generator.php' method='post' enctype='multipart/form-data'>
					<input type="hidden" name="uuid" value="<?php echo PHPFMG_ID; ?>">
					<input type="hidden" name="external_ini" value="<?php echo function_exists('phpfmg_formini') ?  phpfmg_formini() : ""; ?>">
				</form>

			</td>
		</tr>
	</table>

	<?php
	phpfmg_admin_footer();
}



function phpfmg_admin_header( $title = '' ){
header( "Content-Type: text/html; charset=" . PHPFMG_CHARSET );
?>
<html>
	<head>
		<title><?php echo '' == $title ? '' : $title . ' | ' ; ?>PHP FormMail Admin Panel </title>
		<meta name="keywords" content="PHP FormMail Generator, PHP HTML form, send html email with attachment, PHP web form,  Free Form, Form Builder, Form Creator, phpFormMailGen, Customized Web Forms, phpFormMailGenerator,formmail.php, formmail.pl, formMail Generator, ASP Formmail, ASP form, PHP Form, Generator, phpFormGen, phpFormGenerator, anti-spam, web hosting">
		<meta name="description" content="PHP formMail Generator - A tool to ceate ready-to-use web forms in a flash. Validating form with CAPTCHA security image, send html email with attachments, send auto response email copy, log email traffics, save and download form data in Excel. ">
		<meta name="generator" content="PHP Mail Form Generator, phpfmg.sourceforge.net">

		<style type='text/css'>
			body, td, label, div, span{
				font-family : Verdana, Arial, Helvetica, sans-serif;
				font-size : 12px;
			}
		</style>
	</head>
	<body  marginheight="0" marginwidth="0" leftmargin="0" topmargin="0">

		<table cellspacing=0 cellpadding=0 border=0 width="100%">
			<td nowrap align=center style="background-color:#024e7b;padding:10px;font-size:18px;color:#ffffff;font-weight:bold;width:250px;" >
				Form Admin Panel
			</td>
			<td style="padding-left:30px;background-color:#86BC1B;width:100%;font-weight:bold;" >
				&nbsp;
				<?php
				if( phpfmg_user_isLogin() ){
					echo '<a href="admin.php" style="color:#ffffff;">Main Menu</a> &nbsp;&nbsp;' ;
					echo '<a href="admin.php?mod=user&func=logout" style="color:#ffffff;">Logout</a>' ;
				};
				?>
			</td>
		</table>

		<div style="padding-top:28px;">

			<?php

			}


			function phpfmg_admin_footer(){
			?>

		</div>

		<div style="color:#cccccc;text-decoration:none;padding:18px;font-weight:bold;">
			:: <a href="http://phpfmg.sourceforge.net" target="_blank" title="Free Mailform Maker: Create read-to-use Web Forms in a flash. Including validating form with CAPTCHA security image, send html email with attachments, send auto response email copy, log email traffics, save and download form data in Excel. " style="color:#cccccc;font-weight:bold;text-decoration:none;">PHP FormMail Generator</a> ::
		</div>

	</body>
</html>
<?php
}


function phpfmg_image_processing(){
	$img = new phpfmgImage();
	$img->out_processing_gif();
}


# phpfmg module : captcha
# ------------------------------------------------------
function phpfmg_captcha_get(){
	$img = new phpfmgImage();
	$img->out();
	//$_SESSION[PHPFMG_ID.'fmgCaptchCode'] = $img->text ;
	$_SESSION[ phpfmg_captcha_name() ] = $img->text ;
}



function phpfmg_captcha_generate_images(){
	for( $i = 0; $i < 50; $i ++ ){
		$file = "$i.png";
		$img = new phpfmgImage();
		$img->out($file);
		$data = base64_encode( file_get_contents($file) );
		echo "'{$img->text}' => '{$data}',\n" ;
		unlink( $file );
	};
}


function phpfmg_dd_lookup(){
	$paraOk = ( isset($_REQUEST['n']) && isset($_REQUEST['lookup']) && isset($_REQUEST['field_name']) );
	if( !$paraOk )
		return;

	$base64 = phpfmg_dependent_dropdown_data();
	$data = @unserialize( base64_decode($base64) );
	if( !is_array($data) ){
		return ;
	};


	foreach( $data as $field ){
		if( $field['name'] == $_REQUEST['field_name'] ){
			$nColumn = intval($_REQUEST['n']);
			$lookup  = $_REQUEST['lookup']; // $lookup is an array
			$dd      = new DependantDropdown();
			echo $dd->lookupFieldColumn( $field, $nColumn, $lookup );
			return;
		};
	};

	return;
}


function phpfmg_filman_download(){
	if( !isset($_REQUEST['filelink']) )
		return ;

	$filelink =  base64_decode($_REQUEST['filelink']);
	$file = PHPFMG_SAVE_ATTACHMENTS_DIR . basename($filelink);

	// 2016-12-05:  to prevent *LFD/LFI* attack. patch provided by Pouya Darabi, a security researcher in cert.org
	$real_basePath = realpath(PHPFMG_SAVE_ATTACHMENTS_DIR);
	$real_requestPath = realpath($file);
	if ($real_requestPath === false || strpos($real_requestPath, $real_basePath) !== 0) {
		return;
	};

	if( !file_exists($file) ){
		return ;
	};

	phpfmg_util_download( $file, $filelink );
}


class phpfmgDataManager
{
	var $dataFile = '';
	var $columns = '';
	var $records = '';

	function __construct(){
		$this->dataFile = PHPFMG_SAVE_FILE;
	}

	function phpfmgDataManager(){
		$this->dataFile = PHPFMG_SAVE_FILE;
	}

	function parseFile(){
		$fp = @fopen($this->dataFile, 'rb');
		if( !$fp ) return false;

		$i = 0 ;
		$phpExitLine = 1; // first line is php code
		$colsLine = 2 ; // second line is column headers
		$this->columns = array();
		$this->records = array();
		$sep = chr(0x09);
		while( !feof($fp) ) {
			$line = fgets($fp);
			$line = trim($line);
			if( empty($line) ) continue;
			$line = $this->line2display($line);
			$i ++ ;
			switch( $i ){
				case $phpExitLine:
					continue;
					break;
				case $colsLine :
					$this->columns = explode($sep,$line);
					break;
				default:
					$this->records[] = explode( $sep, phpfmg_data2record( $line, false ) );
			};
		};
		fclose ($fp);
	}

	function displayRecords(){
		$this->parseFile();
		echo "<table border=1 style='width=95%;border-collapse: collapse;border-color:#cccccc;' >";
		echo "<tr><td>&nbsp;</td><td><b>" . join( "</b></td><td>&nbsp;<b>", $this->columns ) . "</b></td></tr>\n";
		$i = 1;
		foreach( $this->records as $r ){
			echo "<tr><td align=right>{$i}&nbsp;</td><td>" . join( "</td><td>&nbsp;", $r ) . "</td></tr>\n";
			$i++;
		};
		echo "</table>\n";
	}

	function line2display( $line ){
		$line = str_replace( array('"' . chr(0x09) . '"', '""'),  array(chr(0x09),'"'),  $line );
		$line = substr( $line, 1, -1 ); // chop first " and last "
		return $line;
	}

}
# end of class



# ------------------------------------------------------
class phpfmgImage
{
	var $im = null;
	var $width = 73 ;
	var $height = 33 ;
	var $text = '' ;
	var $line_distance = 8;
	var $text_len = 4 ;

	function __construct( $text = '', $len = 4 ){
		$this->phpfmgImage( $text, $len );
	}

	function phpfmgImage( $text = '', $len = 4 ){
		$this->text_len = $len ;
		$this->text = '' == $text ? $this->uniqid( $this->text_len ) : $text ;
		$this->text = strtoupper( substr( $this->text, 0, $this->text_len ) );
	}

	function create(){
		$this->im = imagecreate( $this->width, $this->height );
		$bgcolor   = imagecolorallocate($this->im, 255, 255, 255);
		$textcolor = imagecolorallocate($this->im, 0, 0, 0);
		$this->drawLines();
		imagestring($this->im, 5, 20, 9, $this->text, $textcolor);
	}

	function drawLines(){
		$linecolor = imagecolorallocate($this->im, 210, 210, 210);

		//vertical lines
		for($x = 0; $x < $this->width; $x += $this->line_distance) {
			imageline($this->im, $x, 0, $x, $this->height, $linecolor);
		};

		//horizontal lines
		for($y = 0; $y < $this->height; $y += $this->line_distance) {
			imageline($this->im, 0, $y, $this->width, $y, $linecolor);
		};
	}

	function out( $filename = '' ){
		if( function_exists('imageline') ){
			$this->create();
			if( '' == $filename ) header("Content-type: image/png");
			( '' == $filename ) ? imagepng( $this->im ) : imagepng( $this->im, $filename );
			imagedestroy( $this->im );
		}else{
			$this->out_predefined_image();
		};
	}

	function uniqid( $len = 0 ){
		$md5 = md5( uniqid(rand()) );
		return $len > 0 ? substr($md5,0,$len) : $md5 ;
	}

	function out_predefined_image(){
		header("Content-type: image/png");
		$data = $this->getImage();
		echo base64_decode($data);
	}

	// Use predefined captcha random images if web server doens't have GD graphics library installed
	function getImage(){
		$images = array(
			'05DB' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7GB1EQ1lDGUMdkMRYA0QaWBsdHQKQxESmAMUaAh1EkMQCWkVCQGIBSO6LWjp16dJVkaFZSO4LaGVodEWoQxETQbUDQ4w1gLUV3S2MDowh6G4eqPCjIsTiPgDJacvuMJE+PgAAAABJRU5ErkJggg==',
			'1D73' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7GB1EQ1hDA0IdkMRYHURaGRoCHQKQxEQdRBodGgIaRFD0AsXAogj3rcyatjJr6aqlWUjuA6ubwtAQgK43gAHDPEcHDLFWViCJ4pYQoJsbGFDcPFDhR0WIxX0A6lvK/VU+FJIAAAAASUVORK5CYII=',
			'1426' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7GB0YWhlCGaY6IImxOjBMZXR0CAhAEhN1YAhlbQh0EEDRy+jKABRDdt/KrKVLV63MTM1Cch+jg0grQysjinmMDqKhDlOAMuhuCcAUA2JUt4QwtLKGBqC4eaDCj4oQi/sAtAvH2tR/wuAAAAAASUVORK5CYII=',
			'FC25' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7QkMZQxmAOABJLKCBtdHR0dGBAUVMpMG1IRBDjKEh0NUByX2hUdNWrVqZGRWF5D6wulYGsGoUvVMwxRwCGB1QxYBucWAIQHUfYyhraMBUh0EQflSEWNwHAOHQzOC9gYndAAAAAElFTkSuQmCC',
			'17B1' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7GB1EQ11DGVqRxVgdGBpdGx2mIouJgsQaAkJR9TK0sjY6wPSCnbQya9W0paGrliK7D6guAEkdVIzRgbUhAE2MtQFTTKQBXa9oCFAslCE0YBCEHxUhFvcBAHxLygEuzacYAAAAAElFTkSuQmCC',
			'B389' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYUlEQVR4nGNYhQEaGAYTpIn7QgNYQxhCGaY6IIkFTBFpZXR0CAhAFmtlaHRtCHQQQVHHAFTnCBMDOyk0alXYqtBVUWFI7oOoc5gqgmFeQAMWMTQ7MN2Czc0DFX5UhFjcBwBUsM0z9CuBWAAAAABJRU5ErkJggg==',
			'7343' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nGNYhQEaGAYTpIn7QkNZQxgaHUIdkEVbRVoZWh0dAlDEgKqmOjSIIItNAYoGOjQEILsvalXYysyspVlI7mN0YGhlbYSrA0PWBoZG19AAFPOA7EaHRlQ7gCqANqO6JaABi5sHKPyoCLG4DwC/Rc2UF2hCgAAAAABJRU5ErkJggg==',
			'5958' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAeUlEQVR4nGNYhQEaGAYTpIn7QkMYQ1hDHaY6IIkFNLC2sjYwBASgiIk0ujYwOoggiQUGAMWmwtWBnRQ2benS1MysqVnI7mtlDHRoCEAxj6GVodGhIRDFvIBWFqAdqGIiU1hbGR0dUPSyBjCGMIQyoLh5oMKPihCL+wADAcyxUJvKGwAAAABJRU5ErkJggg==',
			'7608' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7QkMZQximMEx1QBZtZW1lCGUICEARE2lkdHR0EEEWmyLSwNoQAFMHcVPUtLClq6KmZiG5j9FBtBVJHRiyNog0ujYEopgnAhRzRLMjoAHTLQENWNw8QOFHRYjFfQB/IsvOOyRNngAAAABJRU5ErkJggg==',
			'48B8' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXUlEQVR4nGNYhQEaGAYTpI37pjCGsIYyTHVAFgthbWVtdAgIQBJjDBFpdG0IdBBBEmOdgqIO7KRp01aGLQ1dNTULyX0BUzDNCw3FNI9hCjYxTL1Y3TxQ4Uc9iMV9AALmzP74acqDAAAAAElFTkSuQmCC',
			'AE12' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7GB1EQxmmMEx1QBJjDRBpYAhhCAhAEhOZItLAGMLoIIIkFtAK5E0ByiG5L2rp1LBV04A0kvug6hqR7QgNBYu1MmCaNwWLWACqmGgoY6hjaMggCD8qQizuAwCM2sv9gzi/8QAAAABJRU5ErkJggg==',
			'F359' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7QkNZQ1hDHaY6IIkFNIi0sjYwBASgiDE0ujYwOoigirWyToWLgZ0UGrUqbGlmVlQYkvtA6oDkVDS9jQ4gmzDsCECzQ6SV0dEBzS2sIQyhDChuHqjwoyLE4j4ARYbNLDW0H8wAAAAASUVORK5CYII=',
			'1CCB' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXUlEQVR4nGNYhQEaGAYTpIn7GB0YQxlCHUMdkMRYHVgbHR0CHQKQxEQdRBpcGwSBJLJekQZWIBmA5L6VWdNWLV21MjQLyX1o6lDE0M3DtAOLW0Iw3TxQ4UdFiMV9ABX8yO4umq8iAAAAAElFTkSuQmCC',
			'B901' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYklEQVR4nGNYhQEaGAYTpIn7QgMYQximMLQiiwVMYW1lCGWYiiLWKtLo6OgQiqpOpNEVKIPsvtCopUtTV0UtRXZfwBTGQCR1UPMYGjHFWEB2YHMLihjUzaEBgyD8qAixuA8ANFTN183iWqgAAAAASUVORK5CYII=',
			'2852' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAeUlEQVR4nM2QsRGAMAhFQ8EGGSgW9hTBwg10ClKwgXEDCzOl2OFpqXdCxb/P5x2h3UrCn/oTPiTIyKkmp8UFFSUQOY00ll4gRb+t5qvm93zrPmzT3EbPR6iWUPwNS7KZ9MIi5w1avBYFFbpEXmOGHBg4/+B/L/YD3wGs9cu+K6hi9QAAAABJRU5ErkJggg==',
			'38DF' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAV0lEQVR4nGNYhQEaGAYTpIn7RAMYQ1hDGUNDkMQCprC2sjY6OqCobBVpdG0IRBUDqUOIgZ20Mmpl2NJVkaFZyO5DVYfbPCxi2NwCdTOq3gEKPypCLO4DABRLymnfDDcpAAAAAElFTkSuQmCC',
			'30ED' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWklEQVR4nGNYhQEaGAYTpIn7RAMYAlhDHUMdkMQCpjCGsDYwOgQgq2xlbQWJiSCLTRFpdEWIgZ20MmraytTQlVnTkN2Hqg5qHjYxTDuwuQWbmwcq/KgIsbgPAFA2yeTOk9I2AAAAAElFTkSuQmCC',
			'8A5B' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7WAMYAlhDHUMdkMREpjCGsDYwOgQgiQW0sraCxERQ1Ik0uk6FqwM7aWnUtJWpmZmhWUjuA6lzaAhEM080FCQmgiIGNA9NDKTX0dERRS9rANC8UEYUNw9U+FERYnEfAOSvzEMCGleSAAAAAElFTkSuQmCC',
			'111A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAX0lEQVR4nGNYhQEaGAYTpIn7GB0YAhimMLQii7E6MAYwhDBMdUASE3VgDWAMYQgIwNDL6CCC5L6VWauiVk1bmTUNyX1o6pDFQkNwm4dTTDSENZQx1BFFbKDCj4oQi/sAJjDFuMqIAMUAAAAASUVORK5CYII=',
			'6FAA' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7WANEQx2mMLQii4lMEWlgCGWY6oAkFtAi0sDo6BAQgCzWINLA2hDoIILkvsioqWFLV0VmTUNyX8gUFHUQva1AsdDA0BB0MTR1Ilj0sgZgig1U+FERYnEfAJ/uzJZojluEAAAAAElFTkSuQmCC',
			'E4B3' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYklEQVR4nGNYhQEaGAYTpIn7QkMYWllDGUIdkMQCGhimsjY6OgSgioWyAkkRFDFGV9ZGh4YAJPeFRi1dujR01dIsJPcBdbUiqYOKiYa6YpgHdAs2MTS3YHPzQIUfFSEW9wEA7JPOc5SP4S4AAAAASUVORK5CYII=',
			'7B4E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZ0lEQVR4nGNYhQEaGAYTpIn7QkNFQxgaHUMDkEVbRVoZWh0dGFDFGh2moolNAaoLhItB3BQ1NWxlZmZoFpL7GB1EWlkbUfWyNog0uoYGooiJAMUc0NQFNADtwBDD4uYBCj8qQizuAwCvFMsdTRxj2AAAAABJRU5ErkJggg==',
			'4765' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcklEQVR4nM2QsQ2AQAhFoWAD3QcKe0ykuWmwcIPzNrDQKbXk1FKT+797geTlw/GIQ0v9xy/3xoamkU0wiwjHO7zY4DWjDAs5Dhz8SjnKtu4pBT/NoCTsXfg1QybXikEmJx+5Zp2jsOqNgcHKLez3XV/8TqvZyyU1uu38AAAAAElFTkSuQmCC',
			'352C' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdUlEQVR4nGNYhQEaGAYTpIn7RANEQxlCGaYGIIkFTBFpYHR0CBBBVtkq0sDaEOjAgiw2RSSEASiG7L6VUVOXrlqZmYXivikMjQ6tjA4oNrcCxaagi4k0OgQwotgRMIUVpBPFLaIBjCGsoQEobh6o8KMixOI+ACFDyoD4eyRuAAAAAElFTkSuQmCC',
			'2160' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nGNYhQEaGAYTpIn7WAMYAhhCGVqRxUSmMAYwOjpMdUASC2hlDWBtcAgIQNbdygAUY3QQQXbftFVRS6euzJqG7D6gHayOjjB1YMjoANIbiCLG2gASC0CxAyiP4ZbQUNZQdDcPVPhREWJxHwBFackYlJahVAAAAABJRU5ErkJggg==',
			'CBAD' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpIn7WENEQximMIY6IImJtIq0MoQyOgQgiQU0ijQ6Ojo6iCCLAVWyNgTCxMBOilo1NWzpqsisaUjuQ1MHE2t0DUUTA9rhiqYO5BaQXmS3gNwMFENx80CFHxUhFvcBAJVBzMIZ2q3FAAAAAElFTkSuQmCC',
			'7337' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7QkNZQxhDGUNDkEVbRVpZGx0aRFDEGIAiAahiU2CiSO6LWhW2auqqlVlI7mN0AKtrRbaXtQGscwqymAhELABZDGgj0C2ODqhiYDejiA1U+FERYnEfAKmxzHVKSQ8iAAAAAElFTkSuQmCC',
			'98DF' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXElEQVR4nGNYhQEaGAYTpIn7WAMYQ1hDGUNDkMREprC2sjY6OiCrC2gVaXRtCEQTA6pDiIGdNG3qyrClqyJDs5Dcx+qKog4CsZgngEUMm1ugbkY1b4DCj4oQi/sADVzKUOjOyUsAAAAASUVORK5CYII=',
			'A5F9' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nM2QsRGAMAhFScEGuE8aewqxcBos2MCMkCZTalJhtNRTfvfu4L8DymUU/pRX/EIcBIVTdAyZFBWYHaOtshDJMTaaHGtKS045S1lm58cG66iQ/K5IY9rdq6zrQOtd2MLRCyfnr/73YG78dp8UzBACkuw/AAAAAElFTkSuQmCC',
			'12CC' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZ0lEQVR4nGNYhQEaGAYTpIn7GB0YQxhCHaYGIImxOrC2MjoEBIggiYk6iDS6Ngg6sKDoZQCKAUkk963MWrV0KYhEch9QxRRWhDqYWACmGKMDK4YdIFVobgkRDXVAc/NAhR8VIRb3AQDlrsfvbct3TQAAAABJRU5ErkJggg==',
			'A311' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZ0lEQVR4nGNYhQEaGAYTpIn7GB1YQximMLQii7EGiLQyhDBMRRYTmcLQ6BjCEIosFtAK1IfQC3ZS1NJVYaumrVqK7D40dWAYGsrQ6IAmBlSHRUwEQ29AK2sIY6hDaMAgCD8qQizuAwCZXcwpKj85/gAAAABJRU5ErkJggg==',
			'C740' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcklEQVR4nGNYhQEaGAYTpIn7WENEQx0aHVqRxURaGYAiDlMdkMQCGoFiUx0CApDFGhhaGQIdHUSQ3Be1atW0lZmZWdOQ3AdUF8DaCFcHFWN0YA0NRBVrZG0A2oJih0irSAPYZhQ3g8VQ3DxQ4UdFiMV9APrEzYGrHRwSAAAAAElFTkSuQmCC',
			'E2A4' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7QkMYQximMDQEIIkFNLC2MoQyNKKKiTQ6Ojq0oooxNLo2BEwJQHJfaNSqpUtXRUVFIbkPKD+FtSHQAU1vAGtoYGgIihijAyuQRHNLA7pYaIhoqCua2ECFHxUhFvcBAFUWz7RAZICrAAAAAElFTkSuQmCC',
			'F4F2' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7QkMZWllDA6Y6IIkFNDBMZW1gCAhAFQtlbWB0EEERY3QFqmsQQXJfaNTSpUtDV62KQnJfQINIK1BdI6odoqGuDQytDKh2gNRNwSIWgCnGGBoyCMKPihCL+wDDSMyhhW7YAAAAAABJRU5ErkJggg==',
			'7904' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nGNYhQEaGAYTpIn7QkMZQximMDQEIIu2srYyhDI0ooqJNDo6OrSiiE0RaXRtCJgSgOy+qKVLU1dFRUUhuY/RgTHQtSHQAVkvawMDUG9gaAiSmEgDC8gOFLcENIDdgiaGxc0DFH5UhFjcBwAWmc3S2G7NHwAAAABJRU5ErkJggg==',
			'6FDB' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYElEQVR4nGNYhQEaGAYTpIn7WANEQ11DGUMdkMREpog0sDY6OgQgiQW0AMUaAh1EkMUaIGIBSO6LjJoatnRVZGgWkvtCpqCog+htxWIeFjFsbmENAIqhuXmgwo+KEIv7AL1VzKKqR3/gAAAAAElFTkSuQmCC',
			'21CC' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7WAMYAhhCHaYGIImJTGEMYHQICBBBEgtoZQ1gbRB0YEHW3coAFGN0QHHftFVRS1etzEJxXwCKOjAE8jDEWBsYMOwAugHDLaGhrKHobh6o8KMixOI+AAauyArJXUaCAAAAAElFTkSuQmCC',
			'149B' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7GB0YWhlCGUMdkMRYHRimMjo6OgQgiYk6MISyNgQ6iKDoZXQFiQUguW9l1tKlKzMjQ7OQ3MfoINLKEBKIYh6jgyjQTnTzGFoZsYmhuyUE080DFX5UhFjcBwC+58fuKdNDKwAAAABJRU5ErkJggg==',
			'F2B7' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7QkMZQ1hDGUNDkMQCGlhbWRsdGkRQxEQaXUEkihhDoytQXQCS+0KjVi1dGrpqZRaS+4DyU4DmtTKg6g1gbQiYgirG6AAUC0AVY21gbXR0QBUTDXUNZUQRG6jwoyLE4j4AfK/Ny2FBXvAAAAAASUVORK5CYII=',
			'14BE' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7GB0YWllDGUMDkMRYHRimsjY6OiCrE3VgCGVtCHRA1cvoiqQO7KSVWUuXLg1dGZqF5D5GB5FWdPMYHURDXTHMA7oFmxi6W0Iw3TxQ4UdFiMV9ACmxx3hlVYG8AAAAAElFTkSuQmCC',
			'A5EA' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbklEQVR4nGNYhQEaGAYTpIn7GB1EQ1lDHVqRxVgDRBpYGximOiCJiUwBiwUEIIkFtIqEsAJNEEFyX9TSqUuXhq7MmobkvoBWhkZXhDowDA0Fi4WGoJqHoS6glbWVFUOMMYQ11BFFbKDCj4oQi/sANJXLjFyoE94AAAAASUVORK5CYII=',
			'9C3B' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXElEQVR4nGNYhQEaGAYTpIn7WAMYQ0HQAUlMZApro2ujo0MAklhAq0iDQ0OggwiaGANCHdhJ06ZOW7Vq6srQLCT3sbqiqINAkF408wSw2IHNLdjcPFDhR0WIxX0AzpnMmpWMg4sAAAAASUVORK5CYII=',
			'4F74' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpI37poiGuoYGNAQgi4WIAMmARmQxRohYK7IY6xSgWKPDlAAk902bNjVs1dJVUVFI7gsAqZvC6ICsNzQUKBbAGBqC4haRBkYHBlS3AMVYG4gQG6jwox7E4j4ARg3NuKL3IwMAAAAASUVORK5CYII=',
			'1CEC' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWUlEQVR4nGNYhQEaGAYTpIn7GB0YQ1lDHaYGIImxOrA2ujYwBIggiYk6iDS4AlWzoOgVaWAFksjuW5k1bdXS0JVZyO5DU4dXDNMOLG4JwXTzQIUfFSEW9wEAJ3PIMOtuilkAAAAASUVORK5CYII=',
			'07AE' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7GB1EQx2mMIYGIImxBjA0OoQyOiCrE5nC0Ojo6IgiFtDK0MraEAgTAzspaumqaUtXRYZmIbkPqC4ASR1UjNGBNTQQzQ7WBnR1rAEiGGKMDmAxFDcPVPhREWJxHwCMbsosM2iKtAAAAABJRU5ErkJggg==',
			'861B' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpIn7WAMYQximMIY6IImJTGFtZQhhdAhAEgtoFWlkBIqJoKgD8qbA1YGdtDRqWtiqaStDs5DcJzJFtBVJHdw8hymo5mETA7sFTS/IzYyhjihuHqjwoyLE4j4AdeDK+Lz0SPcAAAAASUVORK5CYII=',
			'7555' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7QkNFQ1lDHUMDkEVbRRpYGxgdGAiJTREJYZ3K6OqA7L6oqUuXZmZGRSG5D6ir0aEhoEEESS9rA6aYSINIo2tDoAOyWEADayujo0NAAIoYYwhDKMNUh0EQflSEWNwHALN4y1AIN6myAAAAAElFTkSuQmCC',
			'C772' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nGNYhQEaGAYTpIn7WENEQ11DA6Y6IImJtDI0OjQEBAQgiQU0gsQCHUSQxRoYwCpFkNwXtWrVtFVLwTTcfUB1AQxTQCqR9TI6AEVbGVDsYAWJTmFAcYtIAytIP4qbQWKMoSGDIPyoCLG4DwCU88zdmpbZEAAAAABJRU5ErkJggg==',
			'BF22' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7QgNEQx1CGaY6IIkFTBFpYHR0CAhAFmsVaWBtCHQQQVMHJBtEkNwXGjU1bNXKrFVRSO4Dq2tlaHRAM49hClAUXSwAKIruFgegKIqbgW4JDQwNGQThR0WIxX0AxJnNS+itj/QAAAAASUVORK5CYII=',
			'5C3E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXklEQVR4nGNYhQEaGAYTpIn7QkMYQ0EwAEksoIG10bXR0YEBRUykwaEhEEUsMECkgQGhDuyksGnTVq2aujI0C9l9rSjqEGJo5gW0YtohMgXTLawBmG4eqPCjIsTiPgDN+cu9TT5axQAAAABJRU5ErkJggg==',
			'C6AD' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7WEMYQximMIY6IImJtLK2MoQyOgQgiQU0ijQyOjo6iCCLNYg0sDYEwsTATopaNS1s6arIrGlI7gtoEG1FUgfT2+gaiiYGtMMVTR3ILSC9yG4BuRkohuLmgQo/KkIs7gMA3E/MObbGEswAAAAASUVORK5CYII=',
			'CE98' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZUlEQVR4nGNYhQEaGAYTpIn7WENEQxlCGaY6IImJtIo0MDo6BAQgiQU0ijSwNgQ6iCCLNYDEAmDqwE6KWjU1bGVm1NQsJPeB1DGEBKCaBxJDNw9oByOaGDa3YHPzQIUfFSEW9wEAQ+fMQbsIgOYAAAAASUVORK5CYII=',
			'4308' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpI37prCGMExhmOqALBYi0soQyhAQgCTGGMLQ6Ojo6CCCJMY6haGVtSEApg7spGnTVoUtXRU1NQvJfQGo6sAwNJSh0bUhEMU8oDsw7GCYgukWrG4eqPCjHsTiPgCzi8vupFKWNAAAAABJRU5ErkJggg==',
			'9D2B' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nGNYhQEaGAYTpIn7WANEQxhCGUMdkMREpoi0Mjo6OgQgiQW0ijS6NgQ6iKCJOQDFApDcN23qtJVZKzNDs5Dcx+oKVNfKiGIeA0jvFEYU8wRAYgGoYmC3OKDqBbmZNTQQxc0DFX5UhFjcBwBgWstknaVF3gAAAABJRU5ErkJggg==',
			'B1F7' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXklEQVR4nGNYhQEaGAYTpIn7QgMYAlhDA0NDkMQCpjAGsAJpEWSxVlZMsSkMYLEAJPeFRq2KWhq6amUWkvug6loZUMwDi03BIhbAgGEHowOqm1lD0cUGKvyoCLG4DwAweMpNR5m7sAAAAABJRU5ErkJggg==',
			'C61A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7WEMYQximMLQii4m0srYyhDBMdUASC2gUaQSqDAhAFmsQaWCYwuggguS+qFXTwlZNW5k1Dcl9AQ2irUjqYHobHaYwhoag2eGApg7sFjQxkJsZQx1RxAYq/KgIsbgPABZsy0n26lFCAAAAAElFTkSuQmCC',
			'C5E6' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7WENEQ1lDHaY6IImJtIo0sDYwBAQgiQU0gsQYHQSQxRpEQkBiyO6LWjV16dLQlalZSO4DmtPo2sCIah5EzEEE1Q4MMZFW1lZ0t7CGMIagu3mgwo+KEIv7AI1gy79N+MJhAAAAAElFTkSuQmCC',
			'4405' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nM2QMQ6AIAxFPwM3wPvAwF4TO8hpWLhB9QYsnFLdKjpqQv/28pu+FO0xGSPlHz9BgRgmzRZsYON1zywnCeHGrJho8xy98tv3WmtbU1J+JK7YTNmpXeaJY8cul+tGz8Ag6plg8yP877u8+B3xhsq57EupIwAAAABJRU5ErkJggg==',
			'011E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAX0lEQVR4nGNYhQEaGAYTpIn7GB0YAhimMIYGIImxBjAGMIQAZZDERKYARdHEAlrBemFiYCdFLV0VtWraytAsJPehqcMpJjIFU4w1AFOM0YE1lDHUEcXNAxV+VIRY3AcAFy/Gm0tA1v4AAAAASUVORK5CYII=',
			'2CF8' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7WAMYQ1lDA6Y6IImJTGFtdG1gCAhAEgtoFWlwbWB0EEHWDRRjRaiDuGnatFVLQ1dNzUJ2XwCKOjAEmcSKZh5rA6YdQFUYbgkNBbq5gQHFzQMVflSEWNwHAKWey7B8gqqlAAAAAElFTkSuQmCC',
			'D904' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZ0lEQVR4nGNYhQEaGAYTpIn7QgMYQximMDQEIIkFTGFtZQhlaEQRaxVpdHR0aEUXcwWqDkByX9TSpUtTV0VFRSG5L6CVMdC1IdABVS8DUG9gaAiKGAvIDmxuQRHD5uaBCj8qQizuAwCsHs/GLVsaiQAAAABJRU5ErkJggg==',
			'99D4' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7WAMYQ1hDGRoCkMREprC2sjY6NCKLBbSKNLoCSSxiUwKQ3Ddt6tKlqauioqKQ3Mfqyhjo2hDogKyXoZUBqDcwNARJTKCVBWQeNregiGFz80CFHxUhFvcBAI/xztP5mvmwAAAAAElFTkSuQmCC',
			'090A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7GB0YQximMLQii7EGsLYyhDJMdUASE5ki0ujo6BAQgCQW0CrS6NoQ6CCC5L6opUuXpq6KzJqG5L6AVsZAJHVQMQaQ3tAQFDtYgHY4oqiDuIURRQziZlSxgQo/KkIs7gMACYHLGSpsxpEAAAAASUVORK5CYII=',
			'7ABC' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7QkMZAlhDGaYGIIu2MoawNjoEiKCIsbayNgQ6sCCLTRFpdG10dEBxX9S0lamhK7OQ3cfogKIODFkbRENdgeYhi4k0ANWh2REAEkNzC1gM3c0DFH5UhFjcBwACGcxzEhDGZwAAAABJRU5ErkJggg==',
			'105B' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7GB0YAlhDHUMdkMRYHRhDWIEyAUhiog6srSAxERS9Io2uU+HqwE5amTVtZWpmZmgWkvtA6hwaAlHMg4mhmgeyA12MMYTR0RHVLSEMAQyhjChuHqjwoyLE4j4A0FXH8g0ek88AAAAASUVORK5CYII=',
			'85B6' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7WANEQ1lDGaY6IImJTBFpYG10CAhAEgtoBYo1BDoIoKoLYW10dEB239KoqUuXhq5MzUJyn8gUhkbXRkc084BiQPNEUO3AEBOZwtqK7hbWAMYQdDcPVPhREWJxHwAUI80BO5FbEwAAAABJRU5ErkJggg==',
			'21EE' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXElEQVR4nGNYhQEaGAYTpIn7WAMYAlhDHUMDkMREpjAGsDYwOiCrC2hlxRBjaGVAFoO4adqqqKWhK0OzkN0XwIChF8jDEGNtwBQTwSIWGsoaiu7mgQo/KkIs7gMA+AnGZiEb/XMAAAAASUVORK5CYII=',
			'0636' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7GB0YQxhDGaY6IImxBrC2sjY6BAQgiYlMEWlkaAh0EEASC2gVaWBodHRAdl/U0mlhq6auTM1Ccl9Aq2grUB2KeUC9jQ5A80TQ7EAXw+YWbG4eqPCjIsTiPgDSZMwERvT9EAAAAABJRU5ErkJggg==',
			'378D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7RANEQx1CGUMdkMQCpjA0Ojo6OgQgq2xlaHRtCHQQQRabwtDKCFQnguS+lVGrpq0KXZk1Ddl9UxgCkNRBzWN0YEU3r5W1AV0sYIpIAyOaW0QDgCrQ3DxQ4UdFiMV9AFMPypb3U09qAAAAAElFTkSuQmCC',
			'E6E0' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXklEQVR4nGNYhQEaGAYTpIn7QkMYQ1hDHVqRxQIaWFtZGximOqCIiTQCxQICUMUaWBsYHUSQ3BcaNS1saejKrGlI7gtoEG1FUgc3zxWrGLodmG7B5uaBCj8qQizuAwB88MyAXNc6hQAAAABJRU5ErkJggg==',
			'66D1' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7WAMYQ1hDGVqRxUSmsLayNjpMRRYLaBFpZG0ICEURaxBpAIrB9IKdFBk1LWzpqqilyO4LmSLaiqQOordVpNGVCDGoW1DEoG4ODRgE4UdFiMV9AGvIzVNbMZuwAAAAAElFTkSuQmCC',
			'FD0C' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAVUlEQVR4nGNYhQEaGAYTpIn7QkNFQximMEwNQBILaBBpZQhlCBBBFWt0dHR0YEETc20IdEB2X2jUtJWpqyKzkN2Hpg6vGBY7sLgF080DFX5UhFjcBwB0W81AzO5WOgAAAABJRU5ErkJggg==',
			'2198' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7WAMYAhhCGaY6IImJTGEMYHR0CAhAEgtoZQ1gbQh0EEHW3coAFAuAqYO4adqqqJWZUVOzkN0HsiMkAMU8RgegGJp5rECVjGhiIiAxNLeEhrKGort5oMKPihCL+wCRy8lLADXsQwAAAABJRU5ErkJggg==',
			'3D15' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpIn7RANEQximMIYGIIkFTBFpZQhhdEBR2SrS6IguNkWk0WEKo6sDkvtWRk1bmTVtZVQUsvvA6hgaRNDMwy7G6CCC7pYpDAHI7gO5mTHUYarDIAg/KkIs7gMARrnLtxc9eqIAAAAASUVORK5CYII=',
			'13A5' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbklEQVR4nGNYhQEaGAYTpIn7GB1YQximMIYGIImxOoi0MoQyOiCrE3VgaHR0dHRA1cvQytoQ6OqA5L6VWavClq6KjIpCch9EXUCDCKreRtdQLGINgQ6oYiIgvQHI7hMNYQ0Bik11GAThR0WIxX0ABVTJUlqfMkUAAAAASUVORK5CYII=',
			'03F7' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYklEQVR4nGNYhQEaGAYTpIn7GB1YQ1hDA0NDkMRYA0RaWYG0CJKYyBSGRlc0sYBWBrC6ACT3RS1dFbY0dNXKLCT3QdW1MqDqBZk3hQHTjgBkMYhbGB0w3IwmNlDhR0WIxX0AdAfKjNRxbvIAAAAASUVORK5CYII=',
			'7B85' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7QkNFQxhCGUMDkEVbRVoZHR0dGFDFGl0bAlHFpoDVuToguy9qatiq0JVRUUjuY3QAqXNoEEHSy9oAMi8ARUykAWIHshhQBUhvQACKGMjNDFMdBkH4URFicR8AwW/LXu+4foYAAAAASUVORK5CYII=',
			'4BFF' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWklEQVR4nGNYhQEaGAYTpI37poiGsIYGhoYgi4WItLI2MDogq2MMEWl0RRNjnYKiDuykadOmhi0NXRmaheS+gCmY5oWGYprHMAWrGIZesJvRxQYq/KgHsbgPAGXnyR2GuKoeAAAAAElFTkSuQmCC',
			'3652' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAc0lEQVR4nGNYhQEaGAYTpIn7RAMYQ1hDHaY6IIkFTGFtZW1gCAhAVtkq0sjawOgggiw2RaSBdSpDgwiS+1ZGTQtbmpm1KgrZfVNEW4GmNjqgmefQENDKgCbmCrSdAc0tjI4OAehuZghlDA0ZBOFHRYjFfQDQ9MvmWVeaCAAAAABJRU5ErkJggg==',
			'BBFC' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAW0lEQVR4nGNYhQEaGAYTpIn7QgNEQ1hDA6YGIIkFTBFpZW1gCBBBFmsVaXRtYHRgwVDH6IDsvtCoqWFLQ1dmIbsPTR2KedjEMO1AdQvYzQ0MKG4eqPCjIsTiPgBwk8xbTlHMugAAAABJRU5ErkJggg==',
			'A0F0' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZUlEQVR4nGNYhQEaGAYTpIn7GB0YAlhDA1qRxVgDGENYGximOiCJiUxhbQWKBQQgiQW0ijS6Ak0QQXJf1NJpK1NDV2ZNQ3IfmjowDA3FFAtoxWYHpluArg0AiqG4eaDCj4oQi/sAKG/Ln/ONGE0AAAAASUVORK5CYII=',
			'825E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7WAMYQ1hDHUMDkMREprC2sjYwOiCrC2gVaXRFExOZwtDoOhUuBnbS0qhVS5dmZoZmIbkPqG4KQ0MgmnkMAZhijA6saGJAtzQwOjqiiLEGiIY6hDKiuHmgwo+KEIv7AH3kyf50BM5xAAAAAElFTkSuQmCC',
			'840F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7WAMYWhmmMIaGIImJTGGYyhDK6ICsLqAVKOLoiCImMoXRlbUhECYGdtLSqKVLl66KDM1Ccp/IFJFWJHVQ80RDXTHEGFox7WBoRXcL1M0oYgMVflSEWNwHAK08yVKCeKq6AAAAAElFTkSuQmCC',
			'5D28' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdElEQVR4nGNYhQEaGAYTpIn7QkNEQxhCGaY6IIkFNIi0Mjo6BASgijW6NgQ6iCCJBQaINDo0BMDUgZ0UNm3ayqyVWVOzkN3XClTXyoBiHlhsCiOKeQEgsQBUMZEpQLc4oOplDRANYQ0NQHHzQIUfFSEW9wEAS9/M3msIGaYAAAAASUVORK5CYII=',
			'6344' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7WANYQxgaHRoCkMREpoi0MrQ6NCKLBbQAVU11aEURa2BoZQh0mBKA5L7IqFVhKzOzoqKQ3BcyhaGVtdHRAUVvK0Oja2hgaAiamAM2t6CJYXPzQIUfFSEW9wEA3RDPM7iPJaYAAAAASUVORK5CYII=',
			'6514' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nM3QwQ2AMAhAUTh0A9ynI3CgBzsNTewG6AZeOqWNp7Z61CjcXkLyA5TLKPxpX+lzPAUwUG6MjBQEUmu8kKJA7kxJ6q1x0zfHdS9bibHpE4PkDX13m08L0hlVG1tcHvsco2DwnX31vwf3pu8ALv/N8mHIg5AAAAAASUVORK5CYII=',
			'A966' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7GB0YQxhCGaY6IImxBrC2Mjo6BAQgiYlMEWl0bXB0EEASC2gFiTE6ILsvaunSpalTV6ZmIbkvoJUx0NXREcW80FAGoN5ABxEU81iwiGG6BWgehpsHKvyoCLG4DwAx48yGgce0GgAAAABJRU5ErkJggg==',
			'D64E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYUlEQVR4nGNYhQEaGAYTpIn7QgMYQxgaHUMDkMQCprC2MrQ6OiCrC2gVaWSYiiHWwBAIFwM7KWrptLCVmZmhWUjuC2gVbWVtxDTPNTQQQ8wBXR3ILWhi2Nw8UOFHRYjFfQCLtsyIfjTwmgAAAABJRU5ErkJggg==',
			'7FB6' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYElEQVR4nGNYhQEaGAYTpIn7QkNFQ11DGaY6IIu2ijSwNjoEBKCLNQQ6CCCLTQGpc3RAcV/U1LCloStTs5Dcx+gAVodiHmsDxDwRJDERLGIBDZhuAYuhu3mAwo+KEIv7ACgLzErcJvUJAAAAAElFTkSuQmCC',
			'D285' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdElEQVR4nM2Quw2AMAxE7SIbhH3sgt5IuMk0TpENwggUZEpSmk8JUnzd6U5+OmiPMxhJv/Cp4AqKKs6TGgoyk89JiXm25eZBZuaZHF/a2970SMnx9VxFJovXrgSTm4cU+o94ZbHeFc+nMikpbDTAfh/qhe8ExMTMyj6BYX4AAAAASUVORK5CYII=',
			'970B' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7WANEQx2mMIY6IImJTGFodAhldAhAEgtoZWh0dHR0EEEVa2VtCISpAztp2tRV05auigzNQnIfqytDAJI6CGxldACJIZsnADSNEc0OkSlAHppbWAOAYmhuHqjwoyLE4j4AxjbK2AIsUSsAAAAASUVORK5CYII=',
			'CEAE' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7WENEQxmmMIYGIImJtIo0MIQyOiCrC2gUaWB0dEQVaxBpYG0IhImBnRS1amrY0lWRoVlI7kNThxALDcSwA10dyC3oYiA3A8VQ3DxQ4UdFiMV9ACaFysg7mqMqAAAAAElFTkSuQmCC',
			'15AB' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7GB1EQxmmMIY6IImxOog0MIQyOgQgiYkCxRgdHUEySHpFQlgbAmHqwE5amTV16dJVkaFZSO5jdGBodEWoQ4iFBqKbB1aHKsbayoqmVzSEEWQvipsHKvyoCLG4DwBOyclltI6v5QAAAABJRU5ErkJggg==',
			'841E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7WAMYWhmmMIYGIImJTGGYyhDC6ICsLqCVIZQRTUxkCqMrUC9MDOykpVFLl66atjI0C8l9IlNEWpHUQc0TDXXAEGPAUAd0C4YYyM2MoY4obh6o8KMixOI+AHOoyVYScG8jAAAAAElFTkSuQmCC',
			'DEE2' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXElEQVR4nGNYhQEaGAYTpIn7QgNEQ1lDHaY6IIkFTBFpYG1gCAhAFmsFiTE6iGCIMTSIILkvaunUsKWhQBrJfVB1jQ6YelsZMMWmMGBxC6abHUNDBkH4URFicR8ATYHNAW5HevsAAAAASUVORK5CYII=',
			'84E8' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZUlEQVR4nGNYhQEaGAYTpIn7WAMYWllDHaY6IImJTGGYytrAEBCAJBbQyhDK2sDoIIKijtEVSR3YSUujli5dGrpqahaS+0SmiLRimica6opmHtCOVkw7GDD0YnPzQIUfFSEW9wEATLXLhwryCC0AAAAASUVORK5CYII=',
			'191C' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7GB0YQximMEwNQBJjdWBtZQhhCBBBEhN1EGl0DGF0YEHRK9LoMIXRAdl9K7OWLs2atjIL2X1AOwKR1EHFGBoxxVjAYqh2AN0yBc0tIYwhjKEOKG4eqPCjIsTiPgDW8sgE6Z5T8QAAAABJRU5ErkJggg==',
			'F657' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7QkMZQ1hDHUNDkMQCGlhbWYG0CIqYSCMWsQbWqSAa4b7QqGlhSzOzVmYhuS+gQbQVSLYyoJnn0BAwBV3MtSEggAHNLYyOjg6oYowhDKGMKGIDFX5UhFjcBwAyDczdjlisEAAAAABJRU5ErkJggg==',
			'2232' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdUlEQVR4nM2QsQ2AMAwEnSIbmH3MBkaKG6ZJimyQsAGNpyQRBUZQghR/d/JbJ4M+JsJI+cXPswtOoJJhWHz2iZgN44yJ4kJo2xkSNYrWb9Ndq+pq/RjKuXl1HTXart5cOo1cLMNGu4tlIpPM4iQM8L8P8+J3ANNczJecRgIHAAAAAElFTkSuQmCC',
			'8FF6' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWklEQVR4nGNYhQEaGAYTpIn7WANEQ11DA6Y6IImJTBFpYG1gCAhAEgtoBYkxOghgqGN0QHbf0qipYUtDV6ZmIbkPqg6reSIExLC5hTUALIbi5oEKPypCLO4DACLry1MUykyWAAAAAElFTkSuQmCC'
		);
		$this->text = array_rand( $images );
		return $images[ $this->text ] ;
	}

	function out_processing_gif(){
		$image = dirname(__FILE__) . '/processing.gif';
		$base64_image = "R0lGODlhFAAUALMIAPh2AP+TMsZiALlcAKNOAOp4ANVqAP+PFv///wAAAAAAAAAAAAAAAAAAAAAAAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFCgAIACwAAAAAFAAUAAAEUxDJSau9iBDMtebTMEjehgTBJYqkiaLWOlZvGs8WDO6UIPCHw8TnAwWDEuKPcxQml0Ynj2cwYACAS7VqwWItWyuiUJB4s2AxmWxGg9bl6YQtl0cAACH5BAUKAAgALAEAAQASABIAAAROEMkpx6A4W5upENUmEQT2feFIltMJYivbvhnZ3Z1h4FMQIDodz+cL7nDEn5CH8DGZhcLtcMBEoxkqlXKVIgAAibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkphaA4W5upMdUmDQP2feFIltMJYivbvhnZ3V1R4BNBIDodz+cL7nDEn5CH8DGZAMAtEMBEoxkqlXKVIg4HibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpjaE4W5tpKdUmCQL2feFIltMJYivbvhnZ3R0A4NMwIDodz+cL7nDEn5CH8DGZh8ONQMBEoxkqlXKVIgIBibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpS6E4W5spANUmGQb2feFIltMJYivbvhnZ3d1x4JMgIDodz+cL7nDEn5CH8DGZgcBtMMBEoxkqlXKVIggEibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpAaA4W5vpOdUmFQX2feFIltMJYivbvhnZ3V0Q4JNhIDodz+cL7nDEn5CH8DGZBMJNIMBEoxkqlXKVIgYDibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpz6E4W5tpCNUmAQD2feFIltMJYivbvhnZ3R1B4FNRIDodz+cL7nDEn5CH8DGZg8HNYMBEoxkqlXKVIgQCibbK9YLBYvLtHH5K0J0IACH5BAkKAAgALAEAAQASABIAAAROEMkpQ6A4W5spIdUmHQf2feFIltMJYivbvhnZ3d0w4BMAIDodz+cL7nDEn5CH8DGZAsGtUMBEoxkqlXKVIgwGibbK9YLBYvLtHH5K0J0IADs=";
		$binary = is_file($image) ? join("",file($image)) : base64_decode($base64_image);
		header("Cache-Control: post-check=0, pre-check=0, max-age=0, no-store, no-cache, must-revalidate");
		header("Pragma: no-cache");
		header("Content-type: image/gif");
		echo $binary;
	}

}
# end of class phpfmgImage
# ------------------------------------------------------
# end of module : captcha


# module user
# ------------------------------------------------------
function phpfmg_user_isLogin(){
	return ( isset($_SESSION['authenticated']) && true === $_SESSION['authenticated'] );
}


function phpfmg_user_logout(){
	session_destroy();
	header("Location: admin.php");
}

function phpfmg_user_login()
{
	if( phpfmg_user_isLogin() ){
		return true ;
	};

	$sErr = "" ;
	if( 'Y' == $_POST['formmail_submit'] ){
		if(
			defined( 'PHPFMG_USER' ) && strtolower(PHPFMG_USER) == strtolower($_POST['Username']) &&
			defined( 'PHPFMG_PW' )   && strtolower(PHPFMG_PW) == strtolower($_POST['Password'])
		){
			$_SESSION['authenticated'] = true ;
			return true ;

		}else{
			$sErr = 'Login failed. Please try again.';
		}
	};

	// show login form
	phpfmg_admin_header();
	?>
	<form name="frmFormMail" action="" method='post' enctype='multipart/form-data'>
		<input type='hidden' name='formmail_submit' value='Y'>
		<br><br><br>

		<center>
			<div style="width:380px;height:260px;">
				<fieldset style="padding:18px;" >
					<table cellspacing='3' cellpadding='3' border='0' >
						<tr>
							<td class="form_field" valign='top' align='right'>Email :</td>
							<td class="form_text">
								<input type="text" name="Username"  value="<?php echo $_POST['Username']; ?>" class='text_box' >
							</td>
						</tr>

						<tr>
							<td class="form_field" valign='top' align='right'>Password :</td>
							<td class="form_text">
								<input type="password" name="Password"  value="" class='text_box'>
							</td>
						</tr>

						<tr><td colspan=3 align='center'>
								<input type='submit' value='Login'><br><br>
								<?php if( $sErr ) echo "<span style='color:red;font-weight:bold;'>{$sErr}</span><br><br>\n"; ?>
								<a href="admin.php?mod=mail&func=request_password">I forgot my password</a>
							</td></tr>
					</table>
				</fieldset>
			</div>
			<script type="text/javascript">
				document.frmFormMail.Username.focus();
			</script>
	</form>
	<?php
	phpfmg_admin_footer();
}


function phpfmg_mail_request_password(){
	$sErr = '';
	if( $_POST['formmail_submit'] == 'Y' ){
		if( strtoupper(trim($_POST['Username'])) == strtoupper(trim(PHPFMG_USER)) ){
			phpfmg_mail_password();
			exit;
		}else{
			$sErr = "Failed to verify your email.";
		};
	};

	$n1 = strpos(PHPFMG_USER,'@');
	$n2 = strrpos(PHPFMG_USER,'.');
	$email = substr(PHPFMG_USER,0,1) . str_repeat('*',$n1-1) .
		'@' . substr(PHPFMG_USER,$n1+1,1) . str_repeat('*',$n2-$n1-2) .
		'.' . substr(PHPFMG_USER,$n2+1,1) . str_repeat('*',strlen(PHPFMG_USER)-$n2-2) ;


	phpfmg_admin_header("Request Password of Email Form Admin Panel");
	?>
	<form name="frmRequestPassword" action="admin.php?mod=mail&func=request_password" method='post' enctype='multipart/form-data'>
		<input type='hidden' name='formmail_submit' value='Y'>
		<br><br><br>

		<center>
			<div style="width:580px;height:260px;text-align:left;">
				<fieldset style="padding:18px;" >
					<legend>Request Password</legend>
					Enter Email Address <b><?php echo strtoupper($email) ;?></b>:<br />
					<input type="text" name="Username"  value="<?php echo $_POST['Username']; ?>" style="width:380px;">
					<input type='submit' value='Verify'><br>
					The password will be sent to this email address.
					<?php if( $sErr ) echo "<br /><br /><span style='color:red;font-weight:bold;'>{$sErr}</span><br><br>\n"; ?>
				</fieldset>
			</div>
			<script type="text/javascript">
				document.frmRequestPassword.Username.focus();
			</script>
	</form>
	<?php
	phpfmg_admin_footer();
}


function phpfmg_mail_password(){
	phpfmg_admin_header();
	if( defined( 'PHPFMG_USER' ) && defined( 'PHPFMG_PW' ) ){
		$body = "Here is the password for your form admin panel:\n\nUsername: " . PHPFMG_USER . "\nPassword: " . PHPFMG_PW . "\n\n" ;
		if( 'html' == PHPFMG_MAIL_TYPE )
			$body = nl2br($body);
		mailAttachments( PHPFMG_USER, "Password for Your Form Admin Panel", $body, PHPFMG_USER, 'You', "You <" . PHPFMG_USER . ">" );
		echo "<center>Your password has been sent.<br><br><a href='admin.php'>Click here to login again</a></center>";
	};
	phpfmg_admin_footer();
}


function phpfmg_writable_check(){

	if( is_writable( dirname(PHPFMG_SAVE_FILE) ) && is_writable( dirname(PHPFMG_EMAILS_LOGFILE) )  ){
		return ;
	};
	?>
	<style type="text/css">
		.fmg_warning{
			background-color: #F4F6E5;
			border: 1px dashed #ff0000;
			padding: 16px;
			color : black;
			margin: 10px;
			line-height: 180%;
			width:80%;
		}

		.fmg_warning_title{
			font-weight: bold;
		}

	</style>
	<br><br>
	<div class="fmg_warning">
		<div class="fmg_warning_title">Your form data or email traffic log is NOT saving.</div>
		The form data (<?php echo PHPFMG_SAVE_FILE ?>) and email traffic log (<?php echo PHPFMG_EMAILS_LOGFILE?>) will be created automatically when the form is submitted.
		However, the script doesn't have writable permission to create those files. In order to save your valuable information, please set the directory to writable.
		If you don't know how to do it, please ask for help from your web Administrator or Technical Support of your hosting company.
	</div>
	<br><br>
	<?php
}


function phpfmg_log_view(){
	$n = isset($_REQUEST['file'])  ? $_REQUEST['file']  : '';
	$files = array(
		1 => PHPFMG_EMAILS_LOGFILE,
		2 => PHPFMG_SAVE_FILE,
	);

	phpfmg_admin_header();

	$file = $files[$n];
	if( is_file($file) ){
		if( 1== $n ){
			echo "<pre>\n";
			echo join("",file($file) );
			echo "</pre>\n";
		}else{
			$man = new phpfmgDataManager();
			$man->displayRecords();
		};


	}else{
		echo "<b>No form data found.</b>";
	};
	phpfmg_admin_footer();
}


function phpfmg_log_download(){
	$n = isset($_REQUEST['file'])  ? $_REQUEST['file']  : '';
	$files = array(
		1 => PHPFMG_EMAILS_LOGFILE,
		2 => PHPFMG_SAVE_FILE,
	);

	$file = $files[$n];
	if( is_file($file) ){
		phpfmg_util_download( $file, PHPFMG_SAVE_FILE == $file ? 'form-data.csv' : 'email-traffics.txt', true, 1 ); // skip the first line
	}else{
		phpfmg_admin_header();
		echo "<b>No email traffic log found.</b>";
		phpfmg_admin_footer();
	};

}


function phpfmg_log_delete(){
	$n = isset($_REQUEST['file'])  ? $_REQUEST['file']  : '';
	$files = array(
		1 => PHPFMG_EMAILS_LOGFILE,
		2 => PHPFMG_SAVE_FILE,
	);
	phpfmg_admin_header();

	$file = $files[$n];
	if( is_file($file) ){
		echo unlink($file) ? "It has been deleted!" : "Failed to delete!" ;
	};
	phpfmg_admin_footer();
}


function phpfmg_util_download($file, $filename='', $toCSV = false, $skipN = 0 ){
	if (!is_file($file)) return false ;

	set_time_limit(0);


	$buffer = "";
	$i = 0 ;
	$fp = @fopen($file, 'rb');
	while( !feof($fp)) {
		$i ++ ;
		$line = fgets($fp);
		if($i > $skipN){ // skip lines
			if( $toCSV ){
				$line = str_replace( chr(0x09), ',', $line );
				$buffer .= phpfmg_data2record( $line, false );
			}else{
				$buffer .= $line;
			};
		};
	};
	fclose ($fp);



	/*
		 If the Content-Length is NOT THE SAME SIZE as the real conent output, Windows+IIS might be hung!!
	*/
	$len = strlen($buffer);
	$filename = basename( '' == $filename ? $file : $filename );
	$file_extension = strtolower(substr(strrchr($filename,"."),1));

	switch( $file_extension ) {
		case "pdf": $ctype="application/pdf"; break;
		case "exe": $ctype="application/octet-stream"; break;
		case "zip": $ctype="application/zip"; break;
		case "doc": $ctype="application/msword"; break;
		case "xls": $ctype="application/vnd.ms-excel"; break;
		case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
		case "gif": $ctype="image/gif"; break;
		case "png": $ctype="image/png"; break;
		case "jpeg":
		case "jpg": $ctype="image/jpg"; break;
		case "mp3": $ctype="audio/mpeg"; break;
		case "wav": $ctype="audio/x-wav"; break;
		case "mpeg":
		case "mpg":
		case "mpe": $ctype="video/mpeg"; break;
		case "mov": $ctype="video/quicktime"; break;
		case "avi": $ctype="video/x-msvideo"; break;
		//The following are for extensions that shouldn't be downloaded (sensitive stuff, like php files)
		case "php":
		case "htm":
		case "html":
			$ctype="text/plain"; break;
		default:
			$ctype="application/x-download";
	}


	//Begin writing headers
	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Cache-Control: public");
	header("Content-Description: File Transfer");
	//Use the switch-generated Content-Type
	header("Content-Type: $ctype");
	//Force the download
	header("Content-Disposition: attachment; filename=".$filename.";" );
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: ".$len);

	while (@ob_end_clean()); // no output buffering !
	flush();
	echo $buffer ;

	return true;


}
?>

