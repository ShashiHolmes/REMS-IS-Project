<?php  if (count($errors) > 0) : ?>
  <div class="error">
  	<?php foreach ($errors as $error) : ?>
  	  <p style="color: red"><i><?php echo "* $error" ?></i></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>
