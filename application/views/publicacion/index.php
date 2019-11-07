<h2><?php echo $title; ?></h2>

<ul>
	<?php $primera = "" ?>
	<?php foreach ($publicacion as $publicacion_item): ?>
		<?php if (mb_substr($publicacion_item['nombre'], 0, 1) !== $primera){
			$primera = mb_substr($publicacion_item['nombre'], 0, 1);
			echo "<b>".$primera."</b>";
		}
		?>			
		<li>	
		<a href="<?php echo site_url('publicacion/'.$publicacion_item['nombrecorto']); ?>">
			<?php echo $publicacion_item['nombre'];?> <?php echo $publicacion_item['numero'];?> (<?php echo $publicacion_item['fecha'];?>)

		</a>
		</li>
		
	<?php endforeach; ?>
	
</ul>

</table>