<div class="container-md header__container">
    <nav class="navbar navbar-expand-lg bg-transparent">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php?controller=home" id="logo">
                <img src="assets/images/logo.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">
                            <i class="fa-solid fa-utensils"></i>
                            <span class="navbar_text">
                                TRỞ THÀNH ĐẦU BẾP
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php?controller=chef&action=index">
                            <i class="fa-regular fa-bell"></i>
                            <span class="navbar_text">
                                Đầu bếp
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=news&action=index">
                            <i class="fa-regular fa-circle-question"></i>
                            <span class="navbar_text">
                                Tin tức
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-globe"></i>
                            <span class="navbar_text">
                                Tiếng Việt
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-secondary show-lg" href="index.php?controller=user&action=detail&id=<?php echo $_SESSION['user']['id']?>">
                            <i class="fa-solid fa-user"></i>
                            <?php echo isset($_SESSION['user']) ? $_SESSION['user']['username'] : "Unkown"?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="header_search">
        <form id="search_form" action="#" method="post">
            <input type="text" name="searching_value" id="">
            <button type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>
</div>