<h1>News</h1>
<?php foreach ($news as $newsItem):?>
<?php foreach ($categories as $item):?>
<?php if ($item['id'] == $newsItem['category_id']):?>
<?php $category = $item['title']; ?>
<?php endif; ?>
<?php endforeach; ?>
<h4>Рубрика: <?=$category?></h4>
<a href="/news/<?=$newsItem['id']?>"><h2><?=$newsItem['title']?></h2></a>
<h4><?=$newsItem['author']?> (<?=$newsItem['created_at']?>)</h4>
<p><?=$newsItem['description']?></p>
<hr>
<?php endforeach; ?>
