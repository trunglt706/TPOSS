<div class="row">
    @foreach ($data as $item)
        <a href="{{ $item['href'] }}" class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="fw-bolder mb-0 total-admin">{{ number_format($item['total']) }}</h2>
                        <p class="card-text">{{ $item['name'] }}</p>
                    </div>
                    <div class="avatar bg-light-{{ $item['color'] }} p-50 m-0">
                        <div class="avatar-content">
                            {!! $item['icon'] !!}
                        </div>
                    </div>
                </div>
            </div>
        </a>
    @endforeach
</div>
<script>
    $('.home-header .fa-solid').addClass('font-medium-5');
</script>
