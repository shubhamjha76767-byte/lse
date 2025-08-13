@extends('layout.app')



@section('content')





<div class="rota pt-3 pb-5">

    <div class="container px-md-2 px-0">

        <h1 class="h2 text-primary mb-1 px-md-0 px-4">ROTA</h1>

       <div class="ps-md-2 f300 text-md-small text-primary mb-3 ps-md-0 px-4">
    {{ $weekRange }}
</div>

        <div class="rota-day border border-md-down-bottom-0 border-md-down-start-0 border-md-down-end-0 border-dark-primary-2">

            <div class="w-100 py-2 px-3 d-flex align-items-center border-bottom border-dark-primary-2">

                <a class="btn text-md-small f700 text-white  border-primary-dark bg-hover-primary py-2 px-4 rounded-2 lh-1 my-1" href="./rota">WEEKLY</a>

                <a class="btn text-md-small f700 text-white bg-primary-dark bg-hover-primary py-2 px-4 rounded-2 lh-1 ms-2 my-1" href="./rota-day">DAILY</a>

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

            <div class="rota-wrap px-md-0 px-3">

                <div class="d-md-flex">

                    <div class="rota-col py-3 border-dark-primary-2 d-flex border-bottom-md-0 border-bottom flex-grow w-100">

                        <div class="text-center px-md-3 pe-3 rota-date">

                           <div class="text-center px-md-3 pe-3 rota-date">
    <span class="d-block text-small text-uppercase f700 lh-1 text-primary rota-day">{{ $today->format('D') }}</span>
    <span class="fs-5 text-primary">{{ $today->format('j') }}</span>
</div>

                        </div>

                       

                           

                             <div class="align-self-center w-100" id="dailyRotaContainer">
        @forelse ($todayRota['entries'] as $entry)
            @if ($entry['available'])
                <div class="rounded-2 w-100 rota-tags align-self-center mb-2 rota-entry" data-status="available">
                    <div class="border border-3 border-success border-top-0 border-bottom-0 border-end-0 ps-3">
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
            @else
                <div class="rounded-2 w-100 notavailable rota-tags align-self-center mb-2 rota-entry" data-status="notavailable">
                    <div class="border border-3 border-primary-alt border-top-0 border-bottom-0 border-end-0 ps-2">
                        <span class="d-block lh-base text-light-primary-1 text-md-small">{{ $entry['name'] }} not available</span>
                    </div>
                </div>
            @endif
        @empty
            <div class="text-center text-light-primary-1 text-small">No profiles found for today.</div>
        @endforelse
    </div>

                           


                    </div>                    

                </div>

            </div>

        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const filterLinks = document.querySelectorAll('#rotaFilterMenu a[data-filter]');
    const rotaEntries = document.querySelectorAll('.rota-entry');

    filterLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();

            const selectedFilter = this.getAttribute('data-filter');

            rotaEntries.forEach(entry => {
                const status = entry.getAttribute('data-status');

                if (selectedFilter === 'all') {
                    entry.style.display = 'block';
                } else if (selectedFilter === status) {
                    entry.style.display = 'block';
                } else {
                    entry.style.display = 'none';
                }
            });
        });
    });
});
</script>




@endsection