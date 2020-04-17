<div class="modal fade none-border" id="updatePlanningModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Modifier un planning</strong></h4>
            </div>
            <div class="modal-body">
                <form id="updateEventForm">
                    @csrf
                    <div class="ml-2">
                        <label class="control-label font-weight-bold" for="updateDate">Date</label>
                        <input type="text" class="form-control" id="updateDate" name="date">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">fermer</button>
                <button type="button" class="btn btn-success save-event waves-effect waves-light" id="updateEventBtn">
                    Modifier
                </button>
            </div>
        </div>
    </div>
</div>
