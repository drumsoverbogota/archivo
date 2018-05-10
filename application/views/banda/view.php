

<P><IMG SRC="<?php echo base_url('images/placeholder.jpg'); ?>" ALIGN="RIGHT"><B>Banda</B></P>

<p><H3><?php echo $banda_item['nombre'];?></H3></p>
<p><H3><?php echo $banda_item['otros'];?></H3></p>

<hr/>




<a href = "<?php echo site_url('banda/edit/'.$banda_item['id']); ?>">Editar</a>