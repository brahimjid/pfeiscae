@extends('layouts.dashboard')
@section('styles')
    <link href='{{asset('css/main.css')}}' rel='stylesheet'/>
    <link href='{{asset('css/daygrid.css')}}' rel='stylesheet'/>
    <link href='{{asset('css/timeGrid.css')}}' rel='stylesheet'/>
    <link href='{{asset('css/bootstrap-datetimepicker.css')}}' rel='stylesheet'/>
    <link href='{{asset('css/bootstrap-select.min.css')}}' rel='stylesheet'/>
    <link href='{{asset('css/bootstrap-material-datetimepicker.css')}}' rel='stylesheet'/>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            TEsting
        </div>
        <div class="card-body">
            @include('inc.addPlanningModal')
            <button class="btn btn-success" id="add-event"> Ajouter</button>
            <div id="calender"></div>
        </div>
    </div>
@endsection
@section('js-script')

    <script src='{{ asset('js/main.js')}}'></script>
    <script src='{{ asset('js/dayGrid.js')}}'></script>
    <script src='{{ asset('js/timeGrid.js')}}'></script>
    <script src='{{ asset('js/interaction.js')}}'></script>
    <script src='{{ asset('js/fr.js')}}'></script>
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src='{{ asset('js/bootstrap-datetimepicker.min.js')}}'></script>
    <script src='{{ asset('js/bootstrap-material-datetimepicker.js')}}'></script>

    <script>


        $(document).ready(() => {
            let medecinSelect = $('#medecinSelect');
            $('#typePlanning').selectpicker();
            $('#min-date').bootstrapMaterialDatePicker({
                format: 'DD/MM/YYYY HH:mm',
                minDate: new Date()
            });
            medecinSelect.on('change', () => {
                let url = '{{route('medecinSpec',":id")}}';
                url = url.replace(':id', medecinSelect.val());
                $.ajax({
                    url: url,
                }).done((data => {
                    $('#specialiteInput').val($.trim(data))
                })).fail((error) => {
                    console.log(error);
                });
            });
            $('#add-event').on('click', () => {

                medecinSelect.empty();
                $.ajax({
                    url: '{{route('listMedecins')}}',
                    success: (data) => {
                        $.each(data, (key, medecin) => {
                            medecinSelect.append(`
                                <option value="${medecin.id}">${`${medecin.nom} ${medecin.prenom}`} </option>
                              `);
                            medecinSelect.selectpicker();
                        });

                    }

                });

                $('#event-modal').modal('show');


            });
            let calendarEl = document.getElementById('calender');

            let calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['interaction', 'dayGrid', 'timeGrid'],
                editable: true,
                selectable: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },

                events: function (info, successCallback, failureCallback) {
                    $.ajax({
                        url: '{{route('plannings.index')}}',
                        method: 'get',
                    })
                        .done(function (res) {

                            //console.log(res);
                            successCallback(
                                Array.prototype.slice.call( // convert to array
                                    res
                                ).map(function (eventEl) {
                                    console.log(eventEl);
                                    return {
                                        title: eventEl.title,
                                        id: eventEl.id,
                                        start: eventEl.start
                                    }
                                })
                            )

                        })
                },
                fixedWeekCount: false,
                //showNonCurrentDates:false,
                eventClick: function (info) {
                    alert(info.event.id);
                },
                select: function () {
                    alert('select')
                },
                locale: 'fr',
                weekMode: 'liquid',
                height: 650


            });
            // calendar.setOption('locale', 'fr');
            calendar.render();

        })
    </script>
@endsection
