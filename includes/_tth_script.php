<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
?>

<script type="text/javascript" src="<?php echo HOME_URL;?>/js/jquery/jquery-1.11.0.js"></script>
<script type="text/javascript" src="<?php echo HOME_URL;?>/js/jquery.mmenu.min.all.js"></script>
<script type="text/javascript" src="<?php echo HOME_URL;?>/js/slick.min.js"></script>
<script type="text/javascript" src="<?php echo HOME_URL;?>/js/script.js"></script>

<script type="text/javascript">
    $(function() {
        $('nav#menu').mmenu({
            extensions	: [ 'effect-slide-menu', 'pageshadow' ],
            searchfield	: true,
            counters	: false,
            navbar 		: {
                title		: 'Hải Lâm'
            },
            offCanvas: {
                position: "right"
            },
            navbars		: [
                {
                    position	: 'top',
                    content		: [ 'searchfield' ]
                }, {
                    position	: 'top',
                    content		: [
                        'prev',
                        'title',
                        'close'
                    ]
                }
            ]
        });
    });
</script>
<?php echo getConstant('google_analytics')?>
<?php echo getConstant('chat_online')?>