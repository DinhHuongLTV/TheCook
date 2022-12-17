<div class="container py-5">
    <div class="row">
        <div class="col-lg-3 col-md-5 avatar_container py-3">
            <?php if (file_exists("../backend/assets/uploads/".$data['avatar'])):?>
                <img src="../backend/assets/uploads/<?php echo $data['avatar'] ?>" alt="" class="user_avatar mx-auto d-block" style="object-fit: cover">
            <?php else:?>
                <img src="assets/uploads/placeholder.png" alt="" class="user_avatar mx-auto d-block">
            <?php endif;?>
        </div>
        <div class="col-lg-9 col-md-7 user_info_container">
            <div class="py-1 mb-2">
                <strong>Tên đăng nhập:</strong>
                <?php echo $data['username'] ?>
            </div>
            <div class="py-1 mb-2">
                <strong>
                    Tên:
                </strong>
                <?php echo $data['first_name'] ?>
            </div>
            <div class="py-1 mb-2">
                <strong>
                    Họ:
                </strong>
                <?php echo $data['last_name'] ?>
            </div>
            <div class="py-1 mb-2">
                <strong>
                    Số điện thoại:
                </strong>
                <?php echo $data['phone'] ?>
            </div>
            <div class="py-1 mb-2">
                <strong>
                    Địa chỉ:
                </strong>
                <?php echo $data['address'] ?>
            </div>
            <div class="py-1 mb-2">
                <strong>
                    Email:
                </strong>
                <?php echo $data['email'] ?>
            </div>
            <div class="py-1 mb-2">
                <strong>
                    Nghề nghiệp:
                </strong>
                <?php echo $data['jobs'] ?>
            </div>
            <div class="py-1 mb-2">
                <strong>
                    Facebook:
                </strong>
                <?php echo $data['facebook'] ?>
            </div>
            <div class="py-1 mb-2">
                <strong>
                    Tham gia từ ngày:
                </strong>
                <?php echo date('d-m-Y', strtotime($data['created_at'])) ?>
            </div>
            <div>
                <a href="index.php?controller=user&action=update&id= <?php echo $data['id'] ?>" class="btn btn-outline-danger">Sửa thông
                    tin</a>
                <a href="index.php?controller=login&action=signout" class="btn btn-outline-secondary">Đăng xuất</a>
                <a href="index.php?controller=order&action=index" class="btn btn-outline-primary">Lịch sử thuê</a>
            </div>
        </div>
    </div>
</div>