<?php require_once('layouts/header.php'); ?>

<?php
$id = $_SESSION['id'];
if (isset($_GET['chaper'])) {
	$chapter_name = $_GET['chaper'];
	$res = mysqli_query($link, "SELECT articles.id, articles.header, articles.body, chapters.name, chapters.subject FROM `articles`
									INNER JOIN chapters on chapters.id = articles.chapter_id
									WHERE chapters.name = '{$chapter_name}' AND chapters.user_id = {$id}");
	$result = array();
	while ($row = mysqli_fetch_assoc($res)) {
		array_push($result, $row);
	}
} else if (isset($_GET['article'])) {
	$article_id = $_GET['article'];
	$res = mysqli_query($link, "SELECT articles.id, articles.header, articles.body, chapters.name, chapters.subject FROM `articles`
									INNER JOIN chapters on chapters.id = articles.chapter_id 
									WHERE articles.id = {$article_id}");
	$result = array();
	while ($row = mysqli_fetch_assoc($res)) {
		array_push($result, $row);
	}
} else if (isset($_GET['tag'])) {
	$tag = $_GET['tag'];
	$res = mysqli_query($link, "SELECT articles.id, articles.header, articles.body, chapters.name, chapters.subject FROM `articles`
									INNER JOIN chapters on chapters.id = articles.chapter_id
									INNER JOIN articles_tags on articles_tags.article_id = articles.id
									WHERE articles_tags.tag_name = '{$tag}' AND chapters.user_id = {$id}");
	$result = array();
	while ($row = mysqli_fetch_assoc($res)) {
		array_push($result, $row);
	}
} else if (isset($_GET['text'])) {
	$text = $_GET['text'];
	$res = mysqli_query($link, "SELECT articles.id, articles.header, articles.body, chapters.name, chapters.subject FROM `articles`
                                        INNER JOIN chapters on chapters.id = articles.chapter_id
                                        WHERE chapters.user_id = {$id}");
	$result = array();
	while ($row = mysqli_fetch_assoc($res)) {
		if (strpos($row['header'], $text) !== false) {
			array_push($result, $row);
		}
	}
}
?>

<body>
	<div class="wrapper">
		<?php
		require_once('layouts/top_bar.php');
		?>
		<main class="page">
			<section class="catalog">
				<div class="catalog__container">
					<?php
					foreach ($result as &$row) {
						print('
							<article class="catalog__item item-catalog">
								<div class="item-catalog__content" style="min-width:70%">
									<div class="item-catalog__category">' . $row['name'] . '</div>
									<div class="item-catalog__head">
										<div class="item-catalog__label">' . $row['subject'] . '</div>
									</div>
									<h2 class="item-catalog__title title title_s28">' . $row['header'] . '</h2>
									<p style="white-space: pre-line;" class="item-catalog__text">
									' . trim(substr (preg_replace('#<[^>]+>#',' ',$row['body']), 0, 250)) . '...
									</p>
									<a href="article?id=' . $row['id'] . '" class="item-catalog__btn">Перейти</a>
								</div>
								<div class="item-catalog__image-ibg">
									<picture>
										<source data-srcset="img/catalog/1.webp" srcset="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" type="image/webp"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=" data-src="img/catalog/1.jpg" alt="О примерах ввода">
									</picture>
								</div>
							</article>');
					}
					?>
				</div>
			</section>
		</main>
	</div>
	<script src="js/app.min.js?_v=20230319185830"></script>
	<script>
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
	</script>
	<script>
	</script>
</body>

</html>