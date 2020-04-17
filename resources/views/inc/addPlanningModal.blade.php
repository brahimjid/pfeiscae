<div class="modal fade none-border" id="event-modal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Ajouter un planning</strong></h4>
            </div>
            <div class="modal-body">
                <form id="addEventForm">
                    @csrf
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="medecinSelect">Medecin</label>
                                <select class="form-control" required  name="idMedecin" id="medecinSelect" data-live-search="true" title="Choisir">
                                    <option disabled></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="specialiteInput">Spécialité</label>
                                <input class="form-control" style="height: 35px !important; min-height: 20px !important;" type="text"  id="specialiteInput">
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="typePlanning">Type</label>
                                <select class="form-control" required  name="type" id="typePlanning" >
                                    <option value="Soir">Soir</option>
                                    <option value="Matin">Matin</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="nombrePlace">N° Place</label>
                                <input class="form-control" style="height: 35px !important; min-height: 20px !important;"
                                       type="number" name="nombrePlace" id="nombrePlace" required min="1" oninput="validity.valid||(value='');">
                            </div>
                        </div>
                    </div>
                    <div class="ml-2">
                        <label class="control-label font-weight-bold" for="min-date">Date</label>
                        <input type="text" class="form-control" placeholder="set min date" id="min-date" data-dtp="dtp_vfQ7n" name="date">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">fermer</button>
                <button type="button" class="btn btn-success save-event waves-effect waves-light" id="submitEventBtn">
                    Ajouter
                </button>
                <button type="button" class="btn btn-danger delete-event waves-effect waves-light"
                        data-dismiss="modal" style="display: none;">Delete
                </button>
            </div>
        </div>
    </div>
</div>
