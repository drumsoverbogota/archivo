<h2><?php echo $title; ?></h2>

<ul>
	<?php $primera = "" ?>
	<?php foreach ($banda as $banda_item): ?>
		<?php if($banda_item['extranjera'] == 0 or $extranjera == 'true') { ?>
			<?php if (mb_substr($banda_item['nombre'], 0, 1) !== $primera){
				$primera = mb_substr($banda_item['nombre'], 0, 1);
				echo "<b>".$primera."</b>";
			}
			?>
			<li>	
			<a href="<?php echo site_url('banda/'.$banda_item['nombrecorto']); ?>"><?php echo $banda_item['nombre']; ?></a>
			<?php if ($banda_item['otros']){?>
				(<?php echo str_replace("\n", ",", $banda_item['otros']); ?>)
			<?php }?>
			</li>
		<?php } ?>
	<?php endforeach; ?>
	
</ul>

</table>