@extends('client.pages.main')
@section('content')

<!-- Product -->
<section class="bg0 p-t-150 p-b-100">
	<div class="container">
		<div class="p-b-10">
			<h1 class="fw-bolder cl5">
				SẢN PHẨM MỚI NHẤT
			</h1>
		</div>

		<div id="loadProduct" class="mt-5">
			@include('client.pages.products.list')
		</div>

		<!-- Load more -->
		<div class="flex-c-m flex-w w-full p-t-45" id="btn_loadMore">
			<input type="hidden" id="page" value="1">
			<button onclick="loadMore()" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
				Xem thêm
			</button>
		</div>
	</div>
</section>

<script>
	function loadMore() {
	const page = Number($('#page').val());
	$.ajax({
		url: '/services/load-product',
		type: 'POST',
		dataType: 'JSON',
		data: {
			page: page,
			_token: "{{ csrf_token() }}"
		},
		success: function (result) {
			if (result.html !== '') {
				$('#loadProduct').append(result.html);
				$('#page').val(page + 1 );
			} else {
				alert('Đã hết sản phẩm');
				$('#btn_loadMore').css('display', 'none');
			}
		}
	})
}
</script>
@endsection