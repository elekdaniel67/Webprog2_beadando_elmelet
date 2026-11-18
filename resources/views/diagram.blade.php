@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-8">
        <h1 class="text-3xl font-bold text-white mb-3">
            Süteményeink megoszlása
        </h1>

        <p class="text-gray-300 mb-8">
            Fedezd fel, milyen süteménytípusokból áll a kínálatunk!
        </p>

        @if ($adatok->isEmpty())
            <div class="bg-gray-800 text-gray-300 p-6 rounded-lg">
                Még nincsenek megjeleníthető adatok.
            </div>
        @else
            <div class="bg-gray-800 border border-gray-700 rounded-xl p-6">
                <div class="relative max-w-md mx-auto">
                    <canvas id="sutiDiagram"></canvas>

                    <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                        <span class="text-gray-400 text-sm">Összesen</span>
                        <span id="osszesen" class="text-white text-4xl font-bold"></span>
                        <span class="text-gray-400 text-sm">sütemény</span>
                    </div>
                </div>

                <div id="jelmagyarazat" class="flex flex-wrap justify-center gap-4 mt-8"></div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>
                const adatok = {{ Illuminate\Support\Js::from($adatok) }};

                const tipusok = adatok.map(adat => adat.tipus);
                const darabok = adatok.map(adat => Number(adat.darab));
                const osszesen = darabok.reduce((osszeg, darab) => osszeg + darab, 0);

                const szinek = [
                    '#2dd4bf',
                    '#fb7185',
                    '#fbbf24',
                    '#a78bfa',
                    '#60a5fa',
                    '#f97316',
                    '#4ade80',
                    '#e879f9'
                ];

                document.getElementById('osszesen').textContent = osszesen;

                const jelmagyarazat = document.getElementById('jelmagyarazat');

                tipusok.forEach((tipus, index) => {
                    const elem = document.createElement('div');
                    elem.className = 'flex items-center gap-2 text-sm text-gray-300';

                    const jel = document.createElement('span');
                    jel.className = 'w-3 h-3 rounded-full';
                    jel.style.backgroundColor = szinek[index % szinek.length];

                    const felirat = document.createElement('span');
                    felirat.textContent = `${tipus}: ${darabok[index]} db`;

                    elem.append(jel, felirat);
                    jelmagyarazat.append(elem);
                });

                new Chart(document.getElementById('sutiDiagram'), {
                    type: 'doughnut',
                    data: {
                        labels: tipusok,
                        datasets: [{
                            data: darabok,
                            backgroundColor: tipusok.map((_, index) => szinek[index % szinek.length]),
                            borderColor: '#1f2937',
                            borderWidth: 4,
                            hoverOffset: 12
                        }]
                    },
                    options: {
                        responsive: true,
                        cutout: '70%',
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        const szazalek = osszesen
                                            ? (context.raw / osszesen * 100).toFixed(1)
                                            : 0;

                                        return ` ${context.label}: ${context.raw} db (${szazalek}%)`;
                                    }
                                }
                            }
                        }
                    }
                });
            </script>
        @endif
    </div>
@endsection