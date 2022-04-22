<h2>Отзывы</h2>

<?php if ($message): ?>
	<p>Статус действия: <?= $message ?></p>
<? endif; ?>


<form action="/?c=feedback&a=save&id=<?= $editable_feedback['id'] ?>" method="post">
	Оставьте отзыв: <br>
	<input type="text" name="name" placeholder="Ваше имя" value="<?= $editable_feedback['name'] ?>"><br>
	<input type="textarea" name="text" placeholder="Ваш отзыв" value="<?= $editable_feedback['text'] ?>"><br>

	<button type="submit">Save</button>
</form>

<?php foreach ($feedbacks as $item): ?>
	<div class="feedback__item">
		<strong><?= $item['name'] ?></strong>: <?= $item['text'] ?>
		<form action="/?c=feedback&a=edit&id=<?= $item['id'] ?>" method="post">
			<input type="submit" value="Edit">
		</form>
		<form action="/?c=feedback&a=delete&id=<?= $item['id'] ?>" method="post" method="post">
			<input type="submit" value="Delete">
		</form>
	</div>
<?php endforeach; ?>

