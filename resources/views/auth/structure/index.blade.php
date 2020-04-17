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
    <div class="card p-3">
        <div class="card-body">
            {{--            <button class="btn btn-success float-right" id="addEventBtn"> Ajouter</button>--}}
            <div class="row align-items-center">
                <div class="col">
                    <div class="form-group">
                        <div class="col">
                            <label for="specialiteSelect">Spécialité</label>
                        </div>
                        <select name="specialiteSelect" id="specialiteSelect" class="form-control w-50" data-live-search="true">
                            <option value="All">All</option>
                            @foreach($specialites as $spec)
                                <option value="{{$spec->id}}">{{$spec->nom}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col float-right">
                    <button class="btn btn-primary float-right" id="addEventBtn">
                        <i class="ti-plus f-s-12 m-r-5">

                        </i> Create New
                    </button>
                </div>
            </div>
            @include('inc.addPlanningModal')
        </div>
        <div id="calender"></div>
    </div>
    @include('inc.updateModal')
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

            let medecinSelect = $('#medecinSelect'),
                specialiteSelect = $('#specialiteSelect');
                specialiteSelect.selectpicker();
            $('#typePlanning').selectpicker();

            //  ******   datepicker init  ***** //
            $('#min-date').bootstrapMaterialDatePicker({
                format: 'YYYY-MM-DD HH:mm',
                minDate: new Date()
            });



                //  ******   add planning function     ******  //

            function addPlanning() {

                medecinSelect.empty();
                $.ajax({
                    url: '{{route('listMedecins')}}',
                    success: (data) => {

                        $.each(data, (key, medecin) => {
                            medecinSelect.append(`
                                <option value="${medecin.id}">${`${medecin.nom} ${medecin.prenom}`} </option>
                              `);
                        });
                        medecinSelect.selectpicker();
                    }

                });

                $('#event-modal').modal('show');
            }

            //  ******   end function  ***** //


            $('#addEventBtn').on('click', () => {
                addPlanning();
            });

            medecinSelect.on('change', () => {
                let url = '{{ route('medecinSpec',":id")}}';
                url = url.replace(':id', medecinSelect.val());
                $.ajax({
                    url: url,
                }).done((data => {
                    $('#specialiteInput').val($.trim(data))
                })).fail((error) => {
                    console.log(error);
                });
            });

            //  ******   start calendar  ***** //

            let calendarEl = document.getElementById('calender'),
                ajaxUrl = '{{route("plannings.index")}}';

            specialiteSelect.on('change',()=>{
                let value = specialiteSelect.val();
                //alert(value);
                value==="All"?ajaxUrl = '{{route("plannings.index")}}':
                ajaxUrl ='{{route("plannings.show",":id")}}';
                ajaxUrl = ajaxUrl.replace(':id', value);
                console.log(ajaxUrl);
                calendar.refetchEvents();
            });

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
                        url: ajaxUrl,
                        method: 'get',
                    })
                        .done(function (res) {
                            // console.log(res);
                            successCallback(
                                Array.prototype.slice.call( // convert to array
                                    res
                                ).map(function (eventEl) {

                                    return {
                                        id: eventEl.id,
                                        title: `${eventEl.medecin.nom} ${eventEl.medecin.prenom}`,
                                        start: eventEl.date
                                    }
                                })
                            )

                        })
                },
                fixedWeekCount: false,
                showNonCurrentDates: false,

                eventClick: function (info) {
                    $('#updateDate').bootstrapMaterialDatePicker({
                        format: 'YYYY-MM-DD HH:mm',
                        minDate: new Date(),das

                    });
                    $('#updatePlanningModal').modal('show');
                        //alert(info.event.start);

                        //$('#updateDate').val(info.event.start);

                    {{--$.ajax({--}}
                    {{--    url: '{{route('plannings.update')}}',--}}
                    {{--    method: 'post',--}}
                    {{--    data: $("#addEventForm").serialize()--}}
                    {{--}).done((data) => {--}}
                    {{--    if (data === 'success') {--}}
                    {{--        calendar.refetchEvents();--}}
                    {{--        $('#event-modal').modal('hide')--}}
                    {{--        // $('#event-modal').modal('dispose');--}}
                    {{--    } else--}}
                    {{--        alert('erreur')--}}
                    {{--});--}}

                },
                select: function () {
                    addPlanning();
                },
                locale: 'fr',
                weekMode: 'liquid',
                height: 650

            });

            calendar.render();
            //  ******   end calendar  ***** //


            $('#submitEventBtn').click(() => {
                submitPlanning();
            });

            //  ******   submitPlanning function ***** //

            function submitPlanning() {

                $.ajax({
                    url: '{{route('plannings.store')}}',
                    method: 'post',
                    data: $("#addEventForm").serialize()
                }).done((data) => {
                    if (data === 'success') {
                        calendar.refetchEvents();
                        $('#event-modal').modal('hide')
                        // $('#event-modal').modal('dispose');
                    } else
                        alert('erreur')
                });

            }

            //  ******  End  submitPlanning ***** //

            //  ******   submitPlanning function ***** //

            {{--function updatePlanning() {--}}

            {{--    $.ajax({--}}
            {{--        url: '{{route('plannings.update')}}',--}}
            {{--        method: 'post',--}}
            {{--        data: $("#addEventForm").serialize()--}}
            {{--    }).done((data) => {--}}
            {{--        if (data === 'success') {--}}
            {{--            calendar.refetchEvents();--}}
            {{--            $('#event-modal').modal('hide')--}}
            {{--            // $('#event-modal').modal('dispose');--}}
            {{--        } else--}}
            {{--            alert('erreur')--}}
            {{--    });--}}

            {{--}--}}

        })
    </script>
@endsection
