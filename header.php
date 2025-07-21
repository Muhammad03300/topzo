<?php 
    session_start();
    error_reporting(E_ALL);
    ob_start();
?>

<!-- Bootstrap JS, jQuery, and Popper.js Scripts -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<header id="navbar">
    <nav class="navbar-container container">
        <a href="index.php" class="home-link">
            SHAZON FASHION
        </a>
        <button type="button" id="navbar-toggle" aria-controls="navbar-menu" aria-label="Toggle menu"
            aria-expanded="false">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div id="navbar-menu" aria-labelledby="navbar-toggle">
            <ul class="navbar-links">
                <li class="navbar-item"><a class="navbar-link" href="index.php">Home</a></li>
                <li class="navbar-item"><a class="navbar-link" href="products.php">Products</a></li>
                <li class="navbar-item"><a class="navbar-link" href="Cart.php">Cart</a></li>
                <li class="navbar-item"><a class="navbar-link" href="orders-user.php">Orders</a></li>
                <?php if (isset($_SESSION['user_name'])) : ?>
                <li class="navbar-item"><a class="navbar-link" href="user-logout.php">Logout</a></li>
                <?php else : ?>
                <li class="navbar-item"><a class="navbar-link" href="user-login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>

<!-- Bootstrap JS, jQuery, and Popper.js Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>
:root {
    --navbar-bg-color: hsl(0, 0%, 15%);
    --navbar-text-color: hsl(0, 0%, 85%);
    --navbar-text-color-focus: white;
    --navbar-bg-contrast: hsl(0, 0%, 25%);
}

* {
    //box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    height: 100vh;
    font-family: Arial, Helvetica, sans-serif;
    line-height: 1.6;
}

.container {
    max-width: 1000px;
    padding-left: 1.4rem;
    padding-right: 1.4rem;
    margin-left: auto;
    margin-right: auto;
    margin-top: 0rem;
    /* Adjust the upper margin as needed */
}

#navbar {
    --navbar-height: 64px;
    height: var(--navbar-height);
    background-color: var(--navbar-bg-color);
    left: 0;
    right: 0;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
    z-index: 9999;
    /* Increase the z-index value */
}

.navbar-container {
    display: flex;
    justify-content: space-between;
    height: 100%;
    align-items: center;
}

.navbar-item {
    margin: 0.4em;
    width: 100%;
}

.home-link,
.navbar-link {
    color: var(--navbar-text-color);
    text-decoration: none;
    display: flex;
    font-weight: 400;
    align-items: center;
}

.home-link:is(:focus, :hover) {
    color: var(--navbar-text-color-focus);
    text-decoration: none;
}

.navbar-link {
    justify-content: center;
    width: 100%;
    padding: 0.4em 0.8em;
    border-radius: 5px;
}

.navbar-link:is(:focus, :hover) {
    text-decoration: none;
    color: var(--navbar-text-color-focus);
    background-color: var(--navbar-bg-contrast);
}

.navbar-logo {
    background-color: var(--navbar-text-color-focus);
    border-radius: 50%;
    width: 30px;
    height: 30px;
    margin-right: 0.5em;
}

#navbar-toggle {
    cursor: pointer;
    border: none;
    background-color: transparent;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}

.icon-bar {
    display: block;
    width: 25px;
    height: 4px;
    margin: 1px;
    background-color: var(--navbar-text-color);
}

#navbar-toggle:is(:focus, :hover) .icon-bar {
    text-decoration: none;
    background-color: var(--navbar-text-color-focus);
}

#navbar-toggle[aria-expanded="true"] .icon-bar:is(:first-child, :last-child) {
    position: absolute;
    margin: 0;
    width: 30px;
}

#navbar-toggle[aria-expanded="true"] .icon-bar:first-child {
    transform: rotate(45deg);
}

#navbar-toggle[aria-expanded="true"] .icon-bar:nth-child(2) {
    opacity: 0;
}

#navbar-toggle[aria-expanded="true"] .icon-bar:last-child {
    transform: rotate(-45deg);
}

#navbar-menu {
    position: absolute;
    top: var(--navbar-height);
    opacity: 0;
    visibility: hidden;
    left: 0;
    right: 0;
}

#navbar-toggle[aria-expanded="true"]+#navbar-menu {
    background-color: rgba(0, 0, 0, 0.4);
    opacity: 1;
    visibility: visible;
}

.navbar-links {
    list-style: none;
    background-color: var(--navbar-bg-color);
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 1rem auto 0;
    border-radius: 5px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
}

#navbar-toggle[aria-expanded="true"]+#navbar-menu .navbar-links {
    padding: 1em;
}

@media screen and (min-width: 700px) {

    #navbar-toggle,
    #navbar-toggle[aria-expanded="true"] {
        display: none;
    }

    #navbar-menu,
    #navbar-toggle[aria-expanded="true"] #navbar-menu {
        visibility: visible;
        opacity: 1;
        position: static;
        display: block;
        height: 100%;
    }

    .navbar-links,
    #navbar-toggle[aria-expanded="true"] #navbar-menu .navbar-links {
        margin: 0;
        padding: 0;
        box-shadow: none;
        position: static;
        flex-direction: row;
        width: 100%;
        height: 100%;
    }
}
</style>

<script>
const navbarToggle = document.querySelector("#navbar-toggle");
const navbarMenu = document.querySelector("#navbar-menu");
let isNavbarExpanded = navbarToggle.getAttribute("aria-expanded") === "true";

const toggleNavbarVisibility = () => {
    isNavbarExpanded = !isNavbarExpanded;
    navbarToggle.setAttribute("aria-expanded", isNavbarExpanded);
    navbarMenu.classList.toggle("show");
};

navbarToggle.addEventListener("click", toggleNavbarVisibility);

document.addEventListener("click", (event) => {
    if (!navbarMenu.contains(event.target) && !navbarToggle.contains(event.target)) {
        isNavbarExpanded = false;
        navbarToggle.setAttribute("aria-expanded", isNavbarExpanded);
        navbarMenu.classList.remove("show");
    }
});
</script>