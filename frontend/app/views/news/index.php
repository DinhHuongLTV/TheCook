<div class="info_container">
    <div class="container bg-light py-5">
    <?php foreach ($data['news'] as $news):?>
        <div class="row mb-4">
            <div class="col-md-4 col-sm-12">
                <?php if (file_exists("../backend/assets/uploads/" . $news['avatar'])):?>
                    <img src="../backend/assets/uploads/<?php echo $news['avatar']?>" alt="" class="img-fluid">
                <?php else:?>
                    <img src="assets/images/aeZ6enhr_400x400.jpg" alt="" class="img-fluid">
                <?php endif;?>
            </div>
            <div class="col-md-8 col-sm-12">
                <h2 class="card-title"><?php echo $news['name']?></h2>
                <p><?php echo $news['summary']?></p>
                <a href="index.php?controller=news&action=detail&id=<?php echo $news['id']?>"
                   class="btn btn-danger">Đọc thêm
                </a>
            </div>
        </div>
    <?php endforeach;?>
</div>
</div>
