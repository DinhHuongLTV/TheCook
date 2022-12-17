<div class="info_container">
    <div class="chef_info container py-5">
        <div class="row justify-content-between">
            <div class="col-lg-5 col-md-6 col-sm-12" style="min-height: 500px">
                <img src="../backend/assets/uploads/<?php echo $chef['avatar']?>" alt="" class="user_avatar d-block mx-auto" style="object-fit: cover">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h3>Đặt lịch đầu bếp: <?php echo $chef['first_name'] . " ". $chef['last_name']?></h3>
                <p class="text-danger">Giá tiền: <?php echo $chef['price']?>/h</p>
                <strong>Lên lịch hẹn đầu bếp</strong>
                <form action="" method="post">
                    <?php if (!empty($this->__data['error'])): ?>
                        <strong class="mb-2 d-block" style="color: red"><?php echo $this->__data['error']; unset($this->__data['error'])?></strong>
                    <?php endif ?>
                    <div class="mb-3 form-control">
                        <label class="booking_label" for="">Giờ hẹn:</label>
                        <input type="time" name="booking_hour" id="">
                    </div>
                    <div class="mb-3 form-control">
                        <label for="" class="booking_label">Số giờ thuê</label>
                        <input type="number" name="booking_time" id="">
                    </div>
                    <div class="mb-3 form-control">
                        <label class="booking_label" for="">Ngày hẹn:</label>
                        <input type="date" name="booking_date" id="">
                    </div>
                    <div class="mb-3 form-control">
                        <label class="booking_label" for="">Địa điểm:</label>
                        <input type="text" name="booking_place" id="">
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="Đặt lịch" name="submit" class="btn btn-danger">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>