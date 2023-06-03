<?php
	require_once('layouts/header.php');
	$id = $_GET["id"];
	$result = mysqli_query($link, "SELECT * FROM articles WHERE id='$id'");
	$article = mysqli_fetch_assoc($result);
	// if(!isset($_SESSION['id']) && !isset($_GET['key'])){
	// 	echo '<script>console.log("error1")</script>';
	// 	echo '<script>window.location.href = "/";</script>';
	// }else if(isset($_GET['key']) && $_GET['key']!=bin2hex($article['id'])){
	// 	echo '<script>console.log("error2")</script>';
	// 	echo '<script>window.location.href = "/";</script>';
	// }
	$chapter_id = $article['chapter_id'];
	$result = mysqli_query($link, "SELECT * FROM chapters WHERE id='$chapter_id'");
	$chapter = mysqli_fetch_assoc($result);
	$date = getdate($article['time']);
	$day = $date['mday'];
	$month = $date['mon'];
	if (strlen($month) == 1) {
		$month = '0' . $month;
	}
	$year = $date['year'];
	$date = $day . "." . $month . "." . $year;
	$active_tags = mysqli_query($link, "SELECT * FROM `articles_tags` WHERE article_id = {$article['id']}");
?>



<body>
	<div class="wrapper">
		<?php
		require_once('layouts/top_bar.php');
		?>
		<main class="page">
			<section class="article">
				<div class="article__container-middle">
					<div class="article__head">
						<div class="article__path path">
							<a href="/" class="path__item _icon-home"></a>
							>
							<a class="path__item">Блог</a>
							>
							<a class="path__item">Статьи</a>
							>
							<a href="/" class="path__item"><?= $chapter['name'] ?></a>
						</div>
						<div class="article__date"><?= $date ?></div>
					</div>
					<div class="item-catalog__label"><?= $chapter['subject'] ?></div><a id="share-btn" href="<?=URL . '/article?id='.$id.'&amp;key=' . bin2hex($id)?>"><img style="width: 20px; margin-left:15px; margin-top:2px" src="/img/share.png"/></a>
					<?php
					while ($row = mysqli_fetch_assoc($active_tags)) {
						echo '<span class="tag">#'.$row["tag_name"].'</span>';
					}
					?>
					<h1 class="article__title"><?= $article['header'] ?></h1>
					<div class="article__text">
						<?= $article['body'] ?>
					</div>
					<div class="article__btns">
						<a href="/catalog?chaper=<?= str_replace(' ','-',$chapter['name']) ?>" class="article__btn article__btn_w">
							Посмотреть все статьи из этого раздела
						</a>
						<a href="/catalog?subject=<?= str_replace(' ','-',$chapter['subject']) ?>" class="article__btn article__btn_b">
							Посмотреть все статьи по этой тематике
						</a>
					</div>
				</div>
			</section>
			<div class="nv-sidebar-wrap col-sm-12 nv-right blog-sidebar ">
				<aside id="secondary" role="complementary">

					<div id="block-2" class="widget widget_block widget_categories">
						<ul class="wp-block-categories-list wp-block-categories">
							<li class="cat-item"><a>Наши проекты</a>
							</li>
							<li class="cat-item"><a>Творческие конкурсы</a>
								<ul class="children">
									<li class="cat-item"><a>Литературные конкурсы</a>
									</li>
									<li class="cat-item"><a>Фотоконкурсы и видео</a>
									</li>
									<li class="cat-item"><a>Конкурсы рисунка и дизайна</a>
									</li>
									<li class="cat-item"><a>Конкурсы песен и музыки</a>
									</li>
								</ul>
							</li>
							<li class="cat-item"><a>Детские конкурсы</a>
							</li>
							<li class="cat-item"><a>Конкурсы для студентов</a>
							</li>
							<li class="cat-item"><a>Гранты</a>
							</li>
							<li class="cat-item"><a>Стипендии</a>
							</li>
							<li class="cat-item"><a>Вакансии</a>
							</li>
							<li class="cat-item"><a>Требуются волонтеры</a>
							</li>
							<li class="cat-item"><a href="https://vsekonkursy.ru/konkursy-po-professiyam">Конкурсы по профессиям</a>
								<ul class="children">
									<li class="cat-item"><a href="https://vsekonkursy.ru/konkursy-po-professiyam/konkurs-dlya-pedagogov">Конкурсы для педагогов</a>
									</li>
									<li class="cat-item"><a href="https://vsekonkursy.ru/konkursy-po-professiyam/konkursy-dlya-zhurnalistov">Конкурсы для журналистов</a>
									</li>
								</ul>
							</li>
							<li class="cat-item"><a href="https://vsekonkursy.ru/olimpiady-nauchnye-konkursy-konferentsii">Олимпиады, научные конкурсы, конференции</a>
							</li>
							<li class="cat-item"><a href="https://vsekonkursy.ru/kursy-programmy-obucheniya">Курсы программы обучения</a>
							</li>
							<li class="cat-item"><a href="https://vsekonkursy.ru/stazhirovki">Стажировки</a>
							</li>
							<li class="cat-item"><a href="https://vsekonkursy.ru/konkursy-startapov">Конкурсы стартапов</a>
							</li>
							<li class="cat-item"><a href="https://vsekonkursy.ru/promokody">Промокоды 2023</a>
							</li>
							<li class="cat-item"><a href="https://vsekonkursy.ru/bez-rubriki">Прочее</a>
							</li>
							<li class="cat-item"><a href="https://vsekonkursy.ru/proshedshie-konkursy">Прошедшие конкурсы</a>
							</li>
						</ul>
					</div>
				</aside>
			</div>
		</main>
	</div>
	<script src="js/app.min.js?_v=20230319185830"></script>
	<script>
		$(".tag").click(function (e) { 
			var tag = $(this).text().replace('#', '');
			window.location.href = '/catalog?tag=' + tag.replaceAll(" ","-");
		});
		$("#share-btn").click(function (e) { 
            e.preventDefault();

            toastr.options = {
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-top-right',
                showDuration: '300',
                hideDuration: '1000',
                timeOut: '3000',
                extendedTimeOut: '1000',
                showEasing: 'swing',
                hideEasing: 'linear',
                showMethod: 'fadeIn',
                hideMethod: 'fadeOut'
            };

            navigator.clipboard.writeText($(this).attr('href'))
                .then(() => {
                    toastr.success('Скопировано!');
                })
                .catch((error) => {
                    toastr.error('Ошибка!');
                });
        });
		$("#search").empty();
		$.getJSON("php/articles.php?type=get", function(data) {
			$.each(data, function(i, item) {
				console.log(data);
				$("#search").append(`
							<a href="/catalog?article=${item['id']}" class="result-search__item">
								<div class="result-search__icon _icon-link"></div>
								<div class="result-search__text">${item['header']}</div>
							</a>
						`);
			});
		});
	</script>
</body>

</html>