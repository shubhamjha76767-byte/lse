

@extends('layout.app')



@section('content')



<div class="rota pt-3 pb-5">

    <div class="container px-md-2 px-0">

        <h1 class="h2 text-primary mb-1 px-4">ROTA</h1>

       <div class="f300 text-md-small text-primary mb-3 px-4 ms-md-2">{{ $weekRange }}</div>


        <div class="rota-week border border-md-down-bottom-0 border-md-down-start-0 border-md-down-end-0 border-dark-primary-2">

            <div class="w-100 py-2 px-3 d-flex align-items-center border-bottom border-dark-primary-2">

                <a class="btn text-md-small f700 text-white bg-primary-dark bg-hover-primary py-2 px-4 rounded-2 lh-1 my-1" href="./rota">WEEKLY</a>

                <a class="btn text-md-small f700 text-white border-primary-dark bg-hover-primary py-2 px-4 rounded-2 lh-1 ms-2 my-1" href="./rota-day">DAILY</a>

                <div class="dropdown ms-auto">

                    <button class="btn p-0 fs-5 text-primary border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">

                        <i class="fa-equalizer"></i>

                    </button>

                    <div class="dropdown-menu bg-dark-bg rounded-0 border-dark-primary-2" id="rotaFilterMenu">
    <ul class="dropdown-list">
        <li><a class="dropdown-item text-small d-inline-block pe-3 position-relative f700 text-uppercase" href="#" data-filter="all">All</a></li>
        <li><a class="dropdown-item text-small d-inline-block pe-3 position-relative f700 text-uppercase" href="#" data-filter="available">Available</a></li>
        <li><a class="dropdown-item text-small d-inline-block pe-3 position-relative f700 text-uppercase" href="#" data-filter="notavailable">Not available</a></li>
    </ul>
</div>


                </div>

            </div>

            <div class="rota-week-wrap px-md-0 px-3">

                <div class="d-md-flex">
                    
   @foreach ($weekRota as $day)
    <div class="rota-col pb-3 border-md-end border-dark-primary-2 d-md-block d-flex pt-md-0 pt-3 border-bottom-md-0 border-bottom flex-grow">
        <div class="text-center px-md-3 pe-3 my-md-3 rota-date">
            <span class="d-block text-small text-uppercase f700 lh-1 text-primary rota-day">{{ $day['day'] }}</span>
            <span class="fs-5 text-primary">{{ $day['date'] }}</span>
        </div>

        <div class="align-self-center rota-days-items w-100">
            @foreach ($day['entries'] as $entry)
                @if (!$entry['available'])
                    {{-- Not Available Block --}}
                    <div class="rounded-2 w-100 notavailable rota-tags align-self-center mb-2 rota-item" data-status="notavailable">
                        <div class="border border-3 border-primary-alt border-top-0 border-bottom-0 border-end-0 ps-2">
                            <span class="d-block lh-base text-light-primary-1 text-md-small">{{ $entry['name'] }} not available</span>
                        </div>
                    </div>
                @else
                    {{-- Available Block --}}
                    <div class="rounded-2 w-100 rota-tags align-self-center mb-2 rota-item" data-status="available">
                        <div class="border border-3 border-success border-top-0 border-bottom-0 border-end-0 ps-2">
                            <button class="d-block btn btn-collapse p-0 text-light-primary-1 text-hover-light-primary-1 border-0 text-md-small lh-base f300 w-100 pe-4 text-start collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#{{ $entry['collapseId'] }}"
                                aria-expanded="false"
                                aria-controls="{{ $entry['collapseId'] }}">
                                {{ $entry['name'] }}
                            </button>

                           
                        </div>
                    </div>
                @endif
            @endforeach

          
        </div>
    </div>
@endforeach




                </div>

            </div>

        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const filterLinks = document.querySelectorAll('#rotaFilterMenu [data-filter]');
    const rotaItems = document.querySelectorAll('.rota-item');

    filterLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const filter = this.dataset.filter;

            rotaItems.forEach(item => {
                const status = item.dataset.status;
                if (filter === 'all') {
                    item.style.display = 'block';
                } else if (filter === status) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
});
</script>


@endsection