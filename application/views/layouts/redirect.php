<?php if(isset($close_only_modal)) { ?>
  <script type="text/javascript">
  <?php if(isset($modal_id)) { ?>
      var modal_id = '<?=$modal_id?>';
  <?php } else  { ?>
      var modal_id = 'general-modal';
  <?php } ?>
 
  $('document').ready(function(){setTimeout(function(){$('#'+modal_id+'').modal('hide')},1200); });
  </script>
<?php } else { ?>
  <script type="text/javascript">
  $('document').ready(function(){setTimeout(function(){location.href="<?= $url?>";},<?=(isset($time_before_refresh) ? $time_before_refresh : 1500 )?>);});
  </script>
<?php } ?>