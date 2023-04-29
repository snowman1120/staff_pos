<?php foreach($list as $item){ ?>
    <div><?php echo $item[0]['organ_name']; ?> <?php echo $item[0]['staff_name']; ?></div>
    <?php foreach($item as $shift){ ?>
        <div >
            <?php echo $shift['from_time'] . ' ~ ' . $shift['to_time'] . '  ' . SHIFT_STATUS_COMMENTS[$shift['shift_type']]; ?>
            <a style="margin-left:30px;" href="<?php echo base_url(); ?>system/shiftDelete?shift_id=<?php echo $shift['shift_id']; ?>">削除</a>
        </div>
    <?php } ?>
<?php } ?>