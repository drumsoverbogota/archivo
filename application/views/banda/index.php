<h2><?php echo $title; ?></h2>

<ul>
	
	<?php foreach ($banda as $banda_item): ?>
		<li>	
		<a href="<?php echo site_url('banda/'.$banda_item['id']); ?>"><?php echo $banda_item['nombre']; ?></a>
		<?php if ($banda_item['otros']){?>
			(<?php echo str_replace("\n", ",", $banda_item['otros']); ?>)
		<?php }?>
		</li>
	<?php endforeach; ?>
	
</ul>

</table>