<div class="add_marks_block_wrap">
     <script type="text/javascript">
if(!window.jQuery){
    document.write('<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"/>');
}



</script>
<script type="text/javascript" src="<?php echo url::site('/plugins/mark/views/js/chosen.jquery.js') ?>"></script>
<script type="text/javascript" src="<?php echo url::site('/plugins/mark/views/js/call_chosen.js') ?>"></script>
<link  href="<?php echo url::site('/plugins/mark/views/css/chosen.css') ?>" rel="stylesheet" type="text/css" >
<link  href="<?php echo url::site('/plugins/mark/views/css/mark.css') ?>" rel="stylesheet" type="text/css" >
<div class="chosen_wrap">
<select id="marks_select" class="chosen_marks" name="marks[]" multiple="multiple">
<?php foreach ($marks as $mark){?>
    <option value="<?php echo $mark['id'];?>" <?php if (in_array($mark['id'], $selected_marks)) echo ' selected="selected" ';?>><?php echo $mark['name'];?></option>
<?php  }?>
</select> 
<select name="hidden_marks[]" id="hidden_marks" style="display: none;"  multiple="multiple"></select>
</div>
</div>