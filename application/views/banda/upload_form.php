<?php echo $error;?>

<?php echo form_open_multipart('banda/do_upload/'.$nombrecorto);?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>