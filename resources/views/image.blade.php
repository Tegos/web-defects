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
								<img src="{{$image->image_edit}}" alt=""/>
							</span>
					</div>

				</div>


				<ul class="actions">
					<li><a id="loadImage" href="#one" class="button scrolly">Далі</a></li>
				</ul>
		</div>
	</section>

</div>

@include('static.footer')