<body>
	<article>
		<h1><?=$post["title"] ?></h1>
		<?=$post["content"]?> 
		<section class="coms">
			Mes commentaires,, tralalilala
			<form action="" method="post">
				<p><label for="name">Nom : </label><input name="name" id="name" type="text" value="<?php echo set_value('name'); ?>" /> <?php echo form_error('name'); ?></p>
				<p><label for="mail">email : </label><input name="mail" id="mail" type="text" value="<?php echo set_value('mail'); ?>" /> <?php echo form_error('mail'); ?></p>
				<input type="submit" />
			</form>
		</section>
	</article>
</body>
</html>