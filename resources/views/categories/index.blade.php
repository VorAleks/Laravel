<h1>Categories</h1>
<?php foreach ($categories as $newsItem):?>
<a href="/categories/<?=$newsItem['id']?>"><h2><?=$newsItem['title']?></h2></a>
<hr>
<?php endforeach; ?>
