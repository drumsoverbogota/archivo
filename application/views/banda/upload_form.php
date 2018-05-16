<?php echo $error;?>

<?php echo form_open_multipart('banda/do_upload/'.$id);?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>