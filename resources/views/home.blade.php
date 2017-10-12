@include('static.header')

<!-- Sidebar -->
<section id="sidebar">
	<div class="inner">
		<nav>
			<ul>
				<li><a href="/">Головна</a></li>
				<li><a href="#intro">Вибір файлу</a></li>
				<!--li><a href="#one">Who we are</a></li>
				<li><a href="#two">What we do</a></li>
				<li><a href="#three">Get in touch</a></li-->
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
				<h2>Вибір зображення</h2>
				<form action="{{ URL::to('upload') }}" method="post"
				      enctype="multipart/form-data" id="formImage">

					<div class="row uniform">
						<div class="12u$">
							<span class="image fit">
								<img id="preview_image" src="#" alt=""/>
							</span>
						</div>
					</div>

					<div class="row uniform">
						<div class="12u$">
							<input name="image" type="file" accept="image/gif, image/jpeg, image/png" id="imgInp"/>
						</div>
					</div>
					<div class="row uniform">
						<div class="12u$(xsmall)">
							<p>Кількість поділів <b><i>NxM</i></b></p>
						</div>
					</div>
					<div class="row uniform">
						<div class="6u 12u$(xsmall)">
							<label for="divide_n">N</label>
						</div>
						<div class="6u$ 12u$(xsmall)">
							<input type="number" name="divide_n"
							       id="divide_n" value="3" placeholder="N"/>
						</div>
					</div>

					<div class="row uniform">
						<div class="6u 12u$(xsmall)">
							<label for="divide_m">M</label>
						</div>
						<div class="6u$ 12u$(xsmall)">
							<input type="number" name="divide_m"
							       id="divide_m" value="3" placeholder="M"/>
						</div>
					</div>

					<div class="row uniform">
						<div class="6u 12u$(xsmall)">
							<label for="input_threshold">Поріг</label>
						</div>
						<div class="6u$ 12u$(xsmall)">
							<input min="10" max="255" type="number" value="255" id="input_threshold" name="threshold" />
						</div>
					</div>

					<div class="row uniform">
						<!--div class="12u$">
							<div class="select-wrapper">
								<select name="demo-category" id="demo-category">
									<option value="">- Category -</option>
									<option value="1">Manufacturing</option>
									<option value="1">Shipping</option>
									<option value="1">Administration</option>
									<option value="1">Human Resources</option>
								</select>
							</div>
						</div-->
					</div>
					<input type="hidden" value="{{ csrf_token() }}" name="_token"/>
				</form>
			</section>

			<ul class="actions">
				<li><a id="loadImage" href="#one" class="button scrolly">Далі</a></li>
			</ul>
		</div>
	</section>

</div>

@include('static.footer')