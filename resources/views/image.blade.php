@include('static.header')

<!-- Sidebar -->
<section id="sidebar">
	<div class="inner">
		<nav>
			<ul>
				<li><a href="/">Головна</a></li>
				<li><a href="#intro">Перегляд зображення</a></li>
			</ul>
		</nav>
	</div>
</section>

<!-- Wrapper -->
<div id="wrapper">

	<!-- Intro -->
	<section id="intro" class="wrapper style1 fullscreen fade-up">
		<div class="inner">
			<h1>Пошук дефектів</h1>
			<section>
				<h2>Зображення</h2>

				<div class="row uniform">
					<div class="12u$">
							<span class="image fit">
								<img src="{{$image->image}}" alt=""/>
							</span>
					</div>

				</div>

				<div class="row uniform">
					<div class="12u$">
							<span class="image fit">
								<img src="{{$image_grid}}" alt=""/>
							</span>
					</div>
				</div>

				<div class="row uniform">
					<div class="12u$">
						<h2>Інтенсивність</h2>
						<div class="table-wrapper">
							<table class="table table-bordered" id="table_intensity">
								<thead>
								<tr>
									<th width="35%" class="text-center">Зображення</th>
									<th width="5%" class="text-center">MxN</th>
									<th width="60%" class="text-center">Графік</th>
								</tr>
								</thead>
								<tbody>

								@forelse ($cropped_images as $cropped_image)
									<tr>
										<td class="text-center">
											<img height="200" alt="{{ $cropped_image['image'] }}"
											     src="{{ $cropped_image['image'] }}"/>
										</td>
										<td class="text-center">
											<pre>{{ $cropped_image['m'] }}x{{ $cropped_image['n'] }}</pre>
										</td>
										<td class="text-center column_graph"
										    data-position="{{ $cropped_image['position'] }}">
											<div class="graph_intensity"
											     id="graph_intensity_{{ $cropped_image['position'] }}"></div>
										</td>
									</tr>
								@empty
								@endforelse
								</tbody>
							</table>
						</div>

					</div>
				</div>
			</section>

			<div class="row uniform">
				<div class="12u$">
					<div class="inner">
						<ul class="actions">
							<li><a id="loadImage" href="#one" class="button scrolly">Далі</a></li>
						</ul>
					</div>
				</div>
			</div>

		</div>

	</section>
</div>

@section('scripts')
	<script>
		let imageId = '{{$image->id}}';
	</script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="/js/image/draw_graph.js"></script>
@stop

@include('static.footer')

