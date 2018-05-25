<h2><?php echo $title; ?></h2>

<ul>
	<li>
	<?php foreach ($banda as $banda_item): ?>	
		<a href="<?php echo site_url('banda/'.$banda_item['id']); ?>"><?php echo $banda_item['nombre']; ?></a>
		<?php echo $banda_item['otros']; ?>
	<?php endforeach; ?>
	</li>
</ul>

</table>