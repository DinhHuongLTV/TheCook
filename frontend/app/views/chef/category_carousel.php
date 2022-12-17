<div class="info_container">
    <div class="container bg-light py-5">
        <?php foreach ($data['categories'] as $category):?>
            <div class="row my-5">
                <h2 class="text-danger"><?php echo $category['name']?></h2>
                <div class="owl-carousel owl-theme">
                    <?php foreach ($data['chefs'] as $chef):?>
                        <?php if($chef['category_id'] == $category['id']):?>
                            <div class="item">
                                <div class="card  ">
                                    <?php if (file_exists("../backend/assets/uploads/".$chef['avatar'])):?>
                                        <img src="../backend/assets/uploads/<?php echo $chef['avatar'] ?>" alt="" class="card-img">
                                    <?php else:?>
                                        <img src="assets/uploads/placeholder.png" alt="" class="card-img">
                                    <?php endif;?>
                                    <div class="card-body">
                                        <h4><?php echo $chef['first_name'] . " " . $chef['last_name']?></h4>
                                        <p>Quốc tịch: <?php echo $chef['nationality']?></p>
                                        <a href="index.php?controller=chef&action=detail&id=<?php echo $chef['id']?>" class="btn btn-danger">Chef's detail</a>
                                    </div>
                                </div>
                            </div>
                        <?php endif;?>
                    <?php endforeach;?>
                    <div class="item">
                        <div class="card">
                            <a href="#">Tìm thêm</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
</div>