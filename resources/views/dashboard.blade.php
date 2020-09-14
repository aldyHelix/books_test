<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div id="container" class="container col-sm-12">

                </div>
                <div id="piechart" class="piechart col-sm-12">

                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script>
            $(document).ready(function() {
                $("#datatable").DataTable({
                    dom: 'Bfrtip',
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                });
            });
            var book_category =  {!!json_encode($book_category)!!};
            var category =  {!!json_encode($category)!!};
            var book_genre =  {!!json_encode($book_genre)!!};

            console.log(book_genre);

            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Book by Category'
                },
                xAxis: {
                    categories: category
                },
                yAxis: {
                    title: {
                        text: 'Number of book'
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },
                plotOptions: {
                    series: {
                        allowPointSelect: true
                    }
                },

                series: [{
                    name: 'Books',
                    data: book_category
                }],

                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },

                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }
            });

            Highcharts.chart('piechart', {
                chart: {
                    type: 'pie',
                    marginTop: 80
                },
                title: {
                    text: 'Book by Genre'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                xAxis: {
                    categories: ['Book by Genres']
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },
                plotOptions: {
                    series: {
                        allowPointSelect: true
                    }
                },

                series: [{
                    name: 'Books by Genres',
                    data:
                        [
                            @php
                                foreach($book_genre as $key => $value){
                                    echo "['".$key."',".$value."],";
                                }
                            @endphp
                        ]
                }],

                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },

                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }
            });
        </script>
    @endpush
</x-app-layout>
