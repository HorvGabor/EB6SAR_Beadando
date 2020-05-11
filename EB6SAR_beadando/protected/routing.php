<?php 
if(!array_key_exists('P', $_GET) || empty($_GET['P']))
	$_GET['P'] = 'news';

switch ($_GET['P']) {
	case 'news': require_once PROTECTED_DIR.'normal/news.php'; break;

	case 'login': !IsUserLoggedIn() ? require_once PROTECTED_DIR.'user/login.php' : header('Location: index.php'); break;

	case 'register': !IsUserLoggedIn() ? require_once PROTECTED_DIR.'user/register.php' : header('Location: index.php'); break;

	case 'logout': IsUserLoggedIn() ? UserLogout() : header('Location: index.php'); break;

	case 'userpanel': IsUserLoggedIn() ? require_once PROTECTED_DIR.'user/userpanel.php' : header('location: index.php'); break;

	case 'library': IsUserLoggedIn() ? require_once PROTECTED_DIR.'games/library.php' : header('Location: index.php'); break;

	case 'store': IsUserLoggedIn() ? require_once PROTECTED_DIR.'games/store.php' : header('Location: index.php'); break;

	case 'profile': IsUserLoggedIn() ? require_once PROTECTED_DIR.'user/profile.php' : header('Location: index.php'); break;

	case 'game': IsUserLoggedIn() ? require_once PROTECTED_DIR.'games/game.php' : header('Location: index.php'); break;

	default: require_once PROTECTED_DIR.'normal/404.php'; break;
}

?>