<nav>
  <ul>
    <li><a href="/">Main</a></li>
    <li><a href="/exchangerates">Posters</a></li>
    <li><a href="/news">News</a></li>
    <?php if (isset($_COOKIE['user_id'])): ?>
    <li><a href="/account"><?php echo $_COOKIE['user_id']?></a></li>
  	<?php else: ?>
      <li><a href="/login">Login</a></li>
      <li><a href="/registration">Registration</a></li>
  	<?php endif; ?>
  </ul>
</nav>

<style>
nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #f2f2f2;
  padding: 10px;
}

nav ul {
  display: flex;
  list-style: none;
  margin: 0;
  padding: 0;
}

nav li {
  margin: 0 10px;
}

nav a {
  text-decoration: none;
  color: #333;
  font-weight: bold;
  padding: 5px;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

nav a:hover {
  background-color: #333;
  color: #fff;
}

</style>
