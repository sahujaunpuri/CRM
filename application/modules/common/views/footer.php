<script src="https://www.google.com/cloudprint/client/cpgadget.js">
</script>
</div><!-- /.content-wrapper -->

<footer class="main-footer">
	<strong>Copyright &copy; 2016-<?php echo date('Y')?></a>.</strong> All rights reserved.
</footer>
<?php echo $js; ?>
<script type="text/javascript">
	$('.select2').select2();

$('.tip').tooltip({placement: "auto", html: true});
// console.log($(".select2-container").length)
$(".select2-container").tooltip({
    title: function() {
        return $(this).prev().attr("title");
    },
    placement: "auto",
    //container: 'body'
});
</script>
