<?php if (!$is_auth): ?>
	<form action="" method="post">
		<input class="menu__input" type="text" name="login" placeholder="Login">
		<input class="menu__input" type="password" name="password" placeholder="Password">
		Save? <input type="checkbox" name="save">
		<button class="menu__button" type="submit" name="send">Sign In</button>
		<a class="menu__button menu__button-link" href="/registration/">Sign Up</a>
	</form>
<?php else: ?>
	Добро пожаловать, <?= $user ?>!  <a href="/?logout">Exit</a></br>
<?php endif; ?>


<a href="/">Главная</a>
<a href="/?c=product&a=catalog">Каталог</a>
<a href="/?c=feedback&a=get_all">Отзывы</a>
<br>