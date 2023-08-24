<!DOCTYPE html>
<html lang="en">
@include('client.layouts.head')

<body>
	{{-- class="animsition" --}}
	@include('client.layouts.navbar')
	
	@yield('content')

	@include('client.layouts.footer')

	@include('client.layouts.end')
</body>

</html>