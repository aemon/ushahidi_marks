<link  href="<?php echo url::site('/plugins/mark/views/css/mark.css') ?>" rel="stylesheet" type="text/css">

<div class="marks_block">
    <div class="marks_list">
     <?php foreach ($marks as $m){?>
        <a href="<?php echo url::site('/reports?mark='.$m['id']);?>" <?php if ($m['id']==$active_mark) echo 'class="active"';?>><?php echo $m['name'];?></a>
     <?php }?>
     </div>
</div>
