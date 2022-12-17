<div class="info_container">
    <div class="container bg-light py-5">
        <h2><?php echo $data['name']?></h2>
        <i><?php echo date('d-m-Y H:i:s', strtotime($data['created_at']))?></i>
        <img src="../backend/assets/uploads/<?php echo $data['avatar']?>" alt="" class="d-block mx-auto" height="500">
        <p class="text-center"><i>Mo ta hinh anh</i></p>
        <p><?php echo $data['content']?></p>
    </div>
</div>