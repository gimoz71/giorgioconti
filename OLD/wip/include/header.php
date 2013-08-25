<?php /*?><link rel="stylesheet" href="../css/style_<?php echo $tipo;?>.css" type="text/css" media="screen"/><?php */?>
<link rel="stylesheet" href="../css/style_<?php echo $tipo;?>.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="../css/utility.css" type="text/css" media="screen"/>
<style>
span.reference {
	position:fixed;
	right:10px;
	bottom:10px;
	font-size:14px;
	z-index: 5;
	color:#ccc;
}
span.reference a {
	color:#fff;
	text-transform:uppercase;
	text-decoration:none;
	text-shadow:1px 1px 1px #000;
	margin-left:20px;
}
span.reference a:hover {
	color:#ddd;
}
</style>
<script type="text/javascript" src="../js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="../js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="../fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="../fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="../fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
	$(document).ready(function() {
		$("#news, #biografia, #contatti, #video").fancybox({
			'titlePosition'		: 'inside',
			'transitionIn'		: 'fade',
			'transitionOut'		: 'fade',
			'padding'			: '20',
			'height'        	: 500,
			'width'         	: 800
		});
	});
</script>