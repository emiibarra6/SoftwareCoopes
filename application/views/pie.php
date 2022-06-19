</body>

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.5.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script>
		var base_url = '<?php echo base_url(); ?>';
	</script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/sweetalert/dist/sweetalert2.all.min.js"></script>

	
    <!-- funciones -->
    <?php if (isset($scripts) && !empty($scripts)): ?>
        <?php foreach ($scripts as $key => $script): ?>
            <script src="<?php echo base_url(); ?>assets/js/<?php echo $script; ?>"></script>
        <?php endforeach ?>
    <?php endif ?>
</html>