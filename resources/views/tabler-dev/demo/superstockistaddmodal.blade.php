<!-- Modal new user -->
<div class="modal modal-blur fade" id="modal-user" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
      <form name="event_form" method="post" action="{{route('webconnect.createUser')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">New Super Stockist</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Super Stockist Name</label>
              <input type="text" class="form-control" name="name" placeholder="Enter super stckist's name" autocomplete="off" value="" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Choose a password</label>
              <input type="password" class="form-control" name="password" placeholder="Enter a password" autocomplete="off" value="" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Commision Percent</label>
              <input type="number" class="form-control" name="percent" placeholder="Enter commision percentage" value="0" autocomplete="off" value="" required>
            </div>
            <input type="hidden" name="type" value="super" />
          </div>
          <div class="modal-body">
            <div class="row">
              
              @php
              use App\Models\User;

              
              @endphp
              <div class="col-lg-12">
                <div class="mb-3" id="professionSelect">
                <div class="form-label" id="profLable">Select Super Stockist</div>
                              
                              <select class="form-select" name="stockist" id="profs" required>
                              <option value="default">Admin</option>
                                
                                
                              </select>
                </div>
              </div>
              
            </div>
          </div>
          
          <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
              Cancel
            </a>
            <button type="submit" class="btn btn-primary ms-auto">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
              Create New Super Stockist
</button>
          </div>
        </div>
</form>
      </div>
    </div>
    <!-- End new user -->
    <!-- User Edit -->
<div class="modal modal-blur fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
      <form name="event_form" method="post" action="{{route('webconnect.editUser')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Super Stockist</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Super Stockist name</label>
              <input type="text" class="form-control" name="name" id="editName" placeholder="Enter super stockist's name" autocomplete="off" value="" required>
            </div>
            
            <div class="mb-3">
              <label class="form-label">Commision Percent</label>
              <input type="number" class="form-control" name="percent" id="editPercent" placeholder="Enter commision percentage" autocomplete="off" value="" required>
            </div>
            <input type="hidden" name="type" value="agent" />
          </div>
          
          
          <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
              Cancel
            </a>
            <button type="submit" class="btn btn-primary ms-auto">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
              Edit Super Stockist
</button>
          </div>
        </div>
</form>
      </div>
    </div>
<!-- end edit -->

    