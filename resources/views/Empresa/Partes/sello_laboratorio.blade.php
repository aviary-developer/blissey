<div class="row">
	<div class="col-sm-4">
	</div>
	<div class="col-sm-4">
		<div class="image view view-first">
			<center>
				<img src={{asset(Storage::url($empresa->sello_laboratorio))}} class="img-responsive miniperfil">
				<div class="mask" style="height:100%">
					<div class="tools tools-bottom" style="margin-top: 105px;">
						<a href={{asset('/grupo_promesa/'.$empresa->id.'-5/edit')}}>
							<i class="fa fa-edit"></i>
						</a>
					</div>
				</div>
			</center>
		</div>
	</div>
</div>