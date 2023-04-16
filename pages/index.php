<?php require_once('layouts/header.php'); 
echo '<script>console.log("error")</script>';?>

<body>
	<div class="wrapper">
		<main class="page">
			<section class="mainscreen">
				<?php
				if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 'true')) {
					echo ('<button data-popup="#popup-auth" class="mainscreen__auth button button_w" type="button">Авторизация</button>');
				} else {
					echo ('<a href="/unlogin" class="mainscreen__auth button button_w">Выход</a>');
				}
				?>
				<div class="mainscreen__image-ibg">
					<picture>
						<source data-srcset="img/mainscreen/bg.webp" srcset="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" type="image/webp"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" data-src="img/mainscreen/bg.jpg" alt="Фон книги">
					</picture>
				</div>
				<div class="mainscreen__container">
					<h1 class="mainscreen__title">База знаний</h1>
					<?php require_once('pages/assets/search.php') ?>
				</div>
			</section>
		</main>
	</div>
	<?php
	if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 'true')) {
		require_once("pages/assets/popup.php");
	}
	?>
	<script src="js/app.min.js?_v=20230319185830"></script>
	<script>
		$('#search-input').click(function(e) {
			if (<?php echo $_SESSION['loggedin'] ?>) {
				$("#search").empty();
				$.getJSON("php/articles.php?type=get", function(data) {
					$.each(data, function(i, item) {
						$("#search").append(`
							<a href="/catalog?article=${item['id']}" class="result-search__item">
								<div class="result-search__icon _icon-link"></div>
								<div class="result-search__text">${item['header']}</div>
							</a>
						`);
					});
				});
			} else {
				e.preventDefault();
				var url = location.protocol + '//' + location.host + location.pathname;
				window.location.href = url + '#popup-auth';
			}
		});
	</script>
</body>

</html>