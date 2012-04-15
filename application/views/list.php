<body>
<?php foreach ($posts as $post): ?>
	<article>
		<h1><?=$post["title"] ?></h1>
		<?=$post["content"]?> 
		<section class="coms">
			Mes commentaires,, tralalilala
			<form>
				
			</form>
		</section>
		<footer>commentaires, date etc.</footer>
	</article>
<?php endforeach; ?>
</body>
</html>