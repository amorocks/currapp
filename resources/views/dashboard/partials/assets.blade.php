<div>
	<p>Belangrijke info:</p>
	<ul>
		@foreach($term->cohort->assets as $asset)
			<li><a class="underline" target="_blank" href="{{ route('assets.show', $asset) }}">{{ $asset->title }}</a></li>
		@endforeach
	</ul>
</div>
